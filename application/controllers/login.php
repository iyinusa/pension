<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
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

		if($this->session->userdata('logged_in')==TRUE){ 
			redirect(base_url(), 'location');
		}
		
		
		$this->form_validation->set_rules('username','Username/Email','trim|required|xss_clean');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[32]|xss_clean|md5');
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i>', '</div>'); //error delimeter
		
		if ($this->form_validation->run() == FALSE) {
			$data['err_msg'] = '';
		} else {
			//check if ready for post
			if($_POST) {
				$username = $_POST['username'];
				$password = $_POST['password'];
				if(isset($_POST['remind'])){$remind='';}else{$remind='';}
				
				if($this->user->check_auth($username, $password) <= 0) {
					$data['err_msg'] = '<div class="alert alert-warning no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i> Invalid authentication.</div>';		
				} else {
					$query = $this->user->check_auth($username, $password);
					if(!empty($query)) {
						foreach($query as $row) {
							//update status
							$now = date("Y-m-d H:i:s");
							
							//add data to session
							$s_data = array (
								'log_user_id' => $row->user_id,
								'log_username' => $row->username,
								'log_email' => $row->email,
								'log_firstname' => $row->firstname,
								'log_lastname' => $row->lastname,
								'itc_user_role' => $row->role,
								'itc_user_centre' => $row->centre_id,
								'logged_in' => TRUE
							);
						}
						
						$check = $this->session->set_userdata($s_data);
						
						$data['err_msg'] = '<div class="alert alert-success no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i> Successful! - Thanks for signing in.</div>';
						
						if($row->role == 'Admin'){
							redirect(base_url().'departments', 'location');
						} else {
							redirect(base_url().'profile', 'location');
						}
						
						//if first time logged, push to group page to select group(s)
						//if($first_log==''){
//							redirect(base_url().'setting/profile', 'location');
//						} else {
//							$red_profile = $this->session->userdata('log_username');
//							redirect(base_url().'member/'.$red_profile, 'location');
//						}
					}
				}
			}
		}
	  
	  	$data['title'] = 'Sign In | '.app_name;

	  	$this->load->view('designs/hm_header', $data);
	  	$this->load->view('login', $data);
	  	$this->load->view('designs/hm_footer', $data);
	}
}