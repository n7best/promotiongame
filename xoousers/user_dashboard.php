<?php
include("xoo-ini.php");

$login = new Login();

if($login->checkLoggedIn())
{
	$c = $_SESSION['XOOSCRIPTS_USER']->member_id;
	$auxUser = new Member();
	$rowMember = $auxUser->getOne($c);	
	//the user is logged in
	$h1 = $lang['U_DASHBOARD_H1'];	
	$mess = $lang['U_DASHBOARD_MESSAGE'];	
	include(SCRIPT_REAL_PATH."/templates_user_dashboard/".TEMPLATE."/user_dashboard.php");

}else{
	
	$login->redirect_to("user_login.php");
	
}
?>