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
		
		$h1= $lang['ACC_CONFIRMATION_ERROR_H1'];
		$mess = $lang['ACC_CONFIRMATION_ERROR_TEXT'];
		
		
	}else{
		
		//confirm
		$auxMember->confirmWithHash($_GET["hash"]);
		$u = $rowMember->member_user;
		$p_name = $rowMember->member_name;
		
		
		
		$auxEmail = new EmailTemplate();
		
		//update message
		$rowMess = $auxEmail->getOne(3);
		$template = $rowMess->template_text;
		
		$message = $auxEmail->parse_confirmation_message_sucess($template, $rowMember, $d_link);
		
		include("emailtemplates/email_skeleton.php");	
		
		$auxMessaging = new Messaging();
		
		$auxMessaging->member_welcome($rowMember, $receipt);
		$h1= $lang['ACC_CONFIRMATION_SUCESS_H1'];
		$mess = $lang['ACC_CONFIRMATION_SUCESS_TEXT'];
		
	
	}
	
}
include(SCRIPT_REAL_PATH."/templates/".TEMPLATE."/user_account_confirmation.php");
?>