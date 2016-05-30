<?php 
namespace Home\Controller;

use Home\Controller\BaseController;
use Home\Model\FactoryModel;
/**
* 主题控制器
*/
class TopicController extends BaseController
{
	
	function __construct()
	{
		parent::__construct();
		if (!checkLogin()) {
			$this->redirect("User/login",'',0);
		}
	}

	public function index(){
		$this->redirect("Index/index",0);
	}

	/**
	 * 发布新主题
	 */
	public function addTopic(){
		if (IS_POST) {
			$data['title'] = I('post.title','','trim');
			$date['content'] = I('post.content','','trim');
			$data['node_id'] = I('post.nodeid','','intval');
			$data['uid'] = session('uid');
			$Topic = FactoryModel::createTopicModel();
			$Topic->addTopic($data);
			if ($Topic->addTopic($data)) {
				$this->success('发布主题成功');
			}else{
				$this->error($Topic->getError());
			}
		}else{
			$this->display();
		}
	}

	/**
	 * 主题详情
	 * @return [type] [description]
	 */
	public function detail(){
		$tid = I('get.tid','','intval');
		$Topic = FactoryModel::createTopicModel();
		if (!$Topic->checkTid($tid)) {
			$this->error('传输参数错误');
		}
		$topicInfo = $Topic->getInfoById($tid);		//根据tid获取详情
		$commentInfo = $Topic->getCommentById($tid);	//根据tid获取评论
		$Index = FactoryModel::createIndexModel();
		$data = $Index->getUserInfo();			//获取登陆用户信息
		$this->assign('topicInfo',$topicInfo);
		$this->assign('commentInfo',$commentInfo);
		$this->assign('data',$data);
		$this->display();
		var_dump($topicInfo);
	}

	/**
	 * 追加主题内容
	 * @return [type] [description]
	 */
	public function appendTopic(){
		if (IS_POST) {
			$content = I('post.append','','trim') == '' ?
												 $this->error('追加信息不能为空') :
												 I('post.append','','trim');
			$tid = I('post.tid','','intval');
			$Topic = FactoryModel::createTopicModel();
			if (!$Topic->checkTid($tid)) {
				$this->error('不要修改tid值');
			}
			if (!$Topic->appendContent($tid,$content)) {
				$this->error($Topic->getError());
			}
		}else{
			$this->display();
		}
	}
}