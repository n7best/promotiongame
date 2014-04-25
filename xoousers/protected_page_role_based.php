<?php
include("xoo-ini.php");

$login = new Login();

if(!$login->userRoleCheck("1,4"))
{	
	$login->redirect_to("index.php");	
}

echo "OK";
?>
