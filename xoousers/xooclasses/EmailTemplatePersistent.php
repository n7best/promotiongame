<?php
require_once("Persistent.php");
class EmailTemplatePersistent extends Persistent 
{
	var $mTable;
	
	public function __construct() 
	{
		$this->setCon();
		$this->mTable= DB_PREFIX."_email_templates";
						 
	} 
	
	function getOne($id) 
	{
        $sql = "SELECT *  FROM ".$this->mTable." where template_id = '$id' 	";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function update_template($c, $n, $body) 
	{
        $sql = "UPDATE  ".$this->mTable." SET template_name = '$n' , template_text = '$body' where template_id = '$c' 	";
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