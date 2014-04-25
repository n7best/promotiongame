<?php
require("UserPersistent.php");

class User 
{
	
	var $mPer;	
	
	public function __construct() 
	{
		$this->mPer = new UserPersistent();
				 
	}
	
	function recover_email($email) 
	{
    	$per = new UserPersistent();
        return $per->recover_email($email);
    }
	
	
	function recover_nick($nick)
	{
    	$per = new UserPersistent();
        return $per->recover_nick($nick);
    }
			
	function Login($user, $password)
	{
	    $resp = "NOOK";
    	$rowCutomer = 	$this->mPer->Login($user, $password);
			
		if(isset($_SESSION['user'])) 
		{
			unset($_SESSION['user']);
        }
		
		$row_count = $rowCutomer->rowCount();
		
		if($row_count != 0)
		{
			$_SESSION['user'] = $rowCutomer->fetch(PDO::FETCH_OBJ);	
			
			$resp = "";			
		}
		return $resp;
		        
    }
	
	function update_pass($id, $pass_new)
	{
    	$per = new UserPersistent();
        return $per->update_pass($id, $pass_new);
    }
	
	function update_email($id, $email) 
	{
    	$per = new UserPersistent();
        return $per->update_email($id, $email);
    }
	
	
	
	
	function giveOne($cod) 
	{
    	$per = new UserPersistent();
        return $per->giveOne($cod);
    }
	
	function  notify_pass($Obj, $new_pass)
	{
		$mSubject ="Password request ";
		
		$to = $Obj->user_email ;
			
		$headerCustomers ="MIME-Version: 1.0\n"; 
		$headerCustomers .= "Content-type: text/plain; charset=iso-8859-1\n"; 
		$headerCustomers .="From: ".WEBSITE_NAME." <".$Obj->user_email.">\n";
		$headerCustomers .="X-Mailer: PHP/". phpversion()."\n";
			
		
	   $message_to_send =" Hello, ".$Obj->user_username ."\n\n";
	   $message_to_send .=" A new password has been generated."."\n\n";
	   $message_to_send .= "Your username is: ".$Obj->user_username ."\n\n";
	   $message_to_send .= "Your new password is: ".$new_pass."\n\n";    			
			
	   mail($to, $mSubject, $message_to_send, $headerCustomers);
	   
	
	}
    
}
?>