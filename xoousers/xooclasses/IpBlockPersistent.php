<?php
require_once("Persistent.php");
class IpBlockPersistent extends Persistent 
{
	var $mTable;
	
	public function __construct() 
	{
		$this->setCon();
		$this->mTable= DB_PREFIX."_ip_blocking";
	}
	
	 function save_item($DATA) 
	 {
				
		$sql = "INSERT INTO ".$this->mTable." (ip_address) VALUES(";						
		$sql.= "'".mysql_real_escape_string($DATA->ip_address)."') ";		
		$this->setSql($sql);
		$result = $this->save();
		return 	$result;		
     }	

	function getOne($id) 
	{
        $sql = "SELECT *  FROM ".$this->mTable." where ip_address = '$id' 	";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function deleteRecord($id) 
	{
        $sql = "DELETE FROM ".$this->mTable." where ip_address = '$id' 	";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function getAllInternal() 
	{
        $sql = "SELECT * FROM ".$this->mTable."  ORDER BY  	ip_address asc	";		
		
       	$this->setSql($sql);
        return $this->obtain();
    }	
	
}
?>