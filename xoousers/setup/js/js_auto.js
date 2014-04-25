
function validate_wizard()
{
	
	if(document.frm1.websitename.value=="")
	{
		xoo_show_dialog("Required Information", "Please input website name");
		document.frm1.websitename.focus();return;
		
	}
	
	if(document.frm1.username.value=="")
	{
		xoo_show_dialog("Required Information", "Please input username");
		document.frm1.username.focus();return;
		
	}
	
	if(document.frm1.email.value=="")
	{
		xoo_show_dialog("Required Information", "Please input your email");
		document.frm1.email.focus();return;
		
	}
	
	if(document.frm1.pass1.value=="")
	{
		xoo_show_dialog("Required Information", "Please write a password");
		document.frm1.pass1.focus();return;
		
	}
	
	document.frm1.act.value="create_website"	
	document.frm1.submit();
	
	
	
			
}

function xoo_show_dialog(title, message_to_display)
{
	
	var $dialog = jQuery('<div></div>')
			.html(message_to_display)
			.dialog({
				autoOpen: false,
				modal: true,
				title: title,
				buttons: {
					
					OK: function() {
						jQuery(this).dialog('close');
						return;
					}
				}
			});
	
	$dialog.dialog('open');


			
}
