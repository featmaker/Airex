<?php 
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Author: Micanss <micanss@gmail.com>
// +----------------------------------------------------------------------
namespace Home\Model;
use Think\Model;

/**
* 后台主题控制器
*/
class TopicModel extends Model
{	
	//自动验证
	protected $_validate = array(
		array('title','require','主题标题不能为空.',1),
		array('title','checkLength_t','标题不要超过120个字符',1,'callback'),
		array('content','require','主题内容不能为空',1),
		array('content','checkLength_c','话题内容不要超过2000个字符',1,'callback'),
		array('node_name','checkNodeName','请不要修改node值.',1,'callback'),
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

	/**
	 * 追加主题内容
	 * @param  [type] $tid     [description]
	 * @param  [type] $content [description]
	 * @return [type]          [description]
	 */
	public function appendContent($tid,$content){
		$originContent = $this->where(array('id'=>$tid))->getField('content');
		$newContent = $originContent.'<br>'.$content;
		if ($this->where(array('id'=>$tid))->setField('content',$newContent)) {
			return true;
		}
		return false;
	}

	/**
	 * 检查所属节点值
	 * @param  [type] $nodeId [description]
	 * @return [type]         [description]
	 */
	function checkNodeName($nodeName){
		$nodeNames = M('node')->getField('node_name',true);
		if (!in_array($nodeName, $nodeNames)) {
			return false;
		}
		return true;
	}

	/**
	 * 获取当前时间
	 * @return [type] [description]
	 */
	function getTime(){
		return date('Y-m-d h:m:s',time());
	}

	/**
	 * 检查content字符长度
	 * @param  [type] $content [description]
	 * @return [type]          [description]
	 */
	function checkLength_c($content){
		if (mb_strlen($content) > 2000) {
			return false;
		}
		return true;
	}

	/**
	 * 检查title字符长度
	 * @param  [type] $title [description]
	 * @return [type]        [description]
	 */
	function checkLength_t($title){
		if (mb_strlen($title) > 120) {
			return false;
		}
		return true;
	}

	/**
	 * 根据tid获取主题详情
	 * @param  [type] $tid [description]
	 * @return [type]      [description]
	 */
	public function getDataById($tid){
		$topicInfo = $this
				->where(array('airex_topic.id'=>$tid))
				->field('title,content,publish_time,user_name,airex_topic.hits as hits,collections,comments,node_name')
				->join('airex_user as u on u.id = airex_topic.uid')
				->select()[0];
		return $topicInfo;
	}

	/**
	 * 根据tid获取相应评论
	 * @param  [type] $tid [description]
	 * @return [type]      [description]
	 */
	public function getCommentById($tid){
		$commentInfo = M('comment as c')
					->where(array('tid'=>$tid))
					->field('user_name,content,publish_time,imgpath')
					->join('airex_user as u on u.id = c.uid')
					->order('publish_time desc')
					->select();
		return $commentInfo;
	}

	/**
	 * 检查tid是否存在
	 * @param  [type] $tid [description]
	 * @return [type]      [description]
	 */
	public function checkTid($tid){
		$tids = $this->getField('id',true);
		if (!in_array($tid, $tids)) {
			return false;
		}
		return true;
	}

	// public function getPageData(){
	// 	$p = I('get.p') ? I('get.p') : 1;
	// 	$count = $this->count();
	// 	$limit = C('PAGE_SIZE');
	// 	// $page = new \Org\Airex\Page($count,$limit);
	// 	$page = new \Think\Page($count,$limit);
	// 	$data['show'] = $page->show();
	// 	$data['lists'] = $this->page($p.','.$limit)->select();
	// 	return $data;
	// }

	/**
	 * 根据分类获取相应主题
	 * @param  [type] $cat [description]
	 * @return [type]      [description]
	 */
	public function getTopicsByCat($catName = ''){
		if ($catName == '') {
			$catName = M('category')->getField('cat_name');
		}
		$p = I('get.p') ? I('get.p') : 1;
		$count = $this->where(array('cat_name'=>$catName))
					  ->count();
		$limit = C('PAGE_SIZE');
		$page = new \Think\Page($count,$limit);
		$topics['show'] = $page->show();
		$topics['lists'] =$this->where(array('cat_name'=>$catName))
							   ->join('left join airex_user as u on u.id = airex_topic.uid')
							   ->field('publish_time,title,imgpath,comments,user_name,node_name,airex_topic.id as tid')
							   ->page($p.','.$limit)
							   ->select();

		return $topics;
	}

}