<?php
class employee_model extends CI_Model {
	
	
	function getEmployeeList(){
		$sql = "SELECT * FROM employees_db;";
		$q = $this->db->query($sql);
		if($q->num_rows()>0){
			$temp = $q->result();
			$result = array();
			foreach($temp as $row){
				$result[$row->email] = $row;
			}
			return $result;
		}
		else{
			return null;
		}
	}
	
	function insertEmployee($employeeName, $employeeEmail){
		$sql = "INSERT INTO employees_db(name, email)
					VALUES('$employeeName','$employeeEmail');";
		$this->db->query($sql);
		
		return $this->db->affected_rows().'|'.$this->db->insert_id();
	}
	
	function deleteEmployee($id){
		$this->db->query("
			DELETE FROM employees_db WHERE id = $id;
		");
	}
	
	function update($id, $name, $email){
		$this->db->query("
			UPDATE employees_db
			SET name = '$name',
				email = '$email'
			WHERE id = $id;
			
		");
		
		return $this->db->affected_rows();
	}
	

}
?>