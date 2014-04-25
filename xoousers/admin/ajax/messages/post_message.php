<?php
header("Cache-Control: private, no-cache, must-revalidate");
header('Content-Type: text/html; charset=UTF-8'); 
header("Pragma: no-cache");
include("../../../xoo-ini.php");
include("../../security.php");

$auxC = new Member();

$message_subject = $_POST["message_subject"];
$message_text = $_POST["message_text"];
$user_id = $_POST["user_id"];

$rowUser = $auxC->getOne($user_id);

$auxMessaging = new Messaging();
$auxMessaging->private_message($rowUser, $message_subject, $message_text);
echo "true";
?>