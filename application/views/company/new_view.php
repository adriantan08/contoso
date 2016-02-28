<html>
<head>
	<title>Add Company</title>
	<!--Sweet Alert import-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/sweetalert/lib/sweet-alert.css">
<script src="<?php echo base_url();?>lib/sweetalert/lib/sweet-alert.min.js"></script>
</head>
<body>
	<input type=text value="" placeholder="Enter company name" id="companyName"/><br/><br/>
	<button id="addCompanyButton">Add</button>
	<script src="<?php echo base_url();?>js/jquery-2.1.3.min.js"></script>
	<script>

		$('#addCompanyButton').click(function(){
			var companyName = document.getElementById('companyName');
			
			if(companyName.value != ""){
				$.ajax({
					  url: "<?php echo base_url();?>"+'add/newcompany',
					  type:"POST",
					  async:true,
					  data: {
						  name:companyName.value
					  }
				}).done(function(e){
					var response = JSON.parse(e);
					if(response['type']=='success'){
						swal(response['msg'],"","success");
						companyName.value = "";
					}
					else{
						swal(response['msg'],"","error");
					}
				});
				
			}
			else{
				swal("Company name can't be blank!","","error");
			}
		});
		
	</script>
</body>
</html>