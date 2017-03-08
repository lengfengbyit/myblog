<?php 

namespace app\common\model;

use app\common\model\Common;

class Article extends Common{
	
    /**
     * 文章类型一对一关联
     * @return [type] [description]
     */
    public function artCate(){

        return $this->hasOne('articleCategory','ac_id');
    }

    /**
     * 文章评论一对多关联
     * @return [type] [description]
     */
    public function comments(){

        return $this->hasMany('comment','c_id');
    }

    /**
     * 获得文章标签
     * @param  $field 获得标签属性
     * @param  $mode 返回值类型 0：数组，1：标签名字符串
     * @return [type] [description]
     */
    public function tags($field="tag_name",$mode=0){

        $res = Model('tag')->where(['t_id'=>['in',$this->tag_ids]])->column($field);
        if($mode && is_string($res[0])){

            return implode(',', $res);
        }
        return $res;
    }

    /**
     * 获得文章信息（包括关联信息）
     * @return [type] [description]
     */
    public function getArtFullList($param=[]){

        $articleList = $this->where(['is_show'=>1])->order('a_id desc')->paginate();

        // 标签获取模式 ： 0：数组模式，1:字符串模式
        $tag_mode = isset($param['tag_mode']) ? intval($param['tag_mode']) : 0;
        if($tag_mode == 0){
            $tag_field = 't_id,tag_name';
        }else{
            $tag_field = 'tag_name';
        }
        foreach ($articleList as $i => $art) {
            // 标签预加载
            $articleList[$i]['tags'] = $art->tags($tag_field,$tag_mode);
            // 分类名称预加载
            $articleList[$i]['cate_name'] = $art->artCate['cate_name'];
        }

        return $articleList;
    }


}