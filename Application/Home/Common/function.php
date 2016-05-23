<?php 


function checkLogin(){
	if (session('?user')) {
		return true;
	}
	return false;
}