<?php 
namespace Home\Controller;
use Home\Controller\BaseController;
use Home\Model\FactoryModel;
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

	//登录
	public function login(){
		$User = FactoryModel::createUserModel();
		if (IS_POST){
			$postinfo=array("user_name"=>I('post.username'),"password"=>sha1(I('post.password')));
			switch($User->user_login($postinfo)){
				case 0:
					$this->error('没有此用户！');
					break;
				case 1:
					$this->success('登录成功！');
					break;
				case 2:
					$this->error('用户名或密码不正确！');
					break;
			}
		}else{
			$this->display();
		}

	}


	//注册
	public function register(){

		$User = FactoryModel::createUserModel();
		if (IS_POST){
			if(check_verify(I('post.captcha'))){

				//留空字段验证，待补
				$postinfo=array("user_name"=>I('post.username'),"password"=>sha1(I('post.password')),"email"=>I('post.email'));
				$User->user_register($postinfo);
				$this->success('注册成功！');

			}else{
				$this->error('验证码错误，请重新输入！');
			}

		}else{

			$this->display();
		}

	}

	//AJAX检查用户名
	public function check_username(){
		$User = FactoryModel::createUserModel();
		// $User = new \Home\Model\UserModel();
		$username = I('post.username');
		echo $User->check_username($username);

	}

	//AJAX检查EMAIL
	public function check_email(){
		$User = FactoryModel::createUserModel();
		// $User = new \Home\Model\UserModel();
		$email = I('post.email');
		echo $User->check_email($email);

	}

	//忘记密码
	public function forgot(){

		$this->display();
	}

	public function userInfo(){
		$this->show('hello world');
	}
}