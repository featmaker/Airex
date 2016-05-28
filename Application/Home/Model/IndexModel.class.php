<?php
namespace Home\Model;

use Think\Model;

/**
 * 主页模型类.
 * Author:Patrick95
 * Date:2016/5/28
 * Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 */
class IndexModel{

    //得到用户信息并返回数组
    public function get_userinfo(){
        $username = I('session.user');
        $User = M("User");
        $data = $User->where('user_name = "'.$username.'"')->find();
        return $data;
    }

}