<?php 

namespace app\home\controller;

use think\db\Query;
use think\Validate;
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

        $this->assign('page',$page);
        $this->assign('tagList',$tagList);
        $this->assign('articleList',$articleList);
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
     * 留言
     * @return [type] [description]
     */
    public function post(){

        if(isPost()){

            $this->_validate_post();

            $data = [
                'a_id'        => I('aid',0,'intval'),
                'rev_cid'     => I('rid',0,'intval'),
                'nick_name'   => I('name','','trim'),
                'content'     => I('content','','htmlspecialchars'),
                'ip'          => request()->ip(),
                'create_time' => time()
            ];
            
            $res = Model('Comment')->insert($data);

            if($res){

                $this->ajaxReturn(['state'=>true,'msg'=>'留言成功']);
            }else{

                $this->ajaxReturn(['state'=>false,'msg'=>'留言失败']);
            }
        }
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

    /**
     * 留言校验
     * @return [type] [description]
     */
    private function _validate_post(){


        $validate = new Validate([
            'name' => 'require',
            'content'   => 'require|max:1000',
            'verify'    => 'require|captcha'
        ],[
            'name'       => '昵称不能为空',
            'content.require' => '留言内容不能为空',
            'content.max'     => '留言最多不能超过1000个字符',
            'verify.require'  => '验证码不能为空',
            'verify.captcha'  => '验证码输入错误,请重新输入'
        ]);

        if(!$validate->check($_POST)){

            $this->ajaxReturn(['state'=>false,'msg'=>$validate->getError()]);
        }
    }
}