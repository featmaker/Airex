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

    //新增用户
    public function user_register($userinfo){

        $User = M("User");
        $User->data($userinfo)->add(); //USER表新增数据
        session('user',$userinfo['user_name']); //session 注册后进入已登录状态

    }

    //用户登录 返回0没有此用户 返回1登录成功 返回2密码错误
    public function user_login($userinfo){

        $User = M("User");
        $username = $userinfo['user_name'];
        $password = substr(sha1($userinfo['password']),0,32); //因为数据库只存了32位sha1，实际上sha1生成的是40位
        $data = $User->where('user_name = "'.$username.'"')->find();
        if($data){
            if($password == $data['password']){
                session('user',$data['user_name']); // 将已登录用户名加入SESSION
                session('avatar',$data['imgpath']); // 将已登录用户名加入SESSION
                return 1;
            }else{
                return 2;
            }
        }else{
            return 0;
        }

    }
	
}