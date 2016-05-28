<?php
namespace Home\Controller;

use Home\Controller\BaseController;

class IndexController extends BaseController
{
    public function index(){
        $username = I('session.user');
        $User = M("User");
        $data = $User->where('user_name = "'.$username.'"')->find();
        $this->assign('nodes',$data['nodes']); //输出收藏节点数
        $this->assign('topics',$data['topics']); //输出主题收藏数
        $this->assign('attentions',$data['attentions']); //输出特别关注数
        $this->assign('wealth',$data['wealth']); //输出财富值
        $this->display();
    }
}