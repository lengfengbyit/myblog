<?php

namespace app\admin\controller;

use think\Validate;

use app\common\controller\AdminCommon;
use app\common\util\Base64Data;

class Admin extends AdminCommon{

	public function index(){

		$this->getIndexData();
		
		return $this->fetch();
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
		
		$validate = new Validate([
			'user_name' => 'require',
			'password' => 'require',
			'nickname' => 'require'
		],[
			'user_name' => '账号不能为空',
			'password' => '密码不能为空',
			'nickname' => '昵称不能为空'
		]);

		if(!$validate->check(I('post.'))){

			$this->error($validate->getError());
		}
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
			$config = C('admin_config.avatar');
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
		$admin->password = md5(I('post.password'));
		$admin->nickname = I('post.nickname');
		$admin->register_time = time();
		$admin->status = I('post.status',0,'intval');

		return $admin->save();
	}
}