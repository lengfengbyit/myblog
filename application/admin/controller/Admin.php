<?php

namespace app\admin\controller;

use think\Validate;
use think\Request;

use app\common\controller\AdminCommon;
use app\common\util\Base64Data;

class Admin extends AdminCommon{


	public function index(){

		$this->getIndexData();

		
		return $this->fetch();
	}

	/**
	 * 当前会员的个人信息
	 * @return [type] [description]
	 */
	public function info(){

		if(!isPost()){

			$id = session('admin_info.a_id');
			$info = model('Admin')->get($id);

			$this->assign('info',$info);
			return $this->fetch();
		}
	}

	protected function formGetBefore(){

		// 获得角色列表
		$roles = model('role')->all();
		
		$this->assign('roles',$roles);
	}

	/**
	 * 保存数据之前的操作
	 * @param [type] $model [description]
	 */
	protected function addPostBefore($model){

		if($model->get(['user_name'=>I('post.user_name')])){

			$this->ajaxReturn(['error'=>1,'msg'=>'用户名已存在，请重新添加']);
		}
	}

	/**
	 * 删除后 删除图片
	 * @return [type] [description]
	 */
	protected function delAfter($model){

		$avatar = isset($model->avatar) ? $model->avatar : '';

		$config = C('admin_config.avatar');

		if(strstr($avatar,'/')){

			@unlink($config['save_path'] . $avatar);
		}
	}

	/**
	 * 删除后 删除图片
	 * @param  [type] $list [要删除的数据内容]
	 * @return [type]        [description]
	 */
	protected function delSelectAfter($list){

		$config = C('admin_config.avatar');

		foreach ($list as $key => $val) {
			
			if($val['avatar'] && strstr($val['avatar'],'/')){

				@unlink($config['save_path'] . $val['avatar']);
			}
		}
	}


	/**
	 * 表单验证
	 * @return [type] [description]
	 */
	protected function _validate(){

		$rule = [
			'user_name' => 'require',
			'nickname' => 'require'
		];
		$msg = [
			'user_name' => '账号不能为空',
			'nickname' => '昵称不能为空'
		];

		if($this->req->action() != 'edit'){

			$rule['password'] = 'require';
			$msg['password'] = '密码不能为空';
		}

		$validate = new Validate($rule,$msg);
		if(!$validate->check(I('post.'))){

			return ['error'=>1,'msg'=>$validate->getError()];
		}

		return true;
	}

	/**
	 * 保存数据
	 * @return [type] [description]
	 */
	protected function _saveData($admin){
		
		//管理员头像上传
		$avatar = I('avatar'); 
		if($avatar){

			$rule = [
				'size' => 1024 * 1024 * 500,//500KB
				'img' => true,//必须是img
			];

			$base64Data = new Base64Data($avatar,$rule);
			$config = C('avatar');
			$res = $base64Data->save($config['save_path']);

			if(!$res){

				$this->ajaxReturn(['error'=>1,'msg'=>$base64Data->getError()]);
			}

			//判断是否存在，如存在，则删除
			if(isset($admin->avatar) && strstr($admin->avatar,'/')){

				@unlink($config['save_path'] . $admin->avatar);
			}

			//转一下 \ ，\在浏览器里解析不出来，转成 / 
			$admin->avatar = empty($res['save_name']) ? '' : str_replace('\\', '/', $res['save_name']);
		}else{

			$admin->avatar = 'default_avatar.jpg'; //默认图片
		}

		$admin->user_name = I('post.user_name');
		$admin->nickname = I('post.nickname');
		$admin->register_time = time();
		$admin->status = I('post.status',0,'intval');

		if(!empty($_POST['password'])){

			$admin->password = I('post.password','','md5');
		}

		$role_id = I('post.role_id',0,'intval');
		if($role_id > 0){

			$data = [
				'uid'      => $admin->a_id,
				'group_id' => $role_id
			];

			// 保存用户权限设置
			model('role_access')->save($data);
		}

		return $admin->save($admin->toArray());
	}
}