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
    public function index(){
        if (session('?uid')) {
            $Index = FactoryModel::createIndexModel(); //得到用户信息
            $data = $Index->getUserInfo();   
            $this->assign('data',$data);           
        }       
        $Cate = FactoryModel::createCategoryModel();
        $categorys = $Cate->getCategorys();             //获取分类
        $catName = I('get.cat');
        $nodes= $Cate->getNodeByCatName($catName);      //获取节点
        $topics = checkNull($Cate->getTopicsByCat($catName)) ? null : $Cate->getTopicsByCat($catName);
        $this->assign('categorys',$categorys);
        $this->assign('nodes',$nodes);
        $this->assign('activeCat',$catName);
        $this->assign('topics',$topics);
        $this->display();
    }
}