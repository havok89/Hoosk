<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 class Admincontrol_helper{
	 
	 
	 static function is_logged_in($userName)
	 {
		if(($userName=="")):
		$redirect= BASE_URL.'/admin/login';
		header("Location: $redirect");	
		exit;	
		endif;
	 }
 } 