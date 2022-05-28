<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rates extends CI_Controller {
	
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
		
		if($this->session->userdata('itc_user_role') != 'Admin'){ 
			redirect(base_url().'profile/', 'location');
		}
		
		//check for update
		$get_id = $this->input->get('edit');
		if($get_id != ''){
			$gq = $this->user->query_rec_single('id', $get_id, 'bz_rate');
			foreach($gq as $item){
				$data['e_id'] = $item->id;
				$data['e_grade_id'] = $item->grade_id;	
				$data['e_rate'] = $item->rate;
			}
		}
		
		//check record delete
		$del_id = $this->input->get('del');
		if($del_id != ''){
			if($this->user->delete_rec('id', $del_id, 'bz_rate') > 0){
				$data['err_msg'] = '<div class="alert alert-info"><h5>Deleted</h5></div>';
			} else {
				$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
			}
		}
		
		//check if ready for post
		if($_POST){
			$rate_id = $_POST['rate_id'];
			$grade_id = $_POST['grade_id'];
			$rate = $_POST['rate'];
			
			//check for update
			if($rate_id != ''){
				$upd_data = array(
					'grade_id' => $grade_id,
					'rate' => $rate
				);
				
				if($this->user->update_rec('id', $rate_id, 'bz_rate', $upd_data) > 0){
					$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
				} else {
					$data['err_msg'] = '<div class="alert alert-info"><h5>No Changes Made</h5></div>';
				}
			} else {
				$reg_data = array(
					'grade_id' => $grade_id,
					'rate' => $rate
				);
				
				if($this->user->reg_rec('bz_rate', $reg_data) > 0){
					$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
				} else {
					$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
				}
			}
		}
		
		//query uploads
		$data['allup'] = $this->user->query_rec('bz_rate');
		$data['allgrade'] = $this->user->query_rec('bz_grade');
		
		$data['log_username'] = $this->session->userdata('log_username');
	  
	  	$data['title'] = 'Pension Rate';
		$data['page_act'] = 'setup';

	  	$this->load->view('designs/header', $data);
		$this->load->view('designs/leftmenu', $data);
	  	$this->load->view('rate', $data);
	  	$this->load->view('designs/footer', $data);
	}
}