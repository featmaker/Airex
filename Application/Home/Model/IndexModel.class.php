<?php
/**
 * 主页模型类.
 * Author:Micanss
 * Date:2016/5/30
 * Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 */
namespace Home\Model;


class IndexModel{

	/**
	 * 获取首页用户信息展示
	 * @return array 获取的数据
	 */
    public function getUserInfo(){
        $uid = session('uid');
        $User = M("User");
        $data['userInfo'] = $User->where(array('id'=>$uid))
        			                   ->field('imgpath,attentions,topics,wealth,nodes')
                                 ->select()[0];
       	$data['notifications'] = M('reply')->where(array('to_uid'=>$uid,'is_read'=>'否'))
       									   ->count();
        return $data;
    }

    /**
     * 获取站点信息
     * @return [type] [description]
     */
    public function getSiteInfo(){
        $siteInfo['member_num'] = M('user as u')->field('count(u.id) as uc,count(t.id) as tc,count(c.id) as cs')->join('airex_topic as t')->join('airex_comment as c')->select();
        // $siteInfo['topic_num'] = M('topic')->count();
        // $siteInfo['comment_num'] = M('comment')->count();
        var_dump($siteInfo['member_num']);
        die;
        return $siteInfo['member_num'];
    }
}