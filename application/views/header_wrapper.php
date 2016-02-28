<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo base_url();?>styles/mdl/material.min.css"/>
	<script src="<?php echo base_url();?>styles/mdl/material.min.js"></script>
	<script src="<?php echo base_url();?>js/jquery-2.1.3.min.js"></script>
	
	<!--Sweet Alert import-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/sweetalert/lib/sweet-alert.css">
<script src="<?php echo base_url();?>lib/sweetalert/lib/sweet-alert.min.js"></script>


	<!--Custom Popup Modal Import-->
<link rel="stylesheet" href="<?php echo base_url();?>lib/remodal/dist/jquery.remodal.css" />
<script src="<?php echo base_url();?>lib/remodal/dist/jquery.remodal.min.js"></script>

</head>
<body style="font-family:Arial; background-color:#f5f5f5;"><br/>
<div >
	<table><tr><td valign=top>
	<div class="mdl-card mdl-shadow--2dp demo-card-square queue-card" style="min-width:600px; height:300px; margin-left:40px;">
	<div class="mdl-card__title mdl-card--expand" style="height:100px; border:solid 1px #00b48d; border-width:7px;">
	<h4>Your Email Header</h4>
	</div>
	<div class="mdl-card__supporting-text">
	<table><tr><td>
	<table>
	<tr>
		<td>From:</td>
		<td><input style="width:90%;" type=text id="from" value="<?php echo $from;?>"/>
		</td>
		</tr>
		
		<tr>
		<td>To:</td>
		<td><input style="width:90%;" type=text id="recipient" value="<?php echo $recipient;?>"/>
		</td>
		</tr>
		
		<tr>
		<td>Cc:</td>
		<td><input style="width:90%;" type=text id="cc" value="<?php echo $cc;?>"/>
		</td>
		</tr>
		
		<tr>
		<td>Bcc:</td>
		<td><input style="width:90%;" type=text id="bcc" value="<?php echo $bcc;?>"/>
		</td>
		</tr>
		
		
		<tr>
			<td>Subject:</td>
			<td contenteditable="true"><br/><p  id="subject"><?php echo $subject;?></p>
			</td>
		</tr>	
	</table>
	</td>
	<td  valign=top>
	<button id="sendButton" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" style="background-color:#56c5d0;color:white;">
	  Send Email
	</button>
	</td></tr>
	</table>
		
		<script>
			/***********
				How Image Attaching+Embedding in email works. 
				
				To ensure this image gets properly send in the email, the ff. atts should be present in the img tag:
				id -> contains the file name of the image in the server
				
				name -> should always be attachment. server will also look for all img with name as attachment, then get the id to eventually get the file name in the server assets lib
				
				src -> just the usual img src just to properly render in the web page
				
				data-src -> during sending, server-side will swap the id to the src and appending 'cid:' for the email attachment to work. Once sent, we'll need to revert back to the original src
				
				server-side will swap all src to id, then send the email content to sender server.
				after sending, we revert the src back to original by referencing the attr data-src
			**************/
			function prepareAttachments(){
				var imgs = document.getElementsByName('attachment');
				for(var i=0; i<imgs.length; i++){
					imgs[i].src = "cid:"+imgs[i].id;
					
				}
			}
			
			function revertImages(){
				var imgs = document.getElementsByName('attachment');
				for(var i=0; i<imgs.length; i++){
					/*There a custom html attribute for img attachments that serves
						as a placeholder of src so we can revert back to the proper html img src
						after changing it to cid:<id of image>
					*/  
					imgs[i].src = imgs[i].dataset.src;
				}
			}
		
			$('#sendButton').click(function(){
				if(runValidation()){
					
					/*Prepare embedded images as attachments by getting all
						doms with names as replaceme. 
					*/
					prepareAttachments();
					
					$('#sendButton').prop('disabled', true);
					$('#sendButton').html("Loading..");
					
					$.ajax({
					  url: "<?php echo base_url();?>"+'index.php/api/sendEmail',
					  type:"POST",
					  data: {
						  emailContent: document.getElementById('emailContent').innerHTML,
						  from: document.getElementById('from').value,
						  recipient: document.getElementById('recipient').value,
						  cc: document.getElementById('cc').value,
						  bcc: document.getElementById('bcc').value,
						  /*opted to use textContent to futher filter html encodings in the subject and also added a regex to replace &nbsp since it is returned as a special character by js. nbsp tends to appear when user adding too many space bars in subject*/
						  subject: document.getElementById('subject').textContent.replace(/\u00a0/g,'')
					  }
					}).done(function() {
					  $('#sendButton').prop('disabled', false);
					  swal("Email sent!","","success");
					  $('#sendButton').html("Send Email");
					  revertImages();
					});
				}
				else{
					swal("Error","","error");
				}
				});
			
			
		</script>
			</div>
			
			
		  </div>

		  
	</td><td>	  
	
	  </td></tr></table>
<br/><br/>
<?php
	echo  $content;
?>


</div>



</body>
</html>
