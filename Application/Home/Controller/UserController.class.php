<?php 
namespace Home\Controller;
use Home\Controller\BaseController;
use Home\Model\FactoryModel;
/**
 * 用户控制器.
 * Author:Patrick95 (lawcy@qq.com)
 * Date:2016/5/27
 * Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 */
class UserController extends BaseController{

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
		if (checkLogin()) {
			$this->redirect("Index/index",'',0);
		}
		if (IS_POST){
			$User = FactoryModel::createUserModel();
			$postinfo=array("user_name"=>I('post.username'),"password"=>I('post.password'));
			switch($User->user_login($postinfo)){
				case 0: //无此用户
					$this->error('没有此用户！');
					break;
				case 1: //登录成功
					$User->update_loginIP($postinfo['user_name']); //更新用户登录IP
					$this->redirect("Index/index",'',0); //转向首页
					//$this->success('登录成功，正在转向首页...',__ROOT__."/",2);
					//$this->success('登录成功！');
					break;
				case 2: //密码不对
					$this->error('用户名或密码不正确！');
					break;
			}
		}else{
			$this->display();
		}

	}


	//注册
	public function register(){
		if (checkLogin()) {
			$this->redirect("Index/index",'',0);
		}
		$User = FactoryModel::createUserModel();
		if (IS_POST){
			if(check_verify(I('post.captcha'))){

				$postinfo=array("user_name"=>I('post.username'),"password"=>I('post.password'),"email"=>I('post.email'));
				//自动验证
				if ($User->user_register($postinfo)) {
					$this->success('注册成功！','login'); //注册成功转向登录页
				}else{
					$this->error($User->getError());
				}


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
		if (checkLogin()) {
			$this->redirect("Index/index",'',0);
		}
		if(IS_POST){
			$User = FactoryModel::createUserModel();
			$email = I('post.email'); //得到参数email
			if($username = $User->get_username_by_email($email)){ //此email是否存在数据库中
				if($User->send_resetpw_email($email,$username)){  //发送邮件给此email
					$this->success('重置密码邮件发送成功！',U('Index/index'));
				}else{
					$this->error('邮件发送失败');
				}
			}else{
				$this->error('不存在此邮箱');
			}

		}else{
			$this->display();
		}
	}

	//重置密码
	public function resetpw(){
		if (checkLogin()) {
			$this->redirect("Index/index",'',0);
		}
		if(I('get.hash')){  //如果存在hash参数
			$hash = I('get.hash');
			if(session('?'.$hash)){ //如果session中存在此hash
				$username = session($hash);  //得到hash中的用户名
				$this->assign('username',$username); //将用户名输出到前端
				$this->display();
			}else{
				$this->error('不存在此重置密钥或已失效',U('Index/index'));
			}
		}else{
			$this->error('非法操作',U('Index/index'));
		}


	}

	//登出
	public function logout(){
		session('user',null);
		session('user_id',null);
		$this->redirect("User/login",'',0);
	}

	public function userInfo(){
		$this->show('hello world');
	}

	public function setting(){
		$this->display();
	}
}