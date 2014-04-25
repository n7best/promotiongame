<?php
require_once("xoo-config.php");
require_once("xoo-sources.php");

if(isset($_GET['lang']))
{
	$lang = $_GET['lang'];
	
	// register the session and set the cookie
	$_SESSION['lang'] = $lang;
	
	setcookie('lang', $lang, time() + (3600 * 24 * 30));
	
}elseif(isset($_SESSION['lang'])){
	
	$lang = $_SESSION['lang'];
	
}else if(isset($_COOKIE['lang']))	{
	
	$lang = $_COOKIE['lang'];
	
}else{
	
	$lang = 'en';
}

switch ($lang) 
{
  case 'en':
  $lang_file = 'eng.php';
  break;
  
  case 'es':
  $lang_file = 'es.php';
  break;
  
  default:
  $lang_file = 'eng.php';

}

include_once 'lang/'.$lang_file;


if($already_installed) 
{
	//validate IP blocking
	$auxIPBlock = new IpBlock();
	$ip=$_SERVER['REMOTE_ADDR'];
	$res = $auxIPBlock->getOne($ip);
	if(!$res){ echo " <h1>Restricted Access</h1><p>You are not allowed to view this page!</p> ";exit;}
}
?>