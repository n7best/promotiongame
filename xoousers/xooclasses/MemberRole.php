<?php
require("MemberRolePersistent.php");

class MemberRole extends Common {
	
	var $mPer;	
	var $role_id;
	var $role_name;
	
	public function __construct() 
	{
		$this->mPer = new MemberRolePersistent();				 
	}
	
	function add_item($DATA) 
	{
		$this->role_name = $DATA["role_name"];	
		    	
        return $this->mPer->save_item($this);
    }
	
	function edit_item($DATA, $c) 
	{
		$this->role_id = $c;		
		$this->role_name = $DATA["role_name"];	   	
        return $this->mPer->edit_item($this);
    }
	

	function getOne($c) 
	{
		$dr = $this->mPer->getOne($c);
		$row = $this->fetchResults($dr);
		
        return $row;
    }
	
	function getTotal() 
	{				
		$dr = $this->mPer->getTotal();
		$row = $this->fetchResults($dr);		
        return $row->total;
		
    }
	
	function getAllInternal()  
	{
		return $this->mPer->getAllInternal()  ;
		
    }	
	
	function deleteRecord($id)  
	{
		return $this->mPer->deleteRecord($id)  ;
		
    }
	
	function getUsersInRole($c)  
	{
		return $this->mPer->getUsersInRole($c)  ;
		
    }	
}
?>