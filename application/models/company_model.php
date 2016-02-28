<?php
class company_model extends CI_Model {
	
	
	function getCompanyList(){
		$sql = "SELECT *  FROM company_db;";
		$q = $this->db->query($sql);
		if($q->num_rows()>0){
			$temp = $q->result();
			$result = array();
			foreach($temp as $row){
				$result[$row->id] = $row->company_name;
			}
			return $result;
		}
		else{
			return null;
		}
	}
	
	function insertCompany($companyName){
		$sql = "INSERT INTO company_db(company_name)
					VALUES('$companyName');";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	function insertEmployeesToCompanies($companyId, $empId){
		$sql = "
			INSERT INTO company_employees_db(company_id, employee_id)
			VALUES($companyId, $empId);
		";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	function searchCompanyById($id){
		$q = $this->db->query("
			SELECT * FROM company_db WHERE id = $id;
		");
		if($q->num_rows()>0){
			return $q->first_row('array');
		}
		else {
			return null;
		}
	}
	
	function getEmployeesInCompanyPerEmpId($id){
		$sql ="SELECT a.id AS 'company_id', a.company_name AS 'company_name', b.id AS 	'employee_id', b.email AS 'employee_email', b.name AS 'employee_name'
			FROM company_db a, employees_db b, company_employees_db c
			WHERE c.company_id = a.id
			AND c.employee_id = b.id
			AND b.id = $id;";
			
		
		$q =$this->db->query($sql);
		if($q->num_rows()>0){
			return $q->first_row('array');
		}
		else return null;
	}
	
	function getEmployeesInCompanyPerCompanyIdEmpId($cId, $eId){
		$sql ="SELECT a.id AS 'company_id', a.company_name AS 'company_name', b.id AS 	'employee_id', b.email AS 'employee_email', b.name AS 'employee_name'
			FROM company_db a, employees_db b, company_employees_db c
			WHERE c.company_id = a.id
			AND c.employee_id = b.id
			AND a.id = $cId
			AND b.id = $eId;";
			
		
		$q =$this->db->query($sql);
		if($q->num_rows()>0){
			return $q->first_row('array');
		}
		else return null;
	}
	

}
?>