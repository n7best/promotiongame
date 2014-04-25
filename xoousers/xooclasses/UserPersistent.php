<?php
require_once("Persistent.php");
class UserPersistent extends Persistent 
{
	var $mTable;

	public function __construct() 
	{
		$this->setCon();		
		$this->mTable= DB_PREFIX."_users";
				 
	}
	
	function update_pass($id, $pass_new) 
	{ 
        $sql = "Update ".$this->mTable." Set  user_password = '".md5($pass_new)."' where user_id  ='$id'  ";    
		$this->setSql($sql);
        return $this->modify();
    }
	
	function update_email($id, $email) 
	{ 
        $sql = "Update ".$this->mTable."
			Set  user_email= '".$email."' where user_id  ='$id'  ";    
		$this->setSql($sql);
        return $this->modify();
    }
	
	function giveOne($cod) 
	{
        $sql = "SELECT *  FROM ".$this->mTable." where user_id = '$cod' 	";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function Login($usr, $password) 
	{
        $sql = "SELECT * from ".$this->mTable." where user_password  = '".md5($password)."' AND user_username = '".$usr."' ";
		
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function recover_email($email)
	{
        $sql = "Select * from  ".$this->mTable." where user_email   = '".$email."' ";    
		$this->setSql($sql);
        return $this->obtain();
    }
	
}
?>
