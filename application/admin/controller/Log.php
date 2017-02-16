<?php 

namespace app\admin\controller;

use app\common\controller\AdminCommon;

class Log extends AdminCommon{

	public function index(){

		$model = model('Log');

		$condition = array();
		if(isset($_GET['me'])){ // 获得当前管理员的操作日志

			$condition['admin_id'] = session('admin_info.a_id');
		}

		// $list = $model->table('log l')->join('admin a','a.a_id = l.admin_id')->field('l.*,a.admin_name')->where($condition)->order('log_id desc')->paginate(10);
		$prefix = C('database.prefix'); 
		$list = $model->table($prefix.'log l')->view([
			$prefix . 'admin' => 'a'
		],'user_name','l.admin_id = a.a_id')->field('l.*')->where($condition)->order('log_id desc')->paginate(10);
		$page = $list->render();
		
		$this->assign('list',$list);
		$this->assign('page',$page);

		return $this->fetch();
	}
	/**
	 * 清空日志
	 * @return [type] [description]
	 */
	public function clearAll(){

		$res = model('Log')->where('1=1')->delete();

		$this->addLog(false,'succcess');
		$this->success('清除成功','index');		
	}
	public function _validate(){}

	public function _saveData($model){}

}