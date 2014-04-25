<?php
include("xoo-ini.php");
$auxMember= new Member();
$auxCommon= new Common();
$auxSetting = new Setting();

if(isset($_SESSION['XOOSCRIPTS_USER'])) 
{
	header("Location: user_dashboard.php");	
}


if($_POST["act"] == 'signin') 
{
			
	$required_fields = array(member_user => $lang['LOGIN_WRITE_USER_NAME'] , member_pass => $lang['LOGIN_WRITE_PASSWORD']);
	
	$ret_validate = $auxCommon->validate($required_fields);
	
		
	if($ret_validate=="")
	{	
	   
	   //do login
	   $resp = $auxMember->Login($_POST["member_user"],  $_POST["member_pass"]);	
	   $mess = "";
		
		if($resp=="NOOK")
		{
			$ret_validate .= $lang['LOGIN_INVALID_DATA'];				 
			
			$OK = false;
		
		
		}else{		
			
			
			$OK = true;
			//redirect	
					
			header("Location: user_dashboard.php");			
		
		
		
		}
	   
	  
		
	
	}

}

require_once("fbapi/src/facebook.php");

$config = array();
$config['appId'] = FACEBOOK_APPID;
$config['secret'] = FACEBOOK_SECRET;

$facebook = new Facebook($config);


$params = array(
          'scope' => 'read_stream, email, friends_likes',
          'redirect_uri' => WEBSITE_URL.'user_signup_fbresponse.php'
        );
        
$loginUrl = $facebook->getLoginUrl($params);
$activate_facebook= $auxSetting->getSetting("social",  "facebook_enable");
$activate_yahoo= $auxSetting->getSetting("social",  "yahoo_enable");
$activate_google= $auxSetting->getSetting("social",  "google_enable");
$activate_linked= $auxSetting->getSetting("social",  "linkedin_enable");
include(SCRIPT_REAL_PATH."/templates/".TEMPLATE."/user_login.php");
?>