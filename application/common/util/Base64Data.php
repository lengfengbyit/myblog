<?php

namespace app\common\util;

/**
 * 处理Base64数据
 */
class Base64Data {

	protected $base64_data;

	protected $info;

	protected $error;

	protected $rule;

	public function __construct($base64_data,$rule=''){

		$this->error = '';
		$this->rule = $rule;

		if(empty($base64_data)){

			$this->error = '必须传入一个base64数据';

			return false;
		}

        $this->base64_data =  $base64_data;
    }

    public function getError(){

    	return $this->error;
    }

    public function getInfo(){

		$arr = explode(';', $this->base64_data);
		$type = explode(':', $arr[0])[1]; //文件类型

		$this->info =  [
			'type' => $type, //文件类型
			'ext' => explode('/', $type)[1],//文件后缀
			'size' => strlen($this->base64_data),//文件大小
			'file' => base64_decode(ltrim($arr[1],'base64,')),//文件内容
		];

		return $this->info;
	}

	/**
	 * 保存文件
	 * @param  [type] $save_path [保存路径]
	 * @param  string $save_name [保存名称，为空自动生成]
	 * @return [type]            [description]
	 */
	public function save($save_path,$save_name=''){

		if(!$this->info){

			$this->getInfo();
		}

		if(!$save_path){

			$this->error = '请传入保存路径'; return false;
		}

		if($save_name == ''){

			$save_name = date('Ymd') . DS . md5(microtime(true));
		}

		$save_name .= '.' .$this->info['ext'];
		$file_name = $save_path . $save_name;

		// 检测目录
        if (false === $this->checkPath(dirname($file_name))) {
            return false;
        }

        /* 不覆盖同名文件 */
        if (is_file($file_name)) {
            $this->error = '存在同名文件' . $file_name;
            return false;
        }

        /** 根据规则检查文件 */
        if(!$this->check()){

        	return false;
        }

        //该函数将返回写入到文件内数据的字节数。
		if(file_put_contents($file_name, $this->info['file']) > 0){

			return [
				'save_name' => $save_name,
				'save_path' => $save_path,
				'file_name' => $file_name
			];
		}

		$this->error = '保存失败';

		return false;
	}

	/**
     * 检查目录是否可写
     * @param  string   $path    目录
     * @return boolean
     */
    protected function checkPath($path)
    {
        if (is_dir($path)) {
            return true;
        }

        if (mkdir($path, 0755, true)) {
            return true;
        } else {
            $this->error = "目录 {$path} 创建失败！";
            return false;
        }
    }

    /**
     * 检测上传文件
     * @param  array   $rule    验证规则
     * @return bool
     */
    protected function check($rule = [])
    {
        $rule = $rule ?: $this->rule;

        /* 检查文件大小 */
        if (isset($rule['size']) && !$this->checkSize($rule['size'])) {
            $this->error = '上传文件大小不符！';
            return false;
        }

        /* 检查文件Mime类型 */
        if (isset($rule['type']) && !$this->checkMime($rule['type'])) {
            $this->error = '上传文件MIME类型不允许！';
            return false;
        }

        /* 检查文件后缀 */
        if (isset($rule['ext']) && !$this->checkExt($rule['ext'])) {
            $this->error = '上传文件后缀不允许';
            return false;
        }

        /* 检查图像文件 */
        if (isset($rule['img']) &&  !$this->checkImg()) {
            $this->error = '非法图像文件！';
            return false;
        }

        return true;
    }

    /**
     * 检查 文件尺寸
     * @param  [type] $size [description]
     * @return [type]       [description]
     */
    protected function checkSize($size){

    	if($size < $this->info['size']){

    		return false;
    	}

    	return true;
    }

    /**
     * 检查文件类型
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    protected function checkMime($type){

    	if($type != $this->info['type']){

    		return false;
    	}

    	return true;
    }

    /**
     * 检查文件后缀
     * @param  [type] $ext [description]
     * @return [type]      [description]
     */
    protected function checkExt($ext){

    	if($ext != $this->info['ext']){

    		return false;
    	}

    	return true;
    }

    /**
     * 判断是否是图片文件
     * @return boolean [description]
     */
    protected function checkImg($msg=''){

    	if(in_array($this->info['ext'],['gif', 'jpg', 'jpeg', 'bmp', 'png'])){

    		return true;
    	}
    	return false;
    }
}
