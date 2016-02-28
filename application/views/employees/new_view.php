<html>
<head>
	<title>Add Employee</title>
	<!--Sweet Alert import-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/sweetalert/lib/sweet-alert.css">
<script src="<?php echo base_url();?>lib/sweetalert/lib/sweet-alert.min.js"></script>
</head>
<body>
	<input type=text value="" placeholder="Enter employee name" id="employeeName"/><br/><br/>
	<input type=text value="" placeholder="Enter employee email" id="employeeEmail"/><br/><br/>
	<select id ="companySelect">
		<?php
			if($companies != null)
			foreach($companies as $key=>$value){
				echo '<option value='.$key.'>'.$value.'</option>';
			}
			
		?>
		
	</select>
	<br/><br/>
	<button id="addEmployeeButton">Add</button>
	<script src="<?php echo base_url();?>js/jquery-2.1.3.min.js"></script>
	<script>

		$('#addEmployeeButton').click(function(){
			var employeeName = document.getElementById('employeeName');
			var employeeEmail = document.getElementById('employeeEmail');
			var select = document.getElementById('companySelect');
			var company = select.options[select.selectedIndex].value;
			
			if(employeeName.value != "" && employeeEmail.value != ""){
				$.ajax({
					  url: "<?php echo base_url();?>"+'add/newemployee',
					  type:"POST",
					  async:true,
					  data: {
						  name:employeeName.value,
						  email:employeeEmail.value,
						  companyId : company
					  }
				}).done(function(e){
					var response = JSON.parse(e);
					if(response['type']=='success'){
						swal(response['msg'],"","success");
						employeeName.value = "";
					}
					else{
						swal(response['msg'],"","error");
					}
				});
				
			}
			else{
				swal("Please complete all fields!!","","error");
			}
		});
		
	</script>
</body>
</html>