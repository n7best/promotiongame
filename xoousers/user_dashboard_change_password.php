<?php
include("xoo-ini.php");

$login = new Login();
$auxSetting = new Setting();


if($login->checkLoggedIn())
{
	$validate_empty = true;
	//the user is logged in
	$h1 = $lang['U_DASHBOARD_CHANGE_PASS_H1'];	
	$mess = $lang['U_DASHBOARD_CHANGE_PASS_MESSAGE'];
	
	if($_POST["act"] == 'update_password' && ($_POST["u_password_1"] =="" || $_POST["u_password_2"] =="")) 
	{
		$validate_empty = false;
		$error = true;
		$h1 = "ERROR!";		
		$mess = $lang['U_DASHBOARD_CHANGE_PASS_VALIDATION_NOT_EMPTY'];
	
	}
	
	$member_pass = $_POST["u_password_1"];
	
	if(strlen($member_pass)<PASSWORD_LENGHT)
	{
				$mess .= $lang['SIGNUP_PASSWORD_MUST_CONTAIN']." ".PASSWORD_LENGHT." ".$lang['SIGNUP_PASSWORD_MUST_CONTAIN_CHAR']."<br>";
				$validate_empty = false;
	}
	
	$active= $auxSetting->getSetting("security",  "password_1_letter_1_number");	
	if($active==1)
	{
		//	must contain at least one number and one letter
		$ret_validate_password = $auxCommon->validate_password_numbers_letters($member_pass);	
		if(!$ret_validate_password)
		{
			$mess .= $lang['SIGNUP_PASSWORD_ONE_LETTER_ONE_NUMBER'] ."<br>";
			$validate_empty = false;
		}
	
	}
	
	$active= $auxSetting->getSetting("security",  "password_one_uppercase");
	if($active==1)
	{
		
		//must contain at least one upper case character	
		$validate_password_one_uppercase = $auxCommon->validate_password_one_uppercase($member_pass);	
		if(!$validate_password_one_uppercase)
		{
			$mess .= $lang['SIGNUP_PASSWORD_ONE_UPPER_CASE'] ."<br>";
		}
	
	}
	
	$active= $auxSetting->getSetting("security",  "password_one_lowercase");
	
	if($active==1)
	{
		
		//must contain at least one lower case character	
		$validate_password_one_lowerrcase = $auxCommon->validate_password_one_lowerrcase($member_pass);	
		if(!$validate_password_one_lowerrcase)
		{
			$mess .= $lang['SIGNUP_PASSWORD_ONE_LOWER_CASE'] ."<br>";
		}
	
	}
			
			
		
	//change password
	if($validate_empty && $_POST["act"] == 'update_password' && $_POST["u_password_1"] !="" && $_POST["u_password_2"] !="") 
	{
		
		$c = $_SESSION['XOOSCRIPTS_USER']->member_id;
		$auxUser = new Member();
			
		$rowMember = $auxUser->getOne($c);
			
		if($_POST["u_password_1"] != $_POST["u_password_2"]) //check if password are identical
	    {
			$error = true;
			$h1 = "ERROR!";		
			$mess = $lang['U_DASHBOARD_CHANGE_PASS_VALIDATION_IDENTICAL'];
		
		
		}else{
			
			//
			
				
			
			$auxEmail = new EmailTemplate();
			$auxMess = new Messaging();		
			$auxPersistent = new Common();
			
			$new_password = $_POST["u_password_2"];
			
			//update member with new password			
			$auxUser->reset_password($c, $new_password);				
			
			$rowMess = $auxEmail->getOne(2);
			$template = $rowMess->template_text;		
			$message = $auxEmail->parse_reset_password_message($template, $rowMember, $new_password);
					
			include("emailtemplates/email_skeleton.php");	
			$auxMess->member_reset_passoword($rowMember, $receipt);	
			
			$error = false;
			$h1 = $lang['U_DASHBOARD_CHANGE_PASS_VALIDATION_SUCESS'];		
			$mess = $lang['U_DASHBOARD_CHANGE_PASS_VALIDATION_SUCESS_MESSAGE'];
		
		}
	}
	
		
	include(SCRIPT_REAL_PATH."/templates_user_dashboard/".TEMPLATE."/user_dashboard_change_password.php");

}else{
	
	//user is not logged in	
	$login->redirect_to("user_login.php");
	
}
?>