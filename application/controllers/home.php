<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->checkSession();
	}
	
	function checkSession(){
		if($this->session->userdata('email') == null || $this->session->userdata('email') == ""){
			redirect('/login/bye');
		}
	}
	public function index()
	{
		//$this->load->view('home_view');
		echo '- {domain}/new/company - should display the form for adding a new company
- {domain}/new/employee - should display the form for adding a new employee to a company
 -{domain}/company - should display all companies information in the database with capability to AJAX refresh the table
- {domain}/company/{company_id} - should display the information about the requested company
- {domain}/employees/{company_id} - should display all the employees in the company in a table
- {domain}/employees/{company_id}/{employee_id} - should display information about the employee along with a form to edit the employee details';
	}
	

	
	
	
	
}
