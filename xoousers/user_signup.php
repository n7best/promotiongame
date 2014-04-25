<?php
include("xoo-ini.php");
$auxMember= new Member();
$auxCommon= new Common();

$auxSetting = new Setting();

require_once('recaptcha/recaptchalib.php');
$publickey = RE_CAPTCHA; // you got this from the signup page
$privatekey = RE_CAPTCHA_PRIVATE; // you got this from the signup page

if(isset($_SESSION['member'])) 
{
	header("Location: user_dashboard.php");
}


# the response from reCAPTCHA
$resp = NULL;
# the error code from reCAPTCHA, if any
$error = NULL;
$active_captcha= $auxSetting->getSetting("recaptcha",  "active_c");

if($_POST["act"] == 'sign_up_confirm') 
{
	//validate email and username
	
	foreach($_POST as $field_name => $val)
	{ 
		$assign = "\$".$field_name."='".$val."';"; 
		eval($assign); 
	}
		
	$required_fields = array(member_name => $lang['SIGNUP_WRITE_NAME'], member_user => $lang['SIGNUP_WRITE_USER_NAME'] ,  member_pass => $lang['SIGNUP_WRITE_PASSWORD'] , member_email => $lang['SIGNUP_WRITE_EMAIL'] );
	
	
	$ret_validate = $auxCommon->validate($required_fields);
	
	if($member_email!=$member_email2) $ret_validate .= $lang['SIGNUP_EMAILS_NOT_IDENTICAL'] ."<br>";
	if($member_pass2!=$member_pass) $ret_validate .= $lang['SIGNUP_WRITE_PASSWORD_NOT_IDENTICAL'] ."<br>";
	
	
	
	
	
	if($active_captcha==1)
	{		
		
		if($recaptcha_response_field=="") $ret_validate .= $lang['SIGNUP_INPUT_CAPTCHA']."<br>";
		# was there a reCAPTCHA response?
		if ($_POST["recaptcha_response_field"]) 
		{
			$resp = recaptcha_check_answer ($privatekey,
												$_SERVER["REMOTE_ADDR"],
												$_POST["recaptcha_challenge_field"],
												$_POST["recaptcha_response_field"]);
		
				if ($resp->is_valid) {
						//$ret_validate .= "";
				} else {
						# set the error code so that we can display it
						$ret_validate .= $lang['SIGNUP_CAPTCHA_INVALID'] ."<br>";
				}
		 }
	 
	 }

	
		
	//validate if it's a valid email address	
	$ret_validate_email = $auxCommon->validate_valid_email($member_email);
	
	//validate if it's already taken
	$ret_validate_unique_email = $auxMember->validate_user_name($member_email , $member_user);
	
	$unique_email = true;
	
	$row_countD = $ret_validate_unique_email->rowCount();
	
	if($row_countD!=0)
	{
		$ret_validate .= $lang['SIGNUP_USER_OR_EMAIL_INVALID'] ."<br>";
		$unique_email = false;
	}
	
	if(!$ret_validate_email)
	{
		$ret_validate .= $lang['SIGNUP_WRITE_VALID_EMAIL'] ."<br>";
	}
	
	if(strlen($member_pass)<PASSWORD_LENGHT)
	{
		$ret_validate .= $lang['SIGNUP_PASSWORD_MUST_CONTAIN']." ".PASSWORD_LENGHT." ".$lang['SIGNUP_PASSWORD_MUST_CONTAIN_CHAR']."<br>";
	}
	
	
	$active= $auxSetting->getSetting("security",  "password_1_letter_1_number");
	
	if($active==1)
	{
		//	must contain at least one number and one letter
		$ret_validate_password = $auxCommon->validate_password_numbers_letters($member_pass);	
		if(!$ret_validate_password)
		{
			$ret_validate .= $lang['SIGNUP_PASSWORD_ONE_LETTER_ONE_NUMBER'] ."<br>";
		}
	
	}
	
	$active= $auxSetting->getSetting("security",  "password_one_uppercase");
	if($active==1)
	{
		
		//must contain at least one upper case character	
		$validate_password_one_uppercase = $auxCommon->validate_password_one_uppercase($member_pass);	
		if(!$validate_password_one_uppercase)
		{
			$ret_validate .= $lang['SIGNUP_PASSWORD_ONE_UPPER_CASE'] ."<br>";
		}
	
	}
	
	
	$active= $auxSetting->getSetting("security",  "password_one_lowercase");
	
	if($active==1)
	{
		
		//must contain at least one lower case character	
		$validate_password_one_lowerrcase = $auxCommon->validate_password_one_lowerrcase($member_pass);	
		if(!$validate_password_one_lowerrcase)
		{
			$ret_validate .= $lang['SIGNUP_PASSWORD_ONE_LOWER_CASE'] ."<br>";
		}
	
	}
	
	//blank spaces
	
	if( preg_match('/\s/',$member_user) )
	{
		$ret_validate .= "The username cannot contain blank spaces " ."<br>";
	}
	
	//only allow alphanumeric, hyphen, underscore 
	
	if(preg_match('/[^a-zA-Z0-9_-]/i', $member_user))
	{
		$ret_validate .= "Username must contain only alphanumeric, hyphen and underscore" ."<br>";
	}
	
	if($ret_validate=="" && $ret_validate_email == true && $unique_email == true)
	{	
	
	    $auxEmail = new EmailTemplate();
	
		$user_id = $auxMember->add_item($_POST);
		
		$d_link = WEBSITE_URL."user_account_confirmation.php?hash=".$auxMember->member_hash ;
		
		$auxMess = new Messaging();	
		$p_name = $auxMember->member_name;
		
		if(CONFIRMATION_TYPE==1) //send activation link
		{				
		
			$rowMess = $auxEmail->getOne(1);
			$template = $rowMess->template_text;		
			$message = $auxEmail->parse_confirmation_message($template, $_POST, $d_link);
			
			include("emailtemplates/email_skeleton.php");	
			$auxMess->member_confirmation_link($auxMember, $receipt);	
		
		
		}elseif(CONFIRMATION_TYPE==2)	{	//send random activation number
		
		   
		    $d_link = WEBSITE_URL."user_account_confirmation_numeric.php?hash=".$auxMember->member_hash ;			 
		
			//get activation number
			$random = $auxCommon->genRandomActivation();
			
			//update user			
			$auxMember->update_activation_number($user_id, $random);
			
			$rowMess = $auxEmail->getOne(4);
			$template = $rowMess->template_text;		
			$message = $auxEmail->parse_confirmation_message_numeric($template, $_POST, $d_link, $random);
			
			include("emailtemplates/email_skeleton.php");	
			$auxMess->member_confirmation_link($auxMember, $receipt);	
			//print_r($auxMember);		
		
		
		}elseif(CONFIRMATION_TYPE==3)	{	//doesn't need activation
		
			
			//activate account automatically			
			$auxMember->change_user_status($user_id, 1);			
			
			$auxEmail = new EmailTemplate();
		
			//update message
			$rowMess = $auxEmail->getOne(3);
			$template = $rowMess->template_text;
			
			$message = $auxEmail->parse_confirmation_message_sucess($template, $auxMember, $d_link);
			
			include("emailtemplates/email_skeleton.php");				
			$auxMessaging = new Messaging();			
			$auxMessaging->member_welcome($auxMember, $receipt);
		
		
		}elseif(CONFIRMATION_TYPE==4)	{	//manually activation
		
		
			$auxEmail = new EmailTemplate();
		
			//update message
			$rowMess = $auxEmail->getOne(5);
			$template = $rowMess->template_text;
			
			$message = $auxEmail->parse_confirmation_message_manual($template, $auxMember);
			
			include("emailtemplates/email_skeleton.php");				
			$auxMessaging = new Messaging();			
			$auxMessaging->member_welcome($auxMember, $receipt);
			
		
		}
		
		header("Location: user_signup_sucess.php");exit;
		
		
		
	
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

include(SCRIPT_REAL_PATH."/templates/".TEMPLATE."/user_signup.php");
?>