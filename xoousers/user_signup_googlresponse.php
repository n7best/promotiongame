<?php
include("xoo-ini.php");
$auxMember= new Member();
$auxCommon= new Common();
require_once 'openid/openid.php';

$openid = new LightOpenID(WEBSITE_URL);
if ($_GET["auth"]=="ini") 
{
	
	if ($_GET["identity"]=="google") 
	{
		$openid->identity = 'https://www.google.com/accounts/o8/id';
		$openid->required = array(
		  'namePerson/first',
		  'namePerson/last',
		  'contact/email',
		);
	}else{
		
		$openid->identity = 'https://me.yahoo.com';
		$openid->required = array(
		  'namePerson',
		  'namePerson/first',
		  'namePerson/last',
		  'contact/email',
		);
		
	}
	
	$openid->returnUrl = WEBSITE_URL.'user_signup_googlresponse.php';
	$auth_url = $openid->authUrl();
	//echo "url ". $auth_url;
	header("Location: ".$auth_url."");
	exit;
	
} 

if ($openid->mode) {
    if ($openid->mode == 'cancel') {
       // echo "User has canceled authentication !";
		
		$h1 = "Ooops!";
	    $mess = "<p>SOME PROBLEM OCCOURED WHILE AUTHENTICATING YOUR ACCOUNT. PLEASE TRY AGAIN</p>";
		$mess .= "<p><a href='user_login.php'>Click to try it again</a></p>";
	
	
    } elseif($openid->validate()) {
        $data = $openid->getAttributes();
        $email = $data['contact/email'];
        $first = $data['namePerson/first'];
		//echo "Identity : $openid->identity <br>";
		$a =  $openid->identity ;
		//print_r($data);
	
		//validate
		$type = 4; //google
		
		if (strpos($a,'yahoo') !== false) 
		{
			$first = $data['namePerson'];
			$type = 3; //yahoo
		
		}
		 //check if already registered by using fb id	 
		 $rowUser = $auxMember->getWithEmailSocial($email);
		 
		 $user_id=$rowUser->member_id;
		 
		  $auxUser = new Member();
		 
		 if($rowUser->member_id=="")	 
		 {
			  //create and send emails							  
			  $auxUser->member_user = $email;
			  $auxUser->member_name = $first;
			  $auxUser->member_email =  $email;
			  $auxUser->member_registration_type = $type;			 			  	  
			  $auxUser->member_hash =session_id()."_".time();
			  $auxUser->member_pass =$auxUser->genRandomPassword();
			  $user_id = $auxUser->add_social();	
			  					 
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
		$mess = "<p>Hello ".$first."</p>";
		$mess .= "<p>We've sent a message to ". $email." containing your login credentials</p>";
		$mess .= "<p><a href='user_dashboard.php'>Click here to get in your account</a></p>";


		
		//print_r($data);
    } else {
        $h1 = "Ooops!";
	    $mess = "<p>SOME PROBLEM OCCOURED WHILE AUTHENTICATING YOUR ACCOUNT. PLEASE TRY AGAIN</p>";
		$mess .= "<p><a href='user_login.php'>Click to try it again</a></p>";
    }
} else {
        $h1 = "Ooops!";
	    $mess = "<p>SOME PROBLEM OCCOURED WHILE AUTHENTICATING YOUR ACCOUNT. PLEASE TRY AGAIN</p>";
		$mess .= "<p><a href='user_login.php'>Click to try it again</a></p>";
}

include(SCRIPT_REAL_PATH."/templates/".TEMPLATE."/user_signup_googleresponse.php");
?>