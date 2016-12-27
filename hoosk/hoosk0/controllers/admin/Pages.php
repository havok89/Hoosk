<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		define("HOOSK_ADMIN",1);
		$this->load->model('Hoosk_model');
		$this->load->helper(array('admincontrol', 'url', 'hoosk_admin', 'file', 'form'));
		$this->load->library('session');
		define ('LANG', $this->Hoosk_model->getLang());
		$this->lang->load('admin', LANG);
		//Define what page we are on for nav
		$this->data['current'] = $this->uri->segment(2);
		define ('SITE_NAME', $this->Hoosk_model->getSiteName());
		define('THEME', $this->Hoosk_model->getTheme());
		define ('THEME_FOLDER', BASE_URL.'/theme/'.THEME);
		//check session exists
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
	}

	public function index()
	{
 		$this->load->library('pagination');
    $result_per_page =15;  // the number of result per page
    $config['base_url'] = BASE_URL. '/admin/pages/';
    $config['total_rows'] = $this->Hoosk_model->countPages();
    $config['per_page'] = $result_per_page;
		$config['full_tag_open'] = '<div class="form-actions">';
		$config['full_tag_close'] = '</div>';
    $this->pagination->initialize($config);
		//Get pages from database
    $this->data['pages'] = $this->Hoosk_model->getPages($result_per_page, $this->uri->segment(3));

		//Load the view
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/pages', $this->data);
	}

	public function addPage()
	{
		//Load the view
		$this->data['templates'] = get_filenames('theme/'.THEME.'/templates');
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/page_new', $this->data);
	}

	public function confirm()
	{
		//Load the form validation library
		$this->load->library('form_validation');
		//Set validation rules
		$this->form_validation->set_rules('pageURL', 'page URL', 'trim|alpha_dash|required|is_unique[hoosk_page_attributes.pageURL]');
		$this->form_validation->set_rules('pageTitle', 'page title', 'trim|required');
		$this->form_validation->set_rules('navTitle', 'navigation title', 'trim|required');

		if($this->form_validation->run() == FALSE) {
			//Validation failed
			$this->addPage();
		}  else  {
			//Validation passed
			//Add the page
			$this->load->library('Sioen');
			$this->Hoosk_model->createPage();
			//Return to page list
			redirect('/admin/pages', 'refresh');
	  	}
	}

	public function editPage()
	{
		//Get page details from database
		$this->data['pages'] = $this->Hoosk_model->getPage($this->uri->segment(4));
		//Load the view
		$this->data['templates'] = get_filenames('theme/'.THEME.'/templates');
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/page_edit', $this->data);
	}

	public function edited()
	{
		//Load the form validation library
		$this->load->library('form_validation');
		//Set validation rules
		if ($this->uri->segment(4) != 1){
		$this->form_validation->set_rules('pageURL', 'page URL', 'trim|alpha_dash|required|is_unique[hoosk_page_attributes.pageURL.pageID.'.$this->uri->segment(4).']');
		}
		$this->form_validation->set_rules('pageTitle', 'page title', 'trim|required');
		$this->form_validation->set_rules('navTitle', 'navigation title', 'trim|required');

		if($this->form_validation->run() == FALSE) {
			//Validation failed
			$this->editPage();
		}  else  {
			//Validation passed
			//Update the page
			$this->load->library('Sioen');
			$this->Hoosk_model->updatePage($this->uri->segment(4));
			//Return to page list
			redirect('/admin/pages', 'refresh');
	  	}
	}

	public function jumbo()
	{
		//Get page details from database
		$this->data['pages'] = $this->Hoosk_model->getPage($this->uri->segment(4));
		$this->data['slides'] = $this->Hoosk_model->getPageBanners($this->uri->segment(4));

		//Load the view
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/jumbotron_edit', $this->data);
	}

	public function jumboAdd()
	{
		$this->load->library('Sioen');
		$this->Hoosk_model->updateJumbotron($this->uri->segment(4));
		redirect('/admin/pages', 'refresh');
	}



	function delete()
	{
		if($this->input->post('deleteid')):
			$this->Hoosk_model->removePage($this->input->post('deleteid'));
			redirect('/admin/pages');
		else:
			$this->data['form']=$this->Hoosk_model->getPage($this->uri->segment(4));
			$this->load->view('admin/page_delete.php', $this->data );
		endif;
	}

}
