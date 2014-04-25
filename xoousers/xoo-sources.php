<?php
require_once("xooclasses/Common.php");
require_once("xooclasses/User.php");
require_once("xooclasses/Setting.php");
require_once("xooclasses/Messaging.php");
require_once("xooclasses/IpBlock.php");
require_once("xooclasses/XooScriptsSetup.php");
require_once("xooclasses/Member.php");
require_once("xooclasses/EmailTemplate.php");
require_once("xooclasses/Pager.php");
require_once("xooclasses/MemberRole.php");
require_once("xooclasses/Login.php");
session_start();

//only run if already installed
$auxSetup = new XooScriptsSetup();

$already_installed=$auxSetup->checkAlreadyInstalledInt();

if($already_installed) 
{
	$auxSetting = new Setting();
	$p_web_name = $auxSetting->getSetting("website",  "name");
	
	session_start();
	
	//default language
	
	define('DEFAULT_LANGUAGE', "eng");
	
	define('WEBSITE_NAME', $p_web_name);
	define('WEBSITE_EMAIL', $auxSetting->getSetting("website",  "main_email"));
	define('WEBSITE_URL', $auxSetting->getSetting("website",  "url"));
	
	
	
	$PRODUCTS_PER_PAGE = $auxSetting->getSetting("website",  "items_per_page");
	
	if($PRODUCTS_PER_PAGE=="") $PRODUCTS_PER_PAGE = 10;	
	
	define('PRODUCTS_PER_PAGE', $PRODUCTS_PER_PAGE);
	
	$password_lenght = $auxSetting->getSetting("security",  "password_lenght");
	
	if($password_lenght=="") $password_lenght = 6;
	
	define('PASSWORD_LENGHT', $password_lenght);
	define('CONFIRMATION_TYPE', $auxSetting->getSetting("acc_activation",  "activation_type"));
	
	//Facebook app credentials	
	define('FACEBOOK_APPID',$auxSetting->getSetting("social",  "facebook_id"));
	define('FACEBOOK_SECRET',$auxSetting->getSetting("social",  "facebook_secret"));
	
	define ('LINKEDIN_API_KEY_PUBLIC', $auxSetting->getSetting("social",  "linkedin_api_public"));
    define ('LINKEDIN_API_KEY_PRIVATE', $auxSetting->getSetting("social",  "linkedin_api_private"));
	
	define ('RE_CAPTCHA',$auxSetting->getSetting("recaptcha",  "public_key"));
	define ('RE_CAPTCHA_PRIVATE', $auxSetting->getSetting("recaptcha",  "private_key"));
	
}
?>