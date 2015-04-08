<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		define("HOOSK_ADMIN",1);
		$this->load->model('Hoosk_model');
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->helper('admincontrol');
		$this->load->library('session');
		define ('LANG', $this->Hoosk_model->getLang());
		$this->lang->load('admin', LANG);
		//Define what page we are on for nav
		$this->data['current'] = $this->uri->segment(2);
		define ('SITE_NAME', $this->Hoosk_model->getSiteName());
		define('THEME', $this->Hoosk_model->getTheme());
		define ('THEME_FOLDER', BASE_URL.'/theme/'.THEME);
	}
	
	public function index()
	{
		Admincontrol_helper::is_logged_in();
		$this->load->library('pagination');

        $result_per_page =15;  // the number of result per page

        $config['base_url'] = BASE_URL. '/admin/posts/';
        $config['total_rows'] = $this->Hoosk_model->countPosts();
        $config['per_page'] = $result_per_page;
		$config['full_tag_open'] = '<div class="form-actions">';
		$config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);

		//Get posts from database
		$this->data['posts'] = $this->Hoosk_model->getPosts($result_per_page, $this->uri->segment(3)); 
		//Load the view
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/posts', $this->data);
	}
	
	public function addPost()
	{
		Admincontrol_helper::is_logged_in();
		//Load the form helper
		$this->load->helper('form');
		$this->data['categories'] = $this->Hoosk_model->getCategories(); 
		//Load the view
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/newpost', $this->data);
	}
	
	public function confirm()
	{
		Admincontrol_helper::is_logged_in();
		//Load the form validation library
		$this->load->library('form_validation');
		//Set validation rules
		$this->form_validation->set_rules('postURL', 'post URL', 'trim|alpha_dash|required|is_unique[hoosk_post.postURL]');
		$this->form_validation->set_rules('postTitle', 'post title', 'trim|required');
		$this->form_validation->set_rules('postExcerpt', 'post excerpt', 'trim|required');
		
		if($this->form_validation->run() == FALSE) {
			
			//Validation failed
			$this->addPost();
		}  else  {
			//Validation passed
			if ($this->input->post('postImage') != ""){
			//path to save the image
			$path_upload = $_SERVER["DOCUMENT_ROOT"] . '/uploads/';
			$path_images = $_SERVER["DOCUMENT_ROOT"] . '/images/';
			//moving temporary file to images folder
			rename($path_upload . $this->input->post('postImage'), $path_images . $this->input->post('postImage'));
			}
			//Add the post
			$this->load->library('Sioen');
			$this->Hoosk_model->createPost();
			//Return to post list
			redirect('/admin/posts', 'refresh');
	  	}
	}
	
	public function editPost()
	{
		Admincontrol_helper::is_logged_in();
		//Load the form helper
		$this->load->helper('form');
		$this->data['categories'] = $this->Hoosk_model->getCategories(); 
		//Get post details from database
		$this->data['posts'] = $this->Hoosk_model->getPost($this->uri->segment(4)); 
		//Load the view
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/editpost', $this->data);
	}
	
	public function edited()
	{
		Admincontrol_helper::is_logged_in();
		//Load the form validation library
		$this->load->library('form_validation');
		//Set validation rules
		$this->form_validation->set_rules('postURL', 'post URL', 'trim|alpha_dash|required|is_unique[hoosk_post.postURL.postID.'.$this->uri->segment(4).']');
		$this->form_validation->set_rules('postTitle', 'post title', 'trim|required');
		
		if($this->form_validation->run() == FALSE) {
			//Validation failed
			$this->editPost();
		}  else  {
			//Validation passed
			if ($this->input->post('postImage') != ""){
			//path to save the image
			$path_upload = $_SERVER["DOCUMENT_ROOT"] . '/uploads/';
			$path_images = $_SERVER["DOCUMENT_ROOT"] . '/images/';
			//moving temporary file to images folder
			rename($path_upload . $this->input->post('postImage'), $path_images . $this->input->post('postImage'));
			}
			//Update the post
			$this->load->library('Sioen');
			$this->Hoosk_model->updatePost($this->uri->segment(4));
			//Return to post list
			redirect('/admin/posts', 'refresh');
	  	}
	}
	
	
	
	public function delete()
	{
		Admincontrol_helper::is_logged_in();
		//Delete the post account
		$this->Hoosk_model->removePost($this->uri->segment(4));
		//Return to post list
		redirect('/admin/posts', 'refresh');
	}
	
	
	
}
