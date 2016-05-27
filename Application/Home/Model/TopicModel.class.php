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
}