<?php
require_once("Persistent.php");
class XooScriptsSetupPersistent extends Persistent 
{
	var $mUsersTable;


	public function __construct() 
	{
		$this->setCon();			
		$this->mUsersTable = DB_PREFIX."_users";
		$this->mSettingTable = DB_PREFIX."_settings";			
				 
	}

	
	 function save_item($sql) 
	 {							
		$this->setSql($sql);
		$result = $this->save();
		return 	$result;
		
     }
	 
	 
	 
	  function checkAlreadyInstalled() 
	  {
	
		$sql = " SHOW TABLES LIKE '".$this->mSettingTable."'";
							
		$this->setSql($sql);
		return $this->obtain();
		
     }
	 
	 function createAdminUser($DATA) {
				
		$sql = "INSERT INTO ".$this->mUsersTable." (user_username, user_email ,user_password  )						
			
			VALUES(";			
		$sql.= "'".$DATA["nick"]."', ";
		$sql.= "'".$DATA["email"]."', ";
		$sql.= "'".md5($DATA["pass1"])."') ";						
		
							
		$this->setSql($sql);
		$result = $this->save();
		return 	$result;
		
     }
	 
	 
	 
	 
	 
	 
	
}

?>
