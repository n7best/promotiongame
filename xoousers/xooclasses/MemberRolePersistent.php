<?php
require_once("Persistent.php");
class MemberRolePersistent extends Persistent 
{
	var $mTable;
	
	public function __construct() 
	{
		$this->setCon();
		$this->mTable= DB_PREFIX."_roles";
		$this->mTableUsers= DB_PREFIX."_members";
						 
	}
	
	 function save_item($DATA) 
	 {
		 $sql = "INSERT INTO ".$this->mTable." (role_name)	VALUES(";		$sql.= "'".($DATA->role_name)."') ";
							
		$this->setSql($sql);
		$result = $this->save();
		return 	$result;
		
     }	
	 
	 function edit_item($DATA) 
	 {
		 				
		$sql = "UPDATE ".$this->mTable." SET role_name =  '".$DATA->role_name."' WHERE role_id = '".$DATA->role_id."' ";	
	
		$this->setSql($sql);
		$result = $this->save();
		return 	$result;
	 }	 
	 
 
	
	function getOne($id) 
	{
        $sql = "SELECT *  FROM ".$this->mTable." where role_id = '$id' 	";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function deleteRecord($id) 
	{
        $sql = "DELETE FROM ".$this->mTable." where role_id = '$id' 	";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	
	function getAllInternal() 
	{
        $sql = "SELECT * FROM ".$this->mTable."  ORDER BY  	role_name asc	";		
		
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function getUsersInRole($c) 
	{
		
        $sql = "SELECT * FROM ".$this->mTableUsers."  WHERE member_role_id LIKE '%".$c."%' ";		
		
       	$this->setSql($sql);
        return $this->obtain();
    }
	
}
?>