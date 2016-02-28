<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
	}
	
	public function index()
	{
		$this->load->view('login_view');
	}
	
	/*The system is designed to have a max of 5 login attempts
		in which use won't be able to login again. 
	*/
	function auth(){
		$response = array();
		if(isset($_POST['username']) && isset($_POST['password'])){
			$this->load->model('auth_model');
			$username = strtolower($_POST['username']);
			$password = $_POST['password'];
			
			$userAuthDetails = $this->auth_model->getUserAuthDetails($username);
			if($userAuthDetails == null){
				$response['type'] = 'error';
				$response['msg'] = 'User does not exist!';
			}
			else if($userAuthDetails['last_attempt_count'] >= 5){
				$response['type'] = 'error';
				$response['msg'] = 'User is locked out.';
			}
			else{
				if($password == $this->encrypt->decode($userAuthDetails['password'])){
					$response['type'] = 'success';
					$response['msg'] = 'authenticated';
					$this->auth_model->clearAttempts($username);
					$this->session->set_userdata('email',$username);
				}
				else{
					$response['type'] = 'error';
					$response['msg'] = 'invalid login';
					$this->auth_model->increaseAttempt($username);
				}
			}
			
		}
		else{
			$response['type'] = 'error';
			$response['msg'] = 'Invalid post entries';
		}
		echo json_encode($response);
	}
	
	function bye(){
		$this->session->sess_destroy();
		redirect('/login');
	}
	
	function test(){
		echo $this->encrypt->encode('password');
	}
	
	
	
}
