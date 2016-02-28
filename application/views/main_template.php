<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Template Factory - a communications solution">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Template Factory</title>

    <!-- Page styles -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/mdl/material.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>styles/mdl/templates/android-dot-com/styles.css">
   <style>
	#override_navbg{
		background-color:#00b48d;
	}
	
	#override_mdl-layout__drawer{
		overflow-y:hidden;
		height:auto;
		max-height:auto;
	}
	.mdl-layout__drawer-button{
		text-decoration:none;
	}
	#override_mdl-layout-title{
		background-color:#fafafa;
		height:120px;
	}
	/*To remove that pesk outline color when clicking the hamburger button*/
	*:focus {
		outline: none;
	}
   </style>
  </head>
  <body>
  
	
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

      <div class="android-header mdl-layout__header mdl-layout__header--waterfall " id="override_navbg">
        <div class="mdl-layout__header-row">
          <span class="android-title mdl-layout-title">
            <h5 style="color:white;">Template Factory</h5>
          </span>
          <!-- Add spacer, to align navigation to the right in desktop -->
          <div class="android-header-spacer mdl-layout-spacer"></div>
          <div class="android-search-box mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right mdl-textfield--full-width">
            
           
          </div>
          <!-- Navigation -->
          <div class="android-navigation-container">
            <nav class="android-navigation mdl-navigation">
              <a class="mdl-navigation__link mdl-typography--text-uppercase" href="<?php echo base_url();?>main/home">Home</a>
              <a class="mdl-navigation__link mdl-typography--text-uppercase" href="<?php echo base_url();?>main/browse">Browse</a>
			  <a class="mdl-navigation__link mdl-typography--text-uppercase" href=""><span class="mdl-badge" data-badge="!">Hot</span></a>
              <a class="mdl-navigation__link mdl-typography--text-uppercase" href="">Request a Template</a>
              
            </nav>
          </div>
         
         
        </div>
      </div>

      <div class="android-drawer mdl-layout__drawer" id="override_mdl-layout__drawer">
        <span class="mdl-layout-title" id="override_mdl-layout-title">
          <img width=120px src="<?php echo base_url();?>assets/acoe_logo.png"/>
        </span>
        <nav class="mdl-navigation">
         
		  <div class="android-drawer-separator"></div>
          <span class="mdl-navigation__link" href="">General</span>
          <a class="mdl-navigation__link" href="">Ticket Received (P&G)</a>
          <a class="mdl-navigation__link" href="">Ticket Update (P&G)</a>
		  
		  <div class="android-drawer-separator"></div>
          <span class="mdl-navigation__link" href="">Newsletters</span>
          <a class="mdl-navigation__link" href="">SLM Newsletter</a>
          <a class="mdl-navigation__link" href="">Operation Newsletter</a>
          
        </nav>
      </div>

      <div class="android-content mdl-layout__content">
	  <?php echo $wrapper;?>
        
       
      </div>
    </div>
    
    <script src="<?php echo base_url();?>styles/mdl/material.min.js"></script>
	
	<!--GLobal Page/Ajax loading gif-->
	<div id="loadinggif" style="display:inline; position: absolute;left: 95%;top: 90%; z-index:9999;">
		<img src="<?php echo base_url();?>/assets/loader.gif" />
	</div>
	 <script>
		//scripts handling page/ajax load progress gif
		$(document).ready(function(){
			$('#loadinggif').hide();
		});
		$(document).ajaxStart(function(){
			$("html, body").animate({ scrollTop: 0 });
			$('#loadinggif').show();
		 }).ajaxStop(function(){
			$('#loadinggif').hide();
		 });
		</script>
	
  </body>
</html>
