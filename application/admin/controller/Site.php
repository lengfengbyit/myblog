<?php

namespace app\model\controller;

use app\common\controller\ModelCommon;

class Site extends ModelCommon{

	public function index(){

	}

	/**
	 * 站点设置
	 * @return [type] [description]
	 */
	public function setting(){

		if(!isPost()){

			return $this->fetch();
		}else{

			$site_logo = I('site_logo','','trim'); 
			if($site_logo){

				$site_logo = $this->uploadSiteLogo();
			}
		}
	}

	/**
	 * 上传站点logo
	 * @return [type] [description]
	 */
	private function uploadSiteLogo(){

		$config = C('site_logo');
		$rule = [
			'size' => $config['max_size'],//500KB
			'img' => true,//必须是img
		];

		$base64Data = new Base64Data($site_logo,$rule);
		$res = $base64Data->save($config['save_path']);

		if(!$res){

			$this->ajaxReturn(['error'=>1,'msg'=>$base64Data->getError()]);
		}

		$old_site_logo = model('site')->where('key'=>'site_logo')->find();
		//判断是否存在，如存在，则删除
		if($old_site_logo){

			@unlink($config['save_path'] . $old_site_logo);
		}

		//转一下 \ ，\在浏览器里解析不出来，转成 / 
		$site_logo = empty($res['save_name']) ? '' : str_replace('\\', '/', $res['save_name']);

		return $site_logo;
	}

	/**
	 * 站点seo设置
	 * @return [type] [description]
	 */
	public function seo(){

	}

	public function _validate(){

	}

	public function _saveData($model){


	}
}