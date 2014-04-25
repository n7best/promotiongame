<?php
include("xoo-ini.php");
$auxMember= new Member();
$auxCommon= new Common();

require_once("fbapi/src/facebook.php");

$config = array();
$config['appId'] = FACEBOOK_APPID;
$config['secret'] = FACEBOOK_SECRET;

$facebook = new Facebook($config);

// Get User ID
$user = $facebook->getUser();

//the login url
$loginUrl = $facebook->getLoginUrl();

//the logout url
$logoutUrl = $facebook->getLogoutUrl();



if($user) {
	
	 $user_profile = $facebook->api('/me','GET');
	 $fbid = $user_profile['id'];
	// $user_picture = $facebook->api('/'.$fbid.'/picture','GET');
	 
	//echo "Pctire: ".file_get_contents ("http://graph.facebook.com/".$fbid."/picture");
	 
	  
	// exit;
	 
	 //check if already registered by using fb id	 
	 $rowUser = $auxMember->getWithFacebook($user_profile['id'], $user_profile['email']);
	 
	 $user_id= $rowUser->member_id;
	 
	  $auxUser = new Member();
	 
	 if($rowUser->member_id=="")	 
	 {
		  //create and send emails
		  		 		  
		  $auxUser->member_user = $user_profile['username'];
		  $auxUser->member_name = $user_profile['name'];
		  $auxUser->member_email = $user_profile['email'];
		  $auxUser->member_fb = $user_profile['id'];		  
		  $auxUser->member_hash =session_id()."_".time();
		  $auxUser->member_pass =$auxUser->genRandomPassword();
		  $user_id= $auxUser->add_fb();	  
		  		 
		 $auxEmail = new EmailTemplate();
		
		 //update message
		 $rowMess = $auxEmail->getOne(6);
		 $template = $rowMess->template_text;
		
		 $message = $auxEmail->parse_confirmation_message_sucess_social($template, $auxUser, $d_link);
		
		 include("emailtemplates/email_skeleton.php");				
		 $auxMessaging = new Messaging();			
		 $auxMessaging->member_welcome($auxUser, $receipt);
		 
		  $auxUser->LoginWithID($user_id);
		 
	 }else{		 
		 //already exist log in automatically
		 
		 //redirect		 
		 $auxUser->LoginWithID($user_id);
		 header("Location: user_dashboard.php");
	 
	 }
	
	$h1 = "Congratulations!";
	$mess = "<p>Hello ".$user_profile['first_name']."</p>";
	$mess .= "<p>We've sent a message to ".$user_profile['email']." containing your login credentials</p>";
	$mess .= "<p><a href='user_dashboard.php'>Click here to get in your account</a></p>";

          
			
			
     
}
else
{
	
	$h1 = "Ooops!";
	$mess = "<p>SOME PROBLEM OCCOURED WHILE CONNECTING FACEBOOK PLEASE LOGIN AGAIN</p>";
    

}
include(SCRIPT_REAL_PATH."/templates/".TEMPLATE."/user_signup_fbresponse.php");
?>