<?php
include("xoo-ini.php");
include_once("twitterapi/twitteroauth.php");

$auxMember= new Member();
$auxCommon= new Common();

if (isset($_REQUEST['oauth_token']) && $_SESSION['token']  !== $_REQUEST['oauth_token']) {

	// if token is old, distroy any session and redirect user to index.php
	session_destroy();
	header('Location: user_login.php');
	
}elseif(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {

	// everything looks good, request access tokenaaszza<
	//successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'] , $_SESSION['token_secret']);
	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	if($connection->http_code=='200')
	{
		//redirect user to twitter
		$_SESSION['status'] = 'verified';
		$_SESSION['request_vars'] = $access_token;
		
		// unset no longer needed request tokens
		unset($_SESSION['token']);
		unset($_SESSION['token_secret']);
		
		//create user
		

		$screenname 		= $_SESSION['request_vars']['screen_name'];
	    $twitterid 			= $_SESSION['request_vars']['user_id'];
		
		print_r( $_SESSION['request_vars']);
		
		 //check if already registered by using twitter id	 
	     $rowUser = $auxMember->getWithFacebook($user_profile['id'], $user_profile['email']);
		 
		 if($rowUser->member_id=="")	 
		 {
			  //create and send emails
							  
			  $auxUser->member_user = $user_profile['username'];
			  $auxUser->member_name = $user_profile['name'];
			  $auxUser->member_email = $user_profile['email'];
			  $auxUser->member_fb = $twitterid;		  
			  $auxUser->member_hash =session_id()."_".time();
			  $auxUser->member_pass =$auxUser->genRandomPassword();
			  $auxUser->add_tw();	  
					 
			   $auxEmail = new EmailTemplate();
			
			 //update message
			 $rowMess = $auxEmail->getOne(6);
			 $template = $rowMess->template_text;
			
			 $message = $auxEmail->parse_confirmation_message_sucess_social($template, $auxUser, $d_link);
			
			 include("emailtemplates/email_skeleton.php");				
			 $auxMessaging = new Messaging();			
			 $auxMessaging->member_welcome($auxUser, $receipt);
			 
			  $auxUser->LoginSocial($user_id);
			 
		 }else{		 
			 //already exist log in automatically
			 
			 //redirect		 
			 $auxUser->LoginSocial($user_id);
			 header("Location: user_dashboard.php");
		 
		 }
	 
		
		
		
		header('Location: user_login.php');
	}else{
		die("error, try again later!");
	}
		
}else{

	if(isset($_GET["denied"]))
	{
		header('Location: user_login.php');
		die();
	}

	//fresh authentication
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->getRequestToken(OAUTH_CALLBACK);
	
	//received token info from twitter
	$_SESSION['token'] 			= $request_token['oauth_token'];
	$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];
	
	// any value other than 200 is failure, so continue only if http code is 200
	if($connection->http_code=='200')
	{
		//redirect user to twitter
		$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
		header('Location: ' . $twitter_url); 
	}else{
		die("error connecting to twitter! try again later!");
	}
}
?>

