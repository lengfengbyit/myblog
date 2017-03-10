<?php

namespace app\home\widget;

use app\common\controller\HomeCommon;

/**
 * 留言
 */
class Comment extends HomeCommon{

    /**
     * 最新留言列表
     * @return [type] [description]
     */
    public function lastCommentList(){
        // 最新留言
        $commentList = Model('Comment')->getNewCommentList();

        $this->assign('commentList',$commentList);
        return $this->fetch('widget:lastCommentList');
    }
}