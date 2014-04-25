<?php
include("xoo-ini.php");

$login = new Login();

if($login->checkLoggedIn())
{
	$login->redirect_to("user_dashboard.php");
	
}else{
	
	//user is not logged in	
	echo "Your custom error message goes here, such as You're not loged in!!!";
	exit;	
}
?>