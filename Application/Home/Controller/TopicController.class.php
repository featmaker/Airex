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
		if (checkLogin()) {
			$this->redirect("User/login",'',0);
		}
	}

	public function index(){
		$this->redirect("Index/index",0);
	}

	//发布新主题
	public function addTopic(){
		if (IS_POST) {
			$data['title'] = I('post.title','','trim');
			$date['content'] = I('post.content','','trim');
			$data['node_id'] = I('post.nodeid','','intval');
			// $data['title'] = '我是中国人';
			// $data['content'] = '你是谁你是谁你是谁你是谁你是谁';
			// $data['node_id'] = 3;
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

	//主题详情
	public function detail(){
		$tid = I('get.tid','','intval');
		$Topic = FactoryModel::createTopicModel();
		$topicInfo = $Topic->getInfoById($tid);
		$commentInfo = $Topic->getCommentById($tid);
		// $replyInfo = 
		$this->display();
	}
}