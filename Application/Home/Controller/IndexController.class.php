<?php
/**
 * 首页控制器.
 * Author:Micanss
 * Date:2016/5/30
 * Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 */
namespace Home\Controller;
use Home\Controller\BaseController;
use Home\Model\FactoryModel;


class IndexController extends BaseController
{
    public $Cate; 
    function __construct(){
        parent::__construct();
        $this->Cate = D('Category');
    }

    /**
     * 主页
     * @return [type] [description]
     */
    public function index(){
        if (session('?uid')) {
            $Index = D('Index'); //得到用户信息
            $data = $Index->getUserInfo();   
            $this->assign('data',$data);           
        }
        $catName = I('get.cat');   
        $categorys = $this->Cate->getCategorys();             //获取导航栏分类
        $nodes= $this->Cate->getNodeByCatName($catName);      //根据分类获取节点
        $topics = $this->Cate->getTopicsByCat($catName);      //根据分类获取文章
        $topics =  checkNull($topics) ? null : $topics;
        $siteInfo = D('Index')->getSiteInfo();
        $this->assign('categorys',$categorys);
        $this->assign('nodes',$nodes);
        $this->assign('activeCat',$catName);                   //当前分类
        $this->assign('topics',$topics);
        $this->assign('siteInfo',$siteInfo);
        $this->display();
    }
}