<?php 
namespace Home\Controller;
use Home\Controller\BaseController;
/**
* 评论控制器
*/
class CommentController extends BaseController
{
	/**
	 * 新增评论
	 */
	public function add(){
		if (IS_AJAX) {
			$data['tid'] = I('post.tid','','intval');
			$Topic = D('Topic');
			if (!$Topic->checkTid($data['tid'])) {
				$this->ajaxReturn('no');
			}
			$data['content'] = I('post.content','','trim');
			if ($data['content'] == '') {
				$this->ajaxReturn('no');
			}
			$data['publish_time'] = date('Y-m-d H:i:s',time());
			$data['uid'] = session('uid');
			$dta['type'] = '评论';
			if (M('Comment')->add($data)) {
				$this->trigger($Topic,$data);
				$this->ajaxReturn('yes');
			}else{
				$this->ajaxReturn('no');
			}
		}
	}

	/**
	 * 触发更新
	 * @param  [type] $tid   [description]
	 * @param  [type] $Topic [description]
	 * @return [type]        [description]
	 */
	public function trigger($Topic,$data){
		M('siteinfo')->where(['id'=>1])->setInc('comment_num');
		$Topic->where(['id'=>$data['tid']])->setInc('comments');
		$Topic->last_comment_user = session('user');
		$Topic->last_comment_time = $data['publish_time'];
		$Topic->where(['id'=>$data['tid']])->save();
	}
}