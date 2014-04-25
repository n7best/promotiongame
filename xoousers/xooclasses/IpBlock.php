<?php
require("IpBlockPersistent.php");

class IpBlock extends Common 
{	
	var $mPer;	
	var $ip_address;
	
	
	public function __construct() 
	{
		$this->mPer = new IpBlockPersistent();				 
	}
	
	function add_item($DATA) 
	{
		$this->ip_address = $DATA["ip_address"];		    	
        return $this->mPer->save_item($this);
    }

	function getOne($c) 
	{
		$res = true;
		$dr = $this->mPer->getOne($c);
		
		$row_count = $dr->rowCount();
		
		if($row_count!=0) $res=false;		
        return $res;
    }	
	
	function getTotal() 
	{				
		$dr = $this->mPer->getTotal();
		$row = $this->fetchResults($dr);		
        return $row->total;		
    }
	
	function getAllInternal()  
	{
		return $this->mPer->getAllInternal();		
    }
	
	
	function deleteRecord($id)  
	{
		return $this->mPer->deleteRecord($id);		
    }
	
}
?>