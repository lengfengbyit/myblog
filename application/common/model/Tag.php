<?php 

namespace app\common\model;

use app\common\model\Common;

class Tag extends Common{
	
    /**
     * 获得该标签下的文章数量
     * @return [type] [description]
     */
    public function getArtCountAttr($val,$data){

        $condition = ['tag_ids'=>['like','%,'.$data['t_id'].',%']];
        return Model('article')->where($condition)->count();
    }

    // 获得标签列表
	public function getTagList($condition=['status'=>1],$order="sort desc,t_id asc"){

		return $this->where($condition)->order($order)->select();
	}
}