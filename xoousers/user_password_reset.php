<?php
include("xoo-ini.php");
$auxMember= new Member();
$auxCommon= new Common();

if($_POST["act"] == 'password_reset') 
{
			
	$required_fields = array(member_email => $lang['PASSWORD_RESET_EMAIL']   );
	
	$ret_validate = $auxCommon->validate($required_fields);
	
		
	if($ret_validate=="")
	{	
	   
	   //do password reset
	   $rowUser = $auxMember->getWithEmailReset($_POST["member_email"]);
	   
	   	
	   $mess = "";
		
		if($rowUser->member_email!="")
		{
			
			$d_link = WEBSITE_URL."user_password_reset_link.php?hash=".$rowUser->member_hash ;
			
			//reset password
			$new_password = $auxCommon->genRandomPassword();
			$member_id = $rowUser->member_id;
			//$auxMember->reset_password($member_id, $new_password);			
			
			//send to new password to user
			
			$auxEmail = new EmailTemplate();
			$auxMess = new Messaging();
			
			$rowMess = $auxEmail->getOne(7);
			$template = $rowMess->template_text;		
			$message = $auxEmail->parse_reset_password_link($template, $rowUser, $d_link);
					
			include("emailtemplates/email_skeleton.php");	
			$auxMess->member_reset_passoword_link($rowUser, $receipt);				
			
			$ret_validate .= $lang['PASSWORD_RESET_SUCESS']." ".$_POST["member_email"];	
			$OK = true;
			
		
		
		}else{
			
			$ret_validate .= $lang['PASSWORD_RESET_ERROR'] ;				
			$OK = false;	
		
			
			
				
		
		}
	   
	  
		
	
	}

}
include(SCRIPT_REAL_PATH."/templates/".TEMPLATE."/user_password_reset.php");
?>