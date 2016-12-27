<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hoosk_default extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Hoosk_page_model');
		$this->load->helper('hoosk_page_helper');
		define ('SITE_NAME', $this->Hoosk_page_model->getSiteName());
		define ('THEME', $this->Hoosk_page_model->getTheme());
		define ('THEME_FOLDER', BASE_URL.'/theme/'.THEME);
		$this->data['settings']=$this->Hoosk_page_model->getSettings();
	}


	public function index()
	{
		$totSegments = $this->uri->total_segments();
		if(!is_numeric($this->uri->segment($totSegments))){
		$pageURL = $this->uri->segment($totSegments);
		} else if(is_numeric($this->uri->segment($totSegments))){
		$pageURL = $this->uri->segment($totSegments-1);
		}
		if ($pageURL == ""){ $pageURL = "home"; }
		$this->data['page']=$this->Hoosk_page_model->getPage($pageURL);
		if ($this->data['page']['pageTemplate'] != ""){
		$this->data['header'] = $this->load->view('templates/header', $this->data, true);
		$this->data['footer'] = $this->load->view('templates/footer', '', true);
		$this->load->view('templates/'.$this->data['page']['pageTemplate'], $this->data);
		} else {
			$this->error();
		}
	}

		public function category()
	{
		$catSlug = $this->uri->segment(2);
		$this->data['page']=$this->Hoosk_page_model->getCategory($catSlug);
		if ($this->data['page']['categoryID'] != ""){
		$this->data['header'] = $this->load->view('templates/header', $this->data, true);
		$this->data['footer'] = $this->load->view('templates/footer', '', true);
		$this->load->view('templates/category', $this->data);
		} else {
			$this->error();
		}
	}

		public function article()
	{
		$articleURL = $this->uri->segment(2);
		$this->data['page']=$this->Hoosk_page_model->getArticle($articleURL);
		if ($this->data['page']['postID'] != ""){
		$this->data['header'] = $this->load->view('templates/header', $this->data, true);
		$this->data['footer'] = $this->load->view('templates/footer', '', true);
		$this->load->view('templates/article', $this->data);
		} else {
			$this->error();
		}
	}

	public function error()
	{
		$this->data['page']['pageTitle']="Oops, Error";
		$this->data['page']['pageDescription']="Oops, Error";
		$this->data['page']['pageKeywords']="Oops, Error";
		$this->data['page']['pageID']="0";
		$this->data['page']['pageTemplate']="error";
		$this->data['header'] = $this->load->view('templates/header', $this->data, true);
		$this->data['footer'] = $this->load->view('templates/footer', '', true);
		$this->load->view('templates/'.$this->data['page']['pageTemplate'], $this->data);
	}
	
	public function feed()
	{
		
		if (($this->uri->segment(2)=="atom")||($this->uri->segment(2)=="rss"))
		{
		$posts = getFeedPosts();
		$this->load->library('feed');
		$feed = new Feed();
		$feed->title = SITE_NAME;
		$feed->description = SITE_NAME;
		$feed->link = BASE_URL;
		$feed->pubdate = date("m/d/y H:i:s", $posts[0]['unixStamp']);
		foreach ($posts as $post)
		{
			$feed->add($post['postTitle'], BASE_URL.'/article/'.$post['postURL'], date("m/d/y H:i:s", $post['unixStamp']), $post['postExcerpt']);
		}
		$feed->render($this->uri->segment(2));
		} else {
			$this->error();
		}
	}
}
