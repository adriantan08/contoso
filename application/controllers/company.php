<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class company extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->checkSession();
	}
	
	function checkSession(){
		if($this->session->userdata('email') == null || $this->session->userdata('email') == ""){
			redirect('/login/bye');
		}
	}
	
	function companylist(){
		echo json_encode($this->company_model->getCompanyList());
	}
	
	function index(){
		$this->load->view('company/company_view');
	}
	function search($id){
		$company = $this->company_model->searchCompanyById($id);
		if($company!=null){
			echo 'NAME: '.$company['company_name'];
		}
		else{
			echo 'Company not found!';
		}
	}
	
	
}
