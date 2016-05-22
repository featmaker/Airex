<?php 
namespace Home\Controller;
use Home\Controller\BaseController;

/**
* 用户控制器
*/
class UserController extends BaseController
{

	public function login(){
		$this->display();
	}

	public function register(){
		$this->display();
	}
}