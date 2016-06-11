<?php 
namespace Home\Model;
use Think\Model;

/**
* f
*/
class CommentModel extends Model
{
	
	/**
	 * 根据tid获取相应评论
	 * @param  [type] $tid [description]
	 * @return [type]      [description]
	 */
	public function getCommentByTid($tid){
		$commentInfo = $this
					->where(array('tid'=>$tid))
					->field('user_name,content,publish_time,imgpath')
					->join('airex_user as u on u.id = airex_comment.uid')
					->order('publish_time desc')
					->select();
		return $commentInfo;
	}

}