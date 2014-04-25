<?php
require_once("Persistent.php");
class SettingPersistent extends Persistent 
{
	var $mTable;	
    
	public function __construct() 
	{
		$this->setCon();
		$this->mTable = DB_PREFIX."_settings";
		
    }
	
	function getOne($cod)
	{
        $sql = "SELECT * FROM ".$this->mTable ." WHERE cat_id = '$cod'";
       
		$this->setSql($sql);
		$ret = $this->obtain();		    
		return $ret;   
    }
	
	function update_setting($group, $setting_to_update, $data_update)
	{
		
		$sql = "SELECT * FROM ".$this->mTable." WHERE setting_group = '$group' AND setting_label = '".$setting_to_update."' ";
		
		$this->setSql($sql);
		$ret = $this->obtain();
		
		$row_countD = $ret->rowCount();
		
		if($row_countD==0)
		{
			
			$sql = "INSERT INTO ".$this->mTable." (setting_group, setting_label) VALUES ('$group','$setting_to_update' ) ";		
			$this->setSql($sql);
		    $ret = $this->obtain();
		
		}
		
		$sql = " UPDATE ".$this->mTable." SET setting_values = '".addslashes($data_update)."' WHERE setting_group = '$group' AND setting_label = '".$setting_to_update."'  ";	
		
		$this->setSql($sql);
		$ret = $this->modify();
		return $ret;       
  	}    
	
	function getSetting($group, $name)
	{
		
		$sql = " SELECT * FROM ".$this->mTable." WHERE setting_group = '$group' AND setting_label = '$name' ";	
		$this->setSql($sql);
		$ret = $this->obtain();
		return $ret;       
  	}  
	
	function giveofGroup($group)
	{
		$sql = " SELECT * FROM ".$this->mTable." WHERE setting_group = '$group' ORDER BY setting_order ";
		$this->setSql($sql);
		$ret = $this->obtain();
		return $ret;       
  	}     

}
?>