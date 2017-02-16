<?php
namespace app\admin\controller;

use think\Validate;

use app\common\controller\AdminCommon;

class Index extends AdminCommon{

    public function index(){
       
       return $this->fetch();
    }

    public function main(){

    	return '1';
    }
    /**
     * 登录页面
     * @return [type] [description]
     */
    public function login(){

    	if(!isPost()){

    		return $this->fetch();
    	}else{

    		$this->_validate();
    		
    		$condition = [
    			'user_name' => I('post.username'),
    			'password' => I('post.password','','md5')
    		];

    		$admin = model('Admin')->get($condition);
    		
    		if($admin){

    			$this->_saveData($admin);
                                    
                session('admin_info',$admin->getData());

    			$this->success('登录成功','index');
    		}else{

    			$this->error('用户名或密码错误，请重新输入');
    		}
    	}
    }

    /**
     * 注销登录
     * @return [type] [description]
     */
    public function logout(){

        session('admin_info',null);
        $this->redirect('index/login');
    }

    /**
     * 登录验证
     * @return [type] [description]
     */
    protected function _validate(){

    	$validate = new Validate([
    		'username' => 'require',
    		'password' => 'require'
    	],[ 
    		'username' => '用户名不能为空',
    		'password' => '密码不能为空'
    	]);
    	if(!$validate->check(I('post.'))){

    		$this->error($validate->getError());
    	}
    }

    /**
     * 保存数据
     * @param  [type] $model [description]
     * @return [type]        [description]
     */
    protected function _saveData($admin){

        $admin->last_login_time = time();
        $admin->last_login_ip = req('ip');
        $admin->login_count += 1;

        return $admin->save();
    }
}
