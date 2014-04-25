<?php
include("xoo-ini.php");

$login = new Login();


if($login->checkLoggedIn())
{
	$c = $_SESSION['XOOSCRIPTS_USER']->member_id;
	
	$auxCommon = new Common();
	$auxUser = new Member();
			
	$rowMember = $auxUser->getOne($c);
		
	$validate_empty = true;
	//the user is logged in
	$h1 = $lang['U_DASHBOARD_DATA_H1'];	
	$mess = $lang['U_DASHBOARD_DATA_MESSAGE'];
	
	if($_POST["act"] == 'update_personal' && ($_POST["member_name"] =="" || $_POST["member_email"] =="")) 
	{
		$validate_empty = false;
		$error = true;
		$message .= $lang['U_DASHBOARD_DATA_VALIDATION_ALL_FIELDS_REQU'] ."<br>";
	
	}
		
	//change password
	if($validate_empty && $_POST["act"] == 'update_personal' && $_POST["member_name"] !="" && $_POST["member_email"] !="") 
	{
		
		$c = $_SESSION['XOOSCRIPTS_USER']->member_id;
		$auxUser = new Member();
		
		//update
		$auxUser->update_personal_data($_POST["member_name"], $c);
			
		$rowMember = $auxUser->getOne($c);
			
		//validate if it's a valid email address	
		$ret_validate_email = $auxCommon->validate_valid_email($_POST["member_email"]);
		
		if(!$ret_validate_email)
		{
			$error = true;
			$message = $lang['U_DASHBOARD_DATA_VALIDATION_VALID_EMAIL'] ."<br>";
		}
		
		
		if($_POST["member_email"]!= $_POST["member_email2"])
		{
			
			//check available email
			$rowEmail = $auxUser->getWithEmail($_POST["member_email"]);
			
			if($rowEmail->member_email=="" && !$error)
			{
				//udpate		
				$auxUser->update_email($_POST["member_email"], $c);		
			
			}else{
				
				//error			
				$error = true;		
				$message = $lang['U_DASHBOARD_DATA_VALIDATION_EMAIL_USED'];				
				
			}
		
		 }
		
		
			
			
		if(!$error)
		{
			$status = true;
	        $message = $lang['U_DASHBOARD_DATA_VALIDATION_SUCESS'];
			$rowMember = $auxUser->getOne($c);
		}
		
	}
	
		
	include(SCRIPT_REAL_PATH."/templates_user_dashboard/".TEMPLATE."/user_dashboard_change_personal_data.php");

}else{
	
	//user is not logged in	
	$login->redirect_to("user_login.php");
	
}
?>