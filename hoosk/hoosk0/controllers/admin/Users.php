<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		define("HOOSK_ADMIN",1);
		$this->load->model('Hoosk_model');
		$this->load->helper(array('admincontrol', 'url', 'form'));
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
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		$this->load->library('pagination');
    $result_per_page =15;  // the number of result per page
    $config['base_url'] = BASE_URL. '/admin/users/';
    $config['total_rows'] = $this->Hoosk_model->countUsers();
    $config['per_page'] = $result_per_page;
		$config['full_tag_open'] = '<div class="form-actions">';
		$config['full_tag_close'] = '</div>';
    $this->pagination->initialize($config);

		//Get users from database
		$this->data['users'] = $this->Hoosk_model->getUsers($result_per_page, $this->uri->segment(3));

		//Load the view
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/users', $this->data);
	}

	public function addUser()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the view
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/user_new', $this->data);
	}

	public function confirm()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form validation library
		$this->load->library('form_validation');
		//Set validation rules
		$this->form_validation->set_rules('username', 'username', 'trim|alpha_dash|required|is_unique[hoosk_user.userName]');
		$this->form_validation->set_rules('email', 'email address', 'trim|required|valid_email|is_unique[hoosk_user.email]');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('con_password', 'confirm password','trim|required|matches[password]');


		if($this->form_validation->run() == FALSE) {
			//Validation failed
			$this->addUser();
		}  else  {
			//Validation passed
			//Add the user
			$this->Hoosk_model->createUser();
			//Return to user list
			redirect('/admin/users', 'refresh');
	  	}
	}

	public function editUser()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Get user details from database
		$this->data['users'] = $this->Hoosk_model->getUser($this->uri->segment(4));
		//Load the view
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/user_edit', $this->data);
	}

	public function edited()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form validation library
		$this->load->library('form_validation');
		//Set validation rules
		$this->form_validation->set_rules('email', 'email address', 'trim|required|valid_email|is_unique[hoosk_user.email.userID.'.$this->uri->segment(4).']');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('con_password', 'confirm password','trim|required|matches[password]');


		if($this->form_validation->run() == FALSE) {
			//Validation failed
			$this->editUser();
		}  else  {
			//Validation passed
			//Update the user
			$this->Hoosk_model->updateUser($this->uri->segment(4));
			//Return to user list
			redirect('/admin/users', 'refresh');
	  	}
	}


		function delete()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		if($this->input->post('deleteid')):
			$this->Hoosk_model->removeUser($this->input->post('deleteid'));
			redirect('/admin/users');
		else:
			$this->data['form']=$this->Hoosk_model->getUser($this->uri->segment(4));
			$this->load->view('admin/user_delete.php', $this->data );
		endif;
	}

	/************** Forgotten Password Resets **************/

	public function forgot()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['header'] = $this->load->view('admin/headerlog', $this->data, true);
			$this->data['footer'] = $this->load->view('admin/footer', '', true);
			$this->load->view('admin/email_check', $this->data);
		}
		else
		{
			$email= $this->input->post('email');
			$this->load->helper('string');
			$rs= random_string('alnum', 12);
			$data = array(
			'rs' => $rs
			);
			$this->db->where('email', $email);
			$this->db->update('hoosk_user', $data);

			//now we will send an email
			$config['protocol'] = 'sendmail';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;


			$this->load->library('email', $config);

			$this->email->from('password@'.EMAIL_URL, SITE_NAME);
			$this->email->to($email);

			$this->email->subject($this->lang->line('email_reset_subject'));
			$this->email->message($this->lang->line('email_reset_message')."\r\n".BASE_URL.'/admin/reset/'.$rs );

			$this->email->send();
			$this->data['header'] = $this->load->view('admin/headerlog', $this->data, true);
			$this->data['footer'] = $this->load->view('admin/footer', '', true);
			$this->load->view('admin/check', $this->data);
		}
 }

	public function email_check($str)
	{
		$query = $this->db->get_where('hoosk_user', array('email' => $str), 1);
		if ($query->num_rows()== 1)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('email_check', $this->lang->line('email_check'));
			return false;
		}
	}


	public function getPassword()
	{
		$rs = $this->uri->segment(3);
		$query=$this->db->get_where('hoosk_user', array('rs' => $rs), 1);

     	if ($query->num_rows() == 0)
      	{
		    $this->data['header'] = $this->load->view('admin/headerlog', $this->data, true);
			$this->data['footer'] = $this->load->view('admin/footer', '', true);
			$this->load->view('admin/error', $this->data);

      	}
      	else
      	{
			$this->load->database();
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[20]|matches[con_password]');
			$this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required');
			if ($this->form_validation->run() == FALSE)
			{
				echo form_open();
				$this->data['header'] = $this->load->view('admin/headerlog', $this->data, true);
				$this->data['footer'] = $this->load->view('admin/footer', '', true);
				$this->load->view('admin/resetform', $this->data);
			}
			else
			{
				$query=$this->db->get_where('hoosk_user', array('rs' => $rs), 1);
				if ($query->num_rows() == 0)
				{
					show_error('Sorry!!! Invalid Request!');
				}
				else
				{
					$data = array(
					'password' => md5($this->input->post('password').SALT),
					'rs' => ''
					);
					$where=$this->db->where('rs', $rs);
					$where->update('hoosk_user',$data);
					$this->data['header'] = $this->load->view('admin/headerlog', $this->data, true);
					$this->data['footer'] = $this->load->view('admin/footer', '', true);
					$this->load->view('admin/reset', $this->data);
				}
			}
		}
	}

}
