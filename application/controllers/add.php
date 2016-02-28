<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class add extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->checkSession();
	}
	
	function checkSession(){
		if($this->session->userdata('email') == null || $this->session->userdata('email') == ""){
			redirect('/login/bye');
		}
	}
	
	function company(){
		$this->load->view('/company/new_view');
		
	}
	function employee(){
		$companies = $this->company_model->getCompanyList();
		if($companies==null){
			echo 'Please enter at least one company!';
		}
		else{
			$data['companies'] = $companies;
			$this->load->view('/employees/new_view',$data);
		}
		
	}
	
	function newemployee(){
		$response = array();
		if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['companyId'])){
			$employeeName = $_POST['name'];
			$employeeEmail = $_POST['email'];
			$companyId = $_POST['companyId'];
			$companyList = $this->company_model->getCompanyList();
			$employeeList = $this->employee_model->getEmployeeList();
			
			if(array_key_exists($employeeEmail, $employeeList)){
				$response['type'] = 'error';
				$response['msg'] = 'Emplyoee\'s email already exist! Trying adding some numbers.';
			}
			else{
				$temp = explode('|',$this->employee_model->insertEmployee($employeeName, $employeeEmail));
				$insertStatus = $temp[0];
				$insertId = $temp[1];
				
				if($insertStatus > 0){
					$insertEmpToCompanyStatus = $this->company_model->insertEmployeesToCompanies($companyId, $insertId);
					
					if($insertEmpToCompanyStatus>0){
						$response['type'] = 'success';
						$response['msg'] = 'Employee '.$employeeName.' has been encoded!';
					}
					else{
						$this->employee_model->deleteEmployee($insertId);
						$response['type'] = 'error';
						$response['msg'] = 'Employee record has been inserted, but there was a problem registering the employee to the company. We have reverted your employee insert. Please try again.';
					}
				}
				else{
					$response['type'] = 'error';
					$response['msg'] = 'Error during inserting!';
				}
			}
			
		}
		else{
			$response['type'] = 'error';
			$response['msg'] = 'POST Data error';
		}
		
		echo json_encode($response);
	}
	
	function newcompany(){
		$response = array();
		if(isset($_POST['name'])){
			$companyName = $_POST['name'];
			$companyList = $this->company_model->getCompanyList();
			
			if(in_array($companyName, $companyList)){
				$response['type'] = 'error';
				$response['msg'] = 'Company '.$_POST['name'].' already exists!';
			}	
			else{
				if($this->company_model->insertCompany($companyName)>0){
					$response['type'] = 'success';
					$response['msg'] = 'Company '.$_POST['name'].' has been encoded!';
				}
				else{
					$response['type'] = 'error';
					$response['msg'] = 'Error during inserting!';
				}
			}
			
		}
		else{
			$response['type'] = 'error';
			$response['msg'] = 'POST Data error';
		}
		
		echo json_encode($response);
	}
	
	
	
	
}
