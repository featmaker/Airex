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
        $Index = FactoryModel::createIndexModel(); //实例化Index模型
        $data = $Index->get_userinfo(); //得到用户信息
        $this->assign('data',$data); //输出用户信息数组到前台
        $this->display();
    }
}