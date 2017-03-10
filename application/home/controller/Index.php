<?php 

namespace app\home\controller;

use think\db\Query;
use app\common\controller\HomeCommon;

class Index extends HomeCommon{

    /**
     * 首页
     * @return [type] [description]
     */
	public function index(){

        // 文章列表
        $condition = $this->_getListCondition();
        $articleList = Model('article')->getArtFullList(['condition'=>$condition]);
        $page = $articleList->render();

        // 标签列表
        $tagList = Model('tag')->all();

        // 最新留言
        $commentList = Model('comment')->order('c_id desc')->limit(10)->select();

        $this->assign('page',$page);
        $this->assign('tagList',$tagList);
        $this->assign('articleList',$articleList);
        $this->assign('commentList',$commentList);
		return $this->fetch();
	}


    /**
     * 文章详情页
     * @return [type] [description]
     */
    public function article(){

        $id = I('id',0,'intval');
        if($id == 0){

            $this->error('缺少请求参数');
        }

        $artModel = Model('Article');

        $info = $artModel->getFullInfoById($id);

        // 更新文章浏览次数;
        $artModel->where(['a_id'=>$id])->setInc('view_num',1,5);

        // 上一篇 , 下一篇
        $preInfo = $artModel->where("a_id < $id")->order('a_id desc')->field('a_id,title')->find();
        $nextInfo = $artModel->where("a_id > $id")->order('a_id asc')->field('a_id,title')->find();

        // 相关文章
        $otherArtList = $artModel->getOtherArtList($info);

        $this->assign('otherArtList',$otherArtList);
        $this->assign('preInfo',$preInfo);
        $this->assign('nextInfo',$nextInfo);
        $this->assign('info',$info);
        return $this->fetch();
    }

    /**
     * 获得文章列表查询条件
     * @return [type] [description]
     */
    private function _getListCondition(){

        $t_id = I('t_id',0,'intval');
        $condition = [];
        if($t_id){

            $condition['tag_ids'] = ['like','%,'.$t_id.',%'];
        }
        $keyword = I('keyword','','trim');
        if($keyword){
            $condition['title'] = ['like','%'.$keyword.'%'];
            $this->assign('keyword',$keyword);
        }

        return $condition;
    }
}