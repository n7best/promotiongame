<?php
include("xoo-ini.php");

$login = new Login();
$auxSetting = new Setting();

if($login->checkLoggedIn())
{
	$c = $_SESSION['XOOSCRIPTS_USER']->member_id;
	$auxUser = new Member();	
	
	$error = false;		
			
	$validate_empty = true;
	//the user is logged in
	$h1 = $lang['U_DASHBOARD_AVATAR_H1'];	
	$mess = $lang['U_DASHBOARD_AVATAR_MESSAGE'];
	
	if (is_uploaded_file($_FILES['avatar']['tmp_name'])  ) 
	{
		
		
		
		$temp_name = "p_".session_id().time();	 
	
        $file=$_FILES['avatar'];
		$auxUser->member_id = $c;
		$auxUser->avatar_temp_file = $temp_name;
		
		$mPathFile = SCRIPT_REAL_PATH."/".MEDIA_PATH;
		
        $resp = $auxUser->create_avatar($file, $mPathFile, $auxSetting->getSetting("website",  "avatar_width"), $auxSetting->getSetting("website",  "avatar_height"));     
		
		if(!$error)
		{
			$status = true;
	        $message = $lang['U_DASHBOARD_AVATAR_VALIDATION_SUCCESS'];
			
		}
		                        
    } 	
			
	$rowMember = $auxUser->getOne($c);		
	include(SCRIPT_REAL_PATH."/templates_user_dashboard/".TEMPLATE."/user_dashboard_avatar.php");

}else{
	
	//user is not logged in	
	$login->redirect_to("user_login.php");
	
}
?>