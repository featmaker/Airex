<?php
namespace Home\Controller;
use Home\Controller\BaseController;
use Home\Model\FactoryModel;


// class IndexController extends BaseController
// {
//     public function index(){
//     	$Cate = FactoryModel::createCategoryModel();
//     	$categorys = $Cate->getCategorys();
//     	$catName = I('get.cat');
//     	$nodes= $Cate->getNodeByCatName($catName);

//     	// var_dump($categorys);
//     	// var_dump($nodes);

//         // $this->display();

/**
 * 首页控制器.
 * Author:Patrick95
 * Date:2016/5/28
 * Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 */
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
                // var_dump($nodes);
        $topics = $Cate->getTopicsByCat($catName);      //获取主题
                // var_dump($topics);
        $this->assign('categorys',$categorys);
        $this->assign('nodes',$nodes);
        $this->assign('activeCat',$catName);
        $this->assign('topics',$topics);
        $this->display();
        // var_dump($data);
    }
}