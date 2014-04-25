<?php
require("SettingPersistent.php");

class Setting
{

    var $mPer;	
	var $mGroup;
	var $mLabel;
	var $mValue;

    public function __construct() 
	{
		$this->mPer = new SettingPersistent();				 
	}
	
	function giveofGroup($group) 
	{	       			
        return $this->mPer->giveofGroup($group);
    }	

    function update_setting($group, $setting_to_update, $data_update) 
	{	       			
        return $this->mPer->update_setting($group, $setting_to_update, $data_update);
    }
	
	function getSetting($group, $name) 
	{
		$val ="";	       			
        $rowSe = $this->mPer->getSetting($group, $name);
		
		 $rowSe = $rowSe->fetch(PDO::FETCH_OBJ);
		$val = $rowSe->setting_values;
		return $val;		
    }	

}
?>