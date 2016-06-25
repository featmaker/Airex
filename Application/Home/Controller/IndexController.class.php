<?php
/**
 * 首页控制器.
 * Author:Micanss
 * Date:2016/5/30
 * Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 */
namespace Home\Controller;
use Home\Controller\BaseController;


class IndexController extends BaseController
{
    public $Cate; //分类模型
    public $Topic;  //主题模型
    public $Node;   //节点模型
    function __construct(){
        parent::__construct();
        $this->Cate = D('Category');
        $this->Topic = D('Topic');
        $this->Node = D('Node');
    }

    /**
     * 主页
     * @return [type] [description]
     */
    public function index(){
        if (session('?uid')) {
            $Index = D('Index');                               //用户信息
            $data = $Index->getUserInfo();   
            $this->assign('data',$data);           
        }
        $catName = I('get.cat');
        if ($catName != null) {
            if (!catValidate($catName)) {
                $this->error('传输参数错误');
            }  
        }
        $categorys = $this->Cate->getCategorys();             //获取导航栏分类
        $nodes=$this->Node->getNodeByCatName($catName);      //根据分类获取节点
        $topics = $this->Topic->getTopicsByCat($catName);      //根据分类获取文章
        $siteInfo = D('Index')->getSiteInfo();                 //站点信息
        $hotNodes= $this->Node->getHotNodes();                  //热门节点
        $this->assign('categorys',$categorys);
        $this->assign('nodes',$nodes);
        $this->assign('activeCat',$catName);                   //当前分类
        $this->assign('topics',$topics);
        $this->assign('siteInfo',$siteInfo);
        $this->assign('hotNodes',$hotNodes);
        $this->display();
    }
}