<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->
	<link rel="stylesheet" href="<?php echo base_url();?>styles/mdl/templates/article/styles.css">
	<link rel="stylesheet" href="<?php echo base_url();?>styles/mdl/material.min.css"/>
	<script src="<?php echo base_url();?>styles/mdl/material.min.js"></script>
	<script src="<?php echo base_url();?>js/jquery-2.1.3.min.js"></script>
	
<style>
	.demo-card-wide.mdl-card {
	  width: 400px;
	  height: auto;
	}
	.demo-card-wide > .mdl-card__title {
	  color: #fff;
	  height: auto;
	  min-height:216px;
	  background-color:#eee;
	}
	.demo-card-wide > .mdl-card__menu {
	  color: #fff;
	}
	

	.cardimage{
		width:250px;
	}
	#searchableDiv{
		position:relative;
		left:2%;
		
	}
	.sidebyside{
		
		margin-left:20px;
		margin-bottom:20px;
		display:inline-block;
		width:40%;
	}
	
</style>
</head>
<body style="font-family:Arial; background-color:#f5f5f5;">
 <div style="height:100%" class="">
     <div class="mdl-layout__header-row" style="background-color:white;">
          
          <div>
          <form action="#">
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input style="width:100%;" class="mdl-textfield__input" type="text" id="searchquery">
				<label class="mdl-textfield__label" for="searchquery">Search</label>
				</div>
			</form>
			</div>
        </div><br/>
 <div  id="searchableDiv">
<div class="demo-card-wide mdl-card mdl-shadow--2dp sidebyside">
  <div class="mdl-card__title">
    <!--<h2 class="mdl-card__title-text">Welcome</h2>-->
	<img class="cardimage" src="<?php echo base_url();?>/assets/incidentupdate.PNG"/>
  </div>
  <div class="mdl-card__supporting-text">
    <h4 class="mdl-card__title-text">Incident Update</h4><br/>
	
		<br/>Status: <font color=green><strong>Live</strong></font>
	
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="../api/incidentupdate" target="_blank">
      Use Template
    </a>
  </div>
  <div class="mdl-card__menu">
	<img width=65px src="<?php echo base_url();?>/assets/customers/pg_logo.PNG"/>
  </div>
</div>
<div class="demo-card-wide mdl-card mdl-shadow--2dp sidebyside">
  <div class="mdl-card__title">
    <!--<h2 class="mdl-card__title-text">Welcome</h2>-->
	<img class="cardimage" src="<?php echo base_url();?>/assets/inquiryreceived.PNG"/>
  </div>
  <div class="mdl-card__supporting-text">
    <h4 class="mdl-card__title-text">Inquiry Received</h4><br/>
	
	<br/>Status: In-progress
	
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Use Template
    </a>
  </div>
  <div class="mdl-card__menu">
	<img width=65px src="<?php echo base_url();?>/assets/customers/pg_logo.PNG"/>
  </div>

</div>


<div class="demo-card-wide mdl-card mdl-shadow--2dp sidebyside">
  <div class="mdl-card__title">
    <!--<h2 class="mdl-card__title-text">Welcome</h2>-->
	<img class="cardimage" src="<?php echo base_url();?>/assets/issuereceived.PNG"/>
  </div>
  <div class="mdl-card__supporting-text">
    <h4 class="mdl-card__title-text">Issue Received</h4><br/>
	
	<br/>Status: In-progress
	
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a href="../api/issuercv" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Use Template
    </a>
  </div>
  <div class="mdl-card__menu">
	<img width=65px src="<?php echo base_url();?>/assets/customers/pg_logo.PNG"/>
  </div>

</div>
 
 
 <div class="demo-card-wide mdl-card mdl-shadow--2dp sidebyside">
  <div class="mdl-card__title">
    <!--<h2 class="mdl-card__title-text">Welcome</h2>-->
	<img class="cardimage" src="<?php echo base_url();?>/assets/requestreceived.PNG"/>
  </div>
  <div class="mdl-card__supporting-text">
    <h4 class="mdl-card__title-text">Request Received</h4><br/>
	
	<br/>Status: In-progress
	
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Use Template
    </a>
  </div>
  <div class="mdl-card__menu">
	<img width=65px src="<?php echo base_url();?>/assets/customers/pg_logo.PNG"/>
  </div>

</div>


 <div class="demo-card-wide mdl-card mdl-shadow--2dp sidebyside">
  <div class="mdl-card__title">
    <!--<h2 class="mdl-card__title-text">Welcome</h2>-->
	<img class="cardimage" src="<?php echo base_url();?>/assets/hpeooo.PNG"/>
  </div>
  <div class="mdl-card__supporting-text">
    <h4 class="mdl-card__title-text">HPE Out of Office</h4><br/>
	<br/>Status: <font color=green><strong>Completed</strong></font>
	
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a href="../api/hpeooo" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Use Template
    </a>
  </div>
  <div class="mdl-card__menu">
	<img width=80px src="<?php echo base_url();?>/assets/customers/hpe_logo.PNG"/>
  </div>

</div>


</div>

 </div>
 


</body>
</html>
