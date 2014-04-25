<?php
include("xoo-ini.php");
$auxMember= new Member();
$auxCommon= new Common();
if($_GET["hash"] != '') 
{
	//get Member with hash
	$rowMember = $auxMember->getWithHash($_GET["hash"]);
	
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
		
		if($_POST["act"] == 'activate_ac') 
		{
			
			$rowMemberD = $auxMember->getWithHashAndNumber($_GET["hash"], $_POST["activation_number"]);
			
			if($rowMemberD->member_id =="") //number is invalid
			{
				//invalid hash			
				
				$ret_validate = $lang['ACC_CONFIRMATION_INVALID_CODE'];
				$valid = true;
				
				
			}else{ //valid do confirm account
			
			    $auxMember->confirmWithHash($_GET["hash"]);				
				
				$auxEmail = new EmailTemplate();
			
				//update message
				$rowMess = $auxEmail->getOne(3);
				$template = $rowMess->template_text;
				
				$message = $auxEmail->parse_confirmation_message_sucess($template, $rowMemberD, $d_link);
				
				include("emailtemplates/email_skeleton.php");					
				$auxMessaging = new Messaging();
				
				$auxMessaging->member_welcome($rowMemberD, $receipt);
				$h1= $lang['ACC_CONFIRMATION_NUMERIC_SUCESS_H1'];
				$mess = $lang['ACC_CONFIRMATION_NUMERIC_SUCESS_TEXT'];
				$valid = false;
				
			
			}
			
			
		
			
		
		
		}
		
	
	}
	
}
include(SCRIPT_REAL_PATH."/templates/".TEMPLATE."/user_account_confirmation_numeric.php");
?>