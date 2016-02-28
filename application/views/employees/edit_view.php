<html>
<head>
	<title>Eidt Employee</title>
	<!--Sweet Alert import-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/sweetalert/lib/sweet-alert.css">
<script src="<?php echo base_url();?>lib/sweetalert/lib/sweet-alert.min.js"></script>
</head>
<body>
	<input type=hidden value="<?php echo $employee['employee_id']?>" id="employeeId"/>
	<input name = "editable" type=text value="<?php echo $employee['employee_name'];?>" placeholder="Enter employee name" id="employeeName" disabled/><br/><br/>
	<input name = "editable" type=text value="<?php echo $employee['employee_email'];?>" placeholder="Enter employee email" id="employeeEmail" disabled/><br/><br/>
	<button id="saveButton" style="display:none;">Save</button>
	<p>Company: <?php echo $employee['company_name'];?></p>
	
	<br/>
	<button id="editButton">Edit</button>
	<script src="<?php echo base_url();?>js/jquery-2.1.3.min.js"></script>
	<script>
		$('#editButton').click(function(){
			document.getElementById('saveButton').style.display = 'block';
			var editables = document.getElementsByName('editable');
			for(var i=0; i<editables.length;i++){
				editables[i].disabled = '';
			}
		});
		$('#saveButton').click(function(){
			var employeeName = document.getElementById('employeeName');
			var employeeEmail = document.getElementById('employeeEmail');
			var employeeId = document.getElementById('employeeId');
			if(employeeName.value != "" && employeeEmail.value != ""){
				$.ajax({
					  url: "<?php echo base_url();?>"+'employees/processedit',
					  type:"POST",
					  async:true,
					  data: {
						  emp_id: employeeId.value,
						  emp_name: employeeName.value,
						  emp_email: employeeEmail.value
					  }
				}).done(function(e){
					if(e !='success'){
						swal(e,"","error");
					}else{
						swal("Update success!","","success");
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