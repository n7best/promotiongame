$(function() {
	
	$(".modalbox").fancybox();
	
	$("#contact").submit(function() { return false; });				
	
	$("#send_comment").on("click", function(){
			
			
		    var message_subject  = $("#message_subject").val();
			var message_text  = $("#message_text").val();
						
			
			
						
			if(message_subject=="") {
				$("#message_subject").addClass("error");
				
			}else{
				
				$("#message_subject").removeClass("error");
				
				
			}
			
			if(message_text=="") {
				$("#message_text").addClass("error");
				
			}else{
				
				$("#message_text").removeClass("error");
				
				
			}
			
			if(message_subject!="" &&  message_text!="") {
				
				
				// if both validate we attempt to send the e-mail
				// first we hide the submit btn so the user doesnt click twice
				$("#send_comment").replaceWith("<em>sending...</em>");
				
				$.ajax({
					type: 'POST',
					url: 'ajax/messages/post_message.php',
					data: $("#contact").serialize(),
					success: function(data) {
						if(data == "true") {
							
							$("#contact").fadeOut("fast", function(){
								$(this).before("<p><strong>Success! The message has been sent :)</strong></p>");
								
								setTimeout("$.fancybox.close()", 1000);
							});
						}
					}
				});
			} //end if
		});
		
		
    // Side Bar Toggle
    $('.hide-sidebar').click(function() {
	  $('#sidebar').hide('fast', function() {
	  	$('#content').removeClass('span9');
	  	$('#content').addClass('span12');
	  	$('.hide-sidebar').hide();
	  	$('.show-sidebar').show();
	  });
	});

	$('.show-sidebar').click(function() {
		$('#content').removeClass('span12');
	   	$('#content').addClass('span9');
	   	$('.show-sidebar').hide();
	   	$('.hide-sidebar').show();
	  	$('#sidebar').show('fast');
	});
	
	
	$('#reset-pass').click(function() {
		
		    var con ;
			con = confirm("Are you totally sure?");
			if (con == true) 
			{
				document.getElementById('act').value="reset_password";			
				document.getElementById('frm1').submit();
			}
	});
	
	
	$('#save-changes').click(function() {
		
		
		 var con ;
			con = confirm("Are you totally sure?");
			if (con == true) 
			{
				document.getElementById('act').value="update_info";			
				document.getElementById('frm1').submit();
			}
		
		
		
		
	});
	
	$('#save-changes-add').click(function() {
		
		
		document.getElementById('act').value="add_new";			
		document.getElementById('frm1').submit();
			
		
		
		
		
	});
	
	
	$('#ban-user').click(function() {
		 
			var con ;
			con = confirm("Are you totally sure?");
			if (con == true) 
			{
				document.getElementById('act').value="ban_user";			
				document.getElementById('frm1').submit();
			}
			
	});
	
	$('#activate-user').click(function() {
		 
			var con ;
			con = confirm("Are you totally sure?");
			if (con == true) 
			{
				document.getElementById('act').value="activate_user";			
				document.getElementById('frm1').submit();
			}
			
	});
	
	
	
	$('#back-roles').click(function() {
		 document.location.href='roles.php';
			
	});
	
	$('#back-message').click(function() {
		 document.location.href='index.php';
			
	});
	
	
	
	
	
	
	
});

function delete_users(user_id) 
{
	var con ;
			con = confirm("Are you totally sure?");
			if (con == true) 
			{
				document.getElementById('act').value="delete_user";	
				document.getElementById('c').value=user_id;			
				document.getElementById('frm1').submit();
			}
}
function delete_roles(c) 
{
	var con ;
			con = confirm("Are you totally sure?");
			if (con == true) 
			{
				document.getElementById('act').value="delete_roles";	
				document.getElementById('c').value=c;			
				document.getElementById('frm1').submit();
			}
}

