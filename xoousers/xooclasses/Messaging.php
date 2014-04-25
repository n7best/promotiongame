<?php
class Messaging
{    
	var $mPerSetting;
	var $mEmailFromDefault;
	var $mRemitente;	
	var $mHeader;
	var $mHeaderCustomer;
	
	var $mHeaderSentFromName;
	var $mHeaderSentFromEmail;
	
	var $mEmailPlainHTML ;
	
	var $mCompanyName = WEBSITE_NAME ;

    function Messaging() 
	{
		$this->setHeadersCustomers();
		$this->setContentType();
		$this->setFromEmails();
		$this->setHeaders();
    }	
	
	function setContentType() 
	{
			
		$type = 1; 			
		
		if($type==0)
		{
			$this->mEmailPlainHTML="text/plain";		
		}
		
		if($type==1)
		{
			$this->mEmailPlainHTML="text/html";		
		}
    }
	
	function setFromEmails() 
	{
			
		$from_name = WEBSITE_NAME; 
		$from_email = WEBSITE_EMAIL; 			
		$this->mHeaderSentFromName=$from_name;
		$this->mHeaderSentFromEmail=$from_email;	
		
    }
	
	function setHeaders() {   			
		//Make Headers aminnistrators
		$header ="MIME-Version: 1.0\n"; 
		$header .= "Content-type: ".$this->mEmailPlainHTML."; charset=iso-8859-1\n"; 	
		$header .= "From: ".$this->mHeaderSentFromName." <".$this->mHeaderSentFromEmail.">\n";	
		$header .= "Organization: ".$this->mCompanyName." \n";
		$header .=" X-Mailer: PHP/". phpversion()."\n";		
		$this->mHeader = $header;		
    }
	
	function setHeadersCustomers() {   			
		//Make Headers aminnistrators
		$header ="MIME-Version: 1.0\n"; 
		$header .= "Content-type: ".$this->mEmailPlainHTML."; charset=iso-8859-1\n"; 
		$header .= "From: ".$this->mHeaderSentFromName." <".$this->mHeaderSentFromEmail.">\n";
		$header .= "Organization: ".$this->mCompanyName." \n";	
		$header .="X-Mailer: PHP/". phpversion()."\n";		
		$this->mHeader = $header;		
    }
	
	function sendMessage($site_email, $subject, $message)
	{
		$auxSetting = new Setting();
		$mailer= $auxSetting->getSetting("mailer_smtp",  "active_c");
		
		if($mailer==1)
		{
			$host = $auxSetting->getSetting("mailer_smtp",  "host_name");
			$user = $auxSetting->getSetting("mailer_smtp",  "username");
			$password = $auxSetting->getSetting("mailer_smtp",  "pass_d");
			$port = $auxSetting->getSetting("mailer_smtp",  "port");
			$enctype = $auxSetting->getSetting("mailer_smtp",  "requires_ssl");
			
						
			if($enctype=="")
			{
				$auth = false;				
			
			}else{		 
			 
			    $auth = true;
			}
			
			
			require 'phpmailer/class.phpmailer.php';
			
			//Create a new PHPMailer instance
			$mail = new PHPMailer();
			//Tell PHPMailer to use SMTP
			$mail->IsSMTP();
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug  = 0;
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			//Set the hostname of the mail server
			$mail->Host       = $host;
			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port       = $port;
			//Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure = $enctype;
			//Whether to use SMTP authentication
			$mail->SMTPAuth   = $auth;
			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username   = $user;
			//Password to use for SMTP authentication
			$mail->Password   = $password;
			//Set who the message is to be sent from
			$mail->SetFrom($user, WEBSITE_NAME);
			//Set an alternative reply-to address
			//$mail->AddReplyTo('replyto@example.com','First Last');
			
			$mail->CharSet     = 'UTF-8';
			
			//Set who the message is to be sent to
			$mail->AddAddress($site_email);
			
			//Set the subject line
			$mail->Subject = $subject;
			//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
			$mail->MsgHTML($message);
			//Replace the plain text body with one created manually
			//$mail->AltBody = 'This is a plain-text message body';
			//Attach an image file
			//$mail->AddAttachment('images/phpmailer_mini.gif');
			
			//Send the message, check for errors
			if(!$mail->Send()) {
			  echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			  //echo "Message sent!";
			}
		
		
		}else{
			
			$header =$this->mHeader  ;		
		    mail($site_email, $subject, $message, $header);		
		
		
		}


		
    }
	
	
	
	function sendMessageBulk($email_arrary, $subject, $message)
	{
		$auxSetting = new Setting();
		$mailer= $auxSetting->getSetting("mailer_smtp",  "active_c");
		
		if($mailer==1)
		{
			$host = $auxSetting->getSetting("mailer_smtp",  "host_name");
			$user = $auxSetting->getSetting("mailer_smtp",  "username");
			$password = $auxSetting->getSetting("mailer_smtp",  "pass_d");
			$port = $auxSetting->getSetting("mailer_smtp",  "port");
			$enctype = $auxSetting->getSetting("mailer_smtp",  "requires_ssl");
			
						
			if($enctype=="")
			{
				$auth = false;				
			
			}else{		 
			 
			    $auth = true;
			}
			
			
			require 'phpmailer/class.phpmailer.php';
			
			//Create a new PHPMailer instance
			$mail = new PHPMailer();
			//Tell PHPMailer to use SMTP
			$mail->IsSMTP();
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug  = 0;
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			//Set the hostname of the mail server
			$mail->Host       = $host;
			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port       = $port;
			//Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure = $enctype;
			//Whether to use SMTP authentication
			$mail->SMTPAuth   = $auth;
			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username   = $user;
			//Password to use for SMTP authentication
			$mail->Password   = $password;
			//Set who the message is to be sent from
			$mail->SetFrom($user, WEBSITE_NAME);
			//Set an alternative reply-to address
			//$mail->AddReplyTo('replyto@example.com','First Last');
			
			$mail->CharSet     = 'UTF-8';
			
			//build mailink list
			
			$ic = 0;
			
			foreach($email_arrary as $user)
			{
				 
				 $user = explode(",",$user);
				 $name = $user[0];
				 $email = $user[1];			     
				 
								 
				 if( $ic==0)
				 {					 
					 //Set who the message is to be sent to
			         $mail->AddAddress($email,$name);
					
				 }else{
					 
					  $mail->AddBCC($email, $name);					 
					 
				 }			
				 
				 $ic++;
			   
			 }
		 
			
			//Set the subject line
			$mail->Subject = $subject;
			//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
			$mail->MsgHTML($message);
			
			
			//Send the message, check for errors
			if(!$mail->Send()) {
			  echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			  //echo "Message sent!";
			}
		
		
		}else{
			
			
			//use mail	
			
			foreach($email_arrary as $user)
			{
				 
				 $user = explode(",",$user);
				 $name = $user[0];
				 $email = $user[1];			     
				 
			 				 
				$header =$this->mHeader  ;		
		   	    mail($email, $subject, $message, $header);	
			   
			 }
			 
			
			
				
		
		
		}


		
    }
		
	
	
	
	function member_confirmation_link($auxMember, $receipt)
	{
		$mSubject ="".$this->mCompanyName." Confirm your Account ";		
		$to = $auxMember->member_email ;		
		$this->sendMessage($to, $mSubject, $receipt);	
	}
	
	function member_reset_passoword($auxMember, $receipt)
	{
		$mSubject ="".$this->mCompanyName." Password Reset ";		
		$to = $auxMember->member_email ;		
		$this->sendMessage($to, $mSubject, $receipt);	
	}
	
	function member_reset_passoword_link($auxMember, $receipt)
	{
		$mSubject ="".$this->mCompanyName." Password Reset ";		
		$to = $auxMember->member_email ;		
		$this->sendMessage($to, $mSubject, $receipt);	
	}
	
	function member_welcome($auxMember, $receipt)
	{
		$mSubject ="".$this->mCompanyName." Account Confirmed ";		
		$to = $auxMember->member_email ;		
		$this->sendMessage($to, $mSubject, $receipt);	
	}
	
	function private_message($auxMember, $subject, $receipt)
	{
		$mSubject ="".$this->mCompanyName." ".$subject;		
		$to = $auxMember->member_email ;		
		$this->sendMessage($to, $subject, $receipt);	
	}
	
	
}
?>