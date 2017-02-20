<?php 

namespace app\admin\controller;

use app\common\controller\AdminCommon;

class Log extends AdminCommon{

	public function index(){

		$model = model('Log');
		$user_flag = ''; // 用户标识

		$condition = array();
		if(isset($_GET['me'])){ // 获得当前管理员的操作日志

			$user_flag = 'me';
			$condition['admin_id'] = session('admin_info.a_id');
		}

		$prefix = C('database.prefix'); 
		$list = $model->table($prefix.'log l')->view([
			$prefix . 'admin' => 'a'
		],'user_name','l.admin_id = a.a_id')->field('l.*')->where($condition)->order('log_id desc')->paginate(10);
		$page = $list->render();
		
		$this->assign('user_flag',$user_flag);
		$this->assign('list',$list);
		$this->assign('page',$page);

		return $this->fetch();
	}
	/**
	 * 清空日志
	 * @return [type] [description]
	 */
	public function clearAll(){

		$condition = [];

		if(isset($_GET['me'])){

			$condition['admin_id'] = session('admin_info.a_id');
		}

		$res = model('Log')->where($condition)->delete();

		$this->addLog(false,'succcess');
		$this->success('清除成功','index');		
	}
	public function _validate(){}

	public function _saveData($model){}

}