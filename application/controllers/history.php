<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class History extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('user'); //load MODEL
		$this->load->helper('text'); //for content limiter
		$this->load->library('form_validation'); //load form validate rules
		
		//mail config settings
		$this->load->library('email'); //load email library
		//$config['protocol'] = 'sendmail';
		//$config['mailpath'] = '/usr/sbin/sendmail';
		//$config['charset'] = 'iso-8859-1';
		//$config['wordwrap'] = TRUE;
		
		//$this->email->initialize($config);
    }
	
	public function index() {
		if($this->session->userdata('logged_in')==FALSE){ 
			redirect(base_url().'login/', 'location');
		}
		
		$user_id = $this->session->userdata('itc_user_centre');
		
		//query uploads
		$data['allup'] = $this->user->query_rec_single('emp_id', $user_id, 'bz_deduct_details');
		
		$data['log_username'] = $this->session->userdata('log_username');
	  
	  	$data['title'] = 'Deduction History';
		$data['page_act'] = 'history';

	  	$this->load->view('designs/header', $data);
		$this->load->view('designs/leftmenu', $data);
	  	$this->load->view('history', $data);
	  	$this->load->view('designs/footer', $data);
	}
}