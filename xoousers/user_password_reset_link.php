<?php
include("xoo-ini.php");
$auxMember= new Member();
$auxCommon= new Common();
$ret_validate = "";

if($_GET["hash"] != '') 
{
	//get Member with hash
	$rowMember = $auxMember->getWithHashResetPassword($_GET["hash"]);
	
	if($rowMember->member_id =="")
	{
		//invalid hash
		
		$h1= $lang['ACC_CONFIRMATION_NUMERIC_ERROR_H1'];
		$mess = $lang['ACC_CONFIRMATION_NUMERIC_ERROR_TEXT'];
		$valid = false;
		
		
	}else{
		
		$valid = true;
		
		$u = $rowMember->member_user;
		$p_name = $rowMember->member_name;
		
		if($_POST["act"] == 'reset_password') 
		{
			
			//check blank entry			
			if($_POST["member_pass"] =="" || $_POST["member_pass2"] =="") 
			{
				$error = true;
				$h1 = "ERROR!";		
				$ret_validate .= $lang['PASSWORD_RESET_LINK_VALIDATION_BLANK']. "<br>";
				
			
			}
			
			//check password identical			
			if($_POST["member_pass"] != $_POST["member_pass2"] ) 
			{
				$error = true;
				$h1 = "ERROR!";		
				$ret_validate .=  $lang['PASSWORD_RESET_LINK_VALIDATION_NOT_IDENTICAL']. "<br>";			
			}
			
			
	
			$rowMemberD = $auxMember->getWithHashResetPassword($_GET["hash"]);
			
			$member_id = $rowMemberD->member_id;
			if($rowMemberD->member_id =="") //number is invalid
			{
				//invalid hash				
				$ret_validate .="ERROR" ;
				$valid = true;
				
				
			}elseif($rowMemberD->member_id !="" && !$error){ //valid do password change
			
			    $auxMember->getWithHashResetPassword($_GET["hash"]);		
				
				$new_password =$_POST["member_pass"];
				
				$auxMember->reset_password($member_id, $new_password);		
				
				$auxEmail = new EmailTemplate();
				$auxMess = new Messaging();
				
				$rowMess = $auxEmail->getOne(2);
				$template = $rowMess->template_text;		
				$message = $auxEmail->parse_reset_password_message($template, $rowMemberD, $new_password);
						
				include("emailtemplates/email_skeleton.php");	
				$auxMess->member_reset_passoword($rowMemberD, $receipt);				
				
					
				$OK = true;
				$valid = false;
				
				$h1= $lang['PASSWORD_RESET_LINK_VALIDATION_SUCESS'];
				$mess= $lang['PASSWORD_RESET_LINK_VALIDATION_SUCESS_MESSAGE'];
			
			}
		
		}
	
	}
	
}
include(SCRIPT_REAL_PATH."/templates/".TEMPLATE."/user_password_reset_link.php");
?>