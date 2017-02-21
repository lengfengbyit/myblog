<?php

namespace app\admin\controller;

use app\common\util\Base64Data;
use app\common\controller\AdminCommon;

class Site extends AdminCommon{

	public function index(){

	}

	/**
	 * 站点设置
	 * @return [type] [description]
	 */
	public function setting(){

		if(!isPost()){

			$info = $this->model->where("type='site'")->column('key,value');
			
			$this->assign('info',$info);
			return $this->fetch();
		}else{

			$data = I('post.');
			$site_logo = I('site_logo','','trim'); 
			if($site_logo){

				$data['site_logo'] = $this->uploadSiteLogo($site_logo);
			}

			if(empty($site_logo)){
				unset($data['site_logo']);
			}
			$data['site_open'] = I('site_open',0,'intval');
			$data['visitor_message'] = I('visitor_message',0,'intval');
			
			foreach ($data as $key => $val) {
				
				$item = [
					'key' => $key,
					'value' => $val,
					'type' => 'site'
				];

				$res = $this->saveSetting($item);
			}
			
			$this->ajaxReturn(['error'=>0,'msg'=>'保存成功']);
		}
	}

	/**
	 * 上传站点logo
	 * @return [type] [description]
	 */
	private function uploadSiteLogo($site_logo){

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

		$old_site_logo = model('site')->where(['key'=>'site_logo'])->find();
		//判断是否存在，如存在，则删除
		if($old_site_logo){

			@unlink($config['save_path'] . $old_site_logo);
		}

		//转一下 \ ，\在浏览器里解析不出来，转成 / 
		$site_logo = empty($res['save_name']) ? '' : str_replace('\\', '/', $res['save_name']);

		return $site_logo;
	}

	/**
	 * 保存站点设置信息
	 * @param  [type] $item [description]
	 * @return [type]       [description]
	 */
	private function saveSetting($item){

		if(!$item){return;}

		//判断是否存在
		$condition = ['key'=>$item['key']];
		$info = model('site')->where($condition)->find();
		if($info && $info->value != $item['value']){

			$info->value = $item['value'];
			$res = $info->save();
		}else{

			$res = model('site')->data($item)->isUpdate(false)->save();
		}

		return $res;
	}

	/**
	 * 站点seo设置
	 * @return [type] [description]
	 */
	public function seo(){

		if(!isPost()){

			$info = $this->model->where(['type'=>'seo'])->column('key,value');
			$info = $info ? $info : [];
			
			$this->assign('info',$info);
			return $this->fetch();
		}else{

			$data = I('post.');
			foreach ($data as $key => $val) {
				
				$item = [
					'key'   => $key,
					'value' => $val,
					'type'  => 'seo'
				];

				$this->saveSetting($item);
			}

			$this->ajaxReturn(['error'=>0,'msg'=>'保存成功']);
		}
	}

	public function _validate(){

	}

	public function _saveData($model){


	}
}