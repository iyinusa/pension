<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deducts extends CI_Controller {
	
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
		
		//check record delete
		$del_id = $this->input->get('del');
		if($del_id != ''){
			if($this->user->delete_rec('id', $del_id, 'bz_deduct') > 0){
				//remove all deduction details
				$this->user->delete_rec('deduct_id', $del_id, 'bz_deduct_details');
				$data['err_msg'] = '<div class="alert alert-info"><h5>Deleted</h5></div>';
			} else {
				$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
			}
		}
		
		//try and get deduction id if exist
		$day = date('d');
		$month = date('F');
		$year = date('Y');
		$data['alldeduct'] = '';
		$data['allemployee'] = '';
		
		$getded = $this->user->query_rec_double('month', $month, 'year', $year, 'bz_deduct');
		if(!empty($getded)){
			foreach($getded as $ded){
				$data['e_id'] = $ded->id;	
			}
		}
		
		//check deduction calculation
		$get_id = $this->input->get('deduct');
		if($get_id != ''){
			$data['allemployee'] = $this->user->query_rec('bz_employee');
			if($get_id == 0){
				//fresh deduction
			} else {
				//load month deduction
				$data['alldeduct'] = $this->user->query_rec_single('deduct_id', $get_id, 'bz_deduct_details');
			}
		}
		
		//check if ready for post
		if($_POST){
			$deduct_id = $_POST['deduct_id'];
			if(isset($_POST['emp'])) {
				$emp = $_POST['emp'];
			} else {
				$emp = '';
			}
			
			if($emp == ''){
				$data['err_msg'] = '<div class="alert alert-warning"><h5>No Staff Selected</h5></div>';
			} else {
				//register deduction if not exist
				if($deduct_id == ''){
					$dreg_data = array(
						'month' => $month,
						'year' => $year
					);
					$deduct_id = $this->user->reg_rec('bz_deduct', $dreg_data);
				}
				
				$count = count($emp);
				for($i=0; $i<$count; $i++){
					//check for deduction not computed
					$check = $this->user->query_rec_double('deduct_id', $deduct_id, 'emp_id', $emp[$i], 'bz_deduct_details');
					if(empty($check)){
						////////compute deduction
						//get grade salary and rate
						$salary = 0;
						$rate = 0;
						$getemp = $this->user->query_rec_single('id', $emp[$i], 'bz_employee');
						if(!empty($getemp)){
							foreach($getemp as $gemp){
								//get salary
								$getsal = $this->user->query_rec_single('id', $gemp->grade_id, 'bz_grade');
								if(!empty($getsal)){
									foreach($getsal as $sal){
										$salary = $sal->salary;	
										
										//get rate
										$getrate = $this->user->query_rec_single('grade_id', $sal->id, 'bz_rate');
										if(!empty($getrate)){
											foreach($getrate as $gr){
												$rate = $gr->rate;	
											}
										}
									}
								}
							}
						}
						
						$amt = ($rate / 100) * $salary;
						
						$reg_data = array(
							'deduct_id' => $deduct_id,
							'emp_id' => $emp[$i],
							'amt' => $amt,
							'day' => $day,
							'month' => $month,
							'year' => $year,
						);
						
						$this->user->reg_rec('bz_deduct_details', $reg_data);
						$data['err_msg'] = '<div class="alert alert-success"><h5>Done!</h5></div>';
					}
				}
			}
		}
		
		//query uploads
		$data['allup'] = $this->user->query_rec('bz_deduct');
		
		$data['log_username'] = $this->session->userdata('log_username');
	  
	  	$data['title'] = 'Deductions';
		$data['page_act'] = 'deduct';

	  	$this->load->view('designs/header', $data);
		$this->load->view('designs/leftmenu', $data);
	  	$this->load->view('deduct', $data);
	  	$this->load->view('designs/footer', $data);
	}
}