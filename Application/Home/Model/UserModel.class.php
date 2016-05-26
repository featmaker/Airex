<?php 
namespace Home\Model;

use Think\Model;

/**
* 用户模型类
*/
class UserModel extends Model{

    //AJAX检查用户名是否占用
    public function check_username($username){

        $user = M("user"); // 实例化数据表airex_user对象
        $data = $user->where("user_name='$username'")->find();
        if($data){
            $msg = array('occupied'=>1);
            return json_encode($msg);
        }else{
            $msg = array('occupied'=>0);
            return json_encode($msg);
        }

    }

    //AJAX检查邮箱是否占用
    public function check_email($email){

        $user = M("user"); // 实例化数据表airex_user对象
        $data = $user->where("email='$email'")->find();
        if($data){
            $msg = array('occupied'=>1);
            return json_encode($msg);
        }else{
            $msg = array('occupied'=>0);
            return json_encode($msg);
        }

    }
	
}