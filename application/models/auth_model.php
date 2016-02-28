<?php
class auth_model extends CI_Model {
	
		
	function getUserAuthDetails($email){
		$sql = "SELECT * FROM auth_db WHERE LOWER(user) = LOWER('$email');";
		$q = $this->db->query($sql);
		if($q->num_rows()>0){
			return $q->first_row('array');
		}
		else 
			return null;
	}
	
	function clearAttempts($email){
		$sql = "UPDATE auth_db SET last_attempt_count = 0 WHERE 
				LOWER(user) = LOWER('$email');";
		$this->db->query($sql);
	}
	
	function increaseAttempt($email){
		$sql = "UPDATE auth_db SET last_attempt_count = last_attempt_count+1 WHERE 
				LOWER(user) = LOWER('$email');";
		$this->db->query($sql);
	}
	
	
}
?>