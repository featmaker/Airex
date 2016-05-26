<?php 
namespace Home\Controller;
use Home\Controller\BaseController;

/**
* 用户控制器
*/
class UserController extends BaseController

{
	/**
	 *
	 * 验证码生成
	 */
	public function captcha(){
		$Verify = new \Think\Verify();
		$Verify->fontSize = 30;
		$Verify->length   = 4;
		$Verify->useNoise = false;
		$Verify->entry();
	}


	public function login(){
		$this->display();
	}



	public function register(){

		$this->display();
	}

	public function check_username(){
		$User = new \Home\Model\UserModel();
		$username = I('post.username');
		echo $User->check_username($username);

	}

	public function check_email(){
		$User = new \Home\Model\UserModel();
		$email = I('post.email');
		echo $User->check_email($email);

	}


	public function forgot(){

		$this->display();
	}

	public function userInfo(){
		$this->show('hello world');
	}
}