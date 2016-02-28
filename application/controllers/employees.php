<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class employees extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->checkSession();
	}
	
	function checkSession(){
		if($this->session->userdata('email') == null || $this->session->userdata('email') == ""){
			redirect('/login/bye');
		}
	}
	
	function search($id){
		$employees = $this->company_model->getEmployeesInCompanyPerEmpId($id);
		
		if($employees == null){
			echo 'Employee not found';
		}
		else{
			echo '<table border=1>
				<tr><td>Name</td><td>'.$employees['employee_name'].'</td></tr>
				<tr><td>Email</td><td>'.$employees['employee_email'].'</td></tr>
				<tr><td>Company</td><td>'.$employees['company_name'].'</td></tr>
			</table>';
		}
			
	}
	
	function edit($companyId, $employeeId){
		$emp = $this->company_model->getEmployeesInCompanyPerCompanyIdEmpId($companyId, $employeeId);
		
		if($emp!=null){
			$data['employee'] = $emp;
		
			$this->load->view('/employees/edit_view', $data);
		}
		else 
			echo 'Employee not found!';
	}
	
	function processedit(){
		if(isset($_POST['emp_id']) && isset($_POST['emp_name']) && isset($_POST['emp_email'])){
			$update = $this->employee_model->update($_POST['emp_id'], $_POST['emp_name'], $_POST['emp_email']);
			
			if($update>0){
				echo 'success';
			}
			else{
				echo 'You did\'t change anything. ';
			}
		}
		else{
			echo 'Post data error!';
		}
		
	}
	
	
}
