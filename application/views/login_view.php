<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
	<script src="js/jquery-2.1.3.min.js"></script>
	<style>.container{max-width:300px;}</style>
    <title>Contoso Login</title>

    <!-- Bootstrap core CSS -->
    <link href="styles/bootstrap-3.3.6/docs/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="styles/bootstrap-3.3.6/docs/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="styles/bootstrap-3.3.6/docs/examples/signin/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="styles/bootstrap-3.3.6/docs/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus> <br/>
        <label for="inputPassword" class="sr-only" >Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password"  required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button id="signinButton" class="btn btn-lg btn-primary btn-block">Sign in</button>
      

    </div> <!-- /container -->
	<script>
		function validateEmail(email) {
			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(email);
		}

		$('#signinButton').click(function(){
			var email = document.getElementById('inputEmail').value;
			var pw = document.getElementById('inputPassword').value;
			if(email !='' && validateEmail(email) && pw !=''){
				$.ajax({
					  url: "<?php echo base_url();?>"+'login/auth',
					  type:"POST",
					  async:true,
					  data: {
						  username:email,
						  password:pw
					  }
				}).done(function(e){
					var response = JSON.parse(e);
					if(response['type']=='success'){
						window.location.href = '<?php echo base_url();?>home';
						
					}
				});
				
			}
		});
		
	</script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="styles/bootstrap-3.3.6/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
