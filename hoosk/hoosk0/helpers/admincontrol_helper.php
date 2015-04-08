<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 class Admincontrol_helper{
	 
	 
	 function is_logged_in()
	 {
		if(($this->session->userdata('userName')=="")):
		$redirect= BASE_URL.'/admin/login';
		header("Location: $redirect");	
		exit;	
		endif;
	 }
 } 