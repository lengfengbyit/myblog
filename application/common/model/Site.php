<?php

namespace app\common\model;

use app\common\model\Common;

class site extends Common{


    /**
     * 获得网站信息
     * @return [type] [description]
     */
	public function getSiteInfo(){

        $data = cache('site_info');
        if(!$data){
            $data = $this->where(['type'=>'site'])->column('value','key');

            cache('site_info',$data);
        }
        return $data;
    }
}