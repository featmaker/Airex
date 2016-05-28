<?php 

function checkLogin(){
	if (session('user')) {
		return true;
	}
	return false;
}

//检查验证码
function check_verify($code, $id = ''){
	$verify = new \Think\Verify();
	return $verify->check($code, $id);

}


//返回真实IP
function get_real_ip(){
	$ip=false;
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	}
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
		if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
		for ($i = 0; $i < count($ips); $i++) {
			if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])) {
				$ip = $ips[$i];
				break;
			}
		}
	}
	return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

//得到用户头像
function get_avatar($username){

	$User = M("User");
	//$password = substr(sha1($userinfo['password']),0,32); //因为数据库只存了32位sha1，实际上sha1生成的是40位
	$data = $User->where('user_name = "'.$username.'"')->find();
	$avatar=$data['imgpath'];
	return $avatar;

}