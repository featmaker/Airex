<?php 
namespace Home\Model;
use Think\Model;

/**
* 
*/
class TopicModel extends Model
{	
	//自动验证
	protected $_validate = array(
		array('title','require','主题标题不能为空.',1),
		array('title','checkLength_t','标题不要超过120个字符',1,'callback'),
		array('content','require','主题内容不能为空',1),
		array('content','checkLength_c','话题内容不要超过2000个字符',1,'callback'),
		array('node_id','checkNodeId','请不要修改node值.',1,'callback'),
		);

	//自动完成
	protected $_auto = array(
		array('publish_time','getTime',1,'callback'),
		);
		
	
	//添加主题
	public function addTopic($data){
		if ($this->create($data)) {
			if ($this->add()) {
				return true;
			}
		}
	}

	//检查所属节点值
	function checkNodeId($nodeId){
		$nodeIds = M('node')->getField('id',true);
		if (!in_array($nodeId, $nodeIds)) {
			return false;
		}
		return true;
	}

	//获取当前时间
	function getTime(){
		return date('Y-m-d h:m:s',time());
	}

	//检查content字符长度
	function checkLength_c($content){
		if (mb_strlen($content) > 2000) {
			return false;
		}
		return true;
	}

	//检查title字符长度
	function checkLength_t($title){
		if (mb_strlen($title) > 120) {
			return false;
		}
		return true;
	}

	//根据tid获取主题详情
	public function getInfoById($tid){
		$topicInfo = $this
				->where(array('id'=>$tid))
				->field('title,content,publish_time,username,hits,collections,comments,node_name')
				->join('airex_user as u on u.id = airex_topic.uid')
				->join('airex_node as n on n.id = airex_topic.node_id')
				->select()[0];
		return $topicInfo;
	}

	//根据tid获取相应评论
	public function getCommentById($tid){
		$commentInfo = M('comment as c')
					->where(array('tid'=>$tid))
					->field('user_name,content,publish_time,imgpath')
					->join('airex_user as u on u.id = c.uid')
					->order('publish_time desc')
					->select()[0];
		return $commentInfo;
	}

	//检查tid是否存在
	public function checkTid($tid){
		$tids = $this->getField('id',true);
		if (!in_array($tid, $tids)) {
			return false;
		}
		return true;
	}
}