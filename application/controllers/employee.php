<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('user'); //load MODEL
		$this->load->helper('text'); //for content limiter
		$this->load->helper('url'); //for content limiter
		$this->load->library('form_validation'); //load form validate rules
		$this->load->library('image_lib'); //load image library
		
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
		
		//check if its first record to auto Pension Code
		$data['new_code'] = '';
		$crec = $this->user->query_rec('bz_employee');
		if(!empty($crec)){
			$getcode = $this->user->query_rec('bz_employee');
			foreach($getcode as $code){
				$last_code = $code->pension_code;
			}
			$last_code = explode('-', $last_code);
			$increment = $last_code[1] + 1;
			$data['new_code'] = $last_code[0].'-'.$increment;
		}
		
		//check for update
		$get_id = $this->input->get('edit');
		if($get_id != ''){
			$gq = $this->user->query_rec_single('id', $get_id, 'bz_employee');
			foreach($gq as $item){
				$data['e_id'] = $item->id;
				$data['e_grade_id'] = $item->grade_id;
				$data['e_dept_id'] = $item->dept_id;
				$data['e_bank_id'] = $item->bank_id;
				$data['e_pension_code'] = $item->pension_code;
				$data['e_name'] = $item->name;
				$data['e_address'] = $item->address;
				$data['e_phone'] = $item->phone;
				$data['e_email'] = $item->email;
				$data['e_employ_date'] = $item->employ_date;
				$data['e_retire_date'] = $item->retire_date;
				$data['e_death_date'] = $item->death_date;
				$data['e_acc_no'] = $item->acc_no;
				$data['e_nk_name'] = $item->nk_name;
				$data['e_nk_address'] = $item->nk_address;
				$data['e_nk_phone'] = $item->nk_phone;
				
				//get username
				$gpass = $this->user->query_rec_single('centre_id', $item->id, 'bz_user');
				if(!empty($gpass)){
					foreach($gpass as $pass){
						$data['e_username'] = $pass->username;
					}
				}
			}
		}
		
		//check record delete
		$del_id = $this->input->get('del');
		if($del_id != ''){
			if($this->user->delete_rec('id', $del_id, 'bz_employee') > 0){
				$data['err_msg'] = '<div class="alert alert-info"><h5>Deleted</h5></div>';
			} else {
				$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
			}
		}
		
		//check if ready for post
		if($_POST){
			$employee_id = $_POST['employee_id'];
			$grade_id = $_POST['grade_id'];
			$dept_id = $_POST['dept_id'];
			$bank_id = $_POST['bank_id'];
			$pension_code = $_POST['pension_code'];
			$name = $_POST['name'];
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$employ_date = $_POST['employ_date'];
			$retire_date = $_POST['retire_date'];
			$death_date = $_POST['death_date'];
			$acc_no = $_POST['acc_no'];
			$nk_name = $_POST['nk_name'];
			$nk_address = $_POST['nk_address'];
			$nk_phone = $_POST['nk_phone'];
			
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			//check for update
			if($employee_id != ''){
				$upd_data = array(
					'grade_id' => $grade_id,
					'dept_id' => $dept_id,
					'bank_id' => $bank_id,
					'pension_code' => $pension_code,
					'name' => $name,
					'address' => $address,
					'phone' => $phone,
					'email' => $email,
					'employ_date' => $employ_date,
					'retire_date' => $retire_date,
					'death_date' => $death_date,
					'acc_no' => $acc_no,
					'nk_name' => $nk_name,
					'nk_address' => $nk_address,
					'nk_phone' => $nk_phone
				);
				
				if($this->user->update_rec('id', $employee_id, 'bz_employee', $upd_data) > 0){
					$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
				} else {
					$data['err_msg'] = '<div class="alert alert-info"><h5>No Changes Made</h5></div>';
				}
			} else {
				$reg_data = array(
					'grade_id' => $grade_id,
					'dept_id' => $dept_id,
					'bank_id' => $bank_id,
					'pension_code' => $pension_code,
					'name' => $name,
					'address' => $address,
					'phone' => $phone,
					'email' => $email,
					'employ_date' => $employ_date,
					'retire_date' => $retire_date,
					'death_date' => $death_date,
					'acc_no' => $acc_no,
					'nk_name' => $nk_name,
					'nk_address' => $nk_address,
					'nk_phone' => $nk_phone
				);
				
				$employee_id = $this->user->reg_rec('bz_employee', $reg_data);
				if($employee_id > 0){
					$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
				} else {
					$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
				}
			}
			
			//try add or update employee authentication
			$getauth = $this->user->query_rec_single('centre_id', $employee_id, 'bz_user');
			if(!empty($getauth)){
				//update auth only if password is supplied
				if($password != ''){
					$password = md5($password);
					$auth_upd = array(
						'username' => $username,
						'password' => $password,
						'email' => $email,
						'phone' => $phone,
						'firstname' => $name
					);
					$this->user->update_rec('centre_id', $employee_id, 'bz_user', $auth_upd);
				}
			} else {
				//check if username not picked
				$check = $this->user->query_rec_single('username', $username, 'bz_user');
				if(!empty($check)){
					$data['err_msg'] .= '<div class="alert alert-warning"><h5>Username already registered for another user, you can pick another when editing this employee record</h5></div>';
				} else {
					//create frest auth
					$password = md5($password);
					$auth_ins = array(
						'username' => $username,
						'password' => $password,
						'centre_id' => $employee_id,
						'role' => 'User',
						'email' => $email,
						'phone' => $phone,
						'firstname' => $name
					);
					$this->user->reg_rec('bz_user', $auth_ins);
				}
			}
		}
		
		//query uploads
		$data['allup'] = $this->user->query_rec('bz_employee');
		$data['allgrade'] = $this->user->query_rec('bz_grade');
		$data['alldepartment'] = $this->user->query_rec('bz_department');
		$data['allbank'] = $this->user->query_rec('bz_bank');
		
		$data['log_username'] = $this->session->userdata('log_username');
	  
	  	$data['title'] = 'Employees';
		$data['page_act'] = 'employee';

	  	$this->load->view('designs/header', $data);
		$this->load->view('designs/leftmenu', $data);
	  	$this->load->view('employee', $data);
	  	$this->load->view('designs/footer', $data);
	}
}