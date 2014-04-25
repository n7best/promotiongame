<?php
include("xoo-ini.php");
$auxMember= new Member();
$auxCommon= new Common();

$h1 = "Thank you!";
$mess="We have sent information about your sign up to your email address.";

include(SCRIPT_REAL_PATH."/templates/".TEMPLATE."/user_signup_sucess.php");
?>