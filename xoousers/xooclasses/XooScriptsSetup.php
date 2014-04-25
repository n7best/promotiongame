<?php
require("XooScriptsSetupPersistent.php");

class XooScriptsSetup extends Common {
	
	var $mPer;	
	
	public function __construct() 
	{
		$this->mPer = new XooScriptsSetupPersistent();				 
	}
	
	
	
	function checkConection() 
	{
		
		$this->mPer->conectDB();	
	
	}
	
	function checkAlreadyInstalled() 
	{
		
		$dr = $this->mPer->checkAlreadyInstalled();	
		$row_count = $dr->rowCount();
		
		if($row_count!=0){ echo "The script is already installed"; exit;}
	
	}
	function checkAlreadyInstalledInt() 
	{
		$ret = false;
		
		$dr = $this->mPer->checkAlreadyInstalled();	
		
		$row_count = $dr->rowCount();

		
		if($row_count!=0){$ret = true;}
		
		return $ret;
	
	}
	
	
	
	
	
	function createDBStructure() 
	{
	   $sql_file = 'sql.sql';
	   $contents = file_get_contents($sql_file);
		
		// Remove C style and inline comments
		$comment_patterns = array('/\/\*.*(\n)*.*(\*\/)?/', //C comments
                          '/\s*--.*\n/', //inline comments start with --
                          '/\s*#.*\n/', //inline comments start with #
                          );
		$contents = preg_replace($comment_patterns, "\n", $contents);
			
		//Retrieve sql statements
		$statements = explode(";\n", $contents);
		$statements = preg_replace("/\s/", ' ', $statements);
			
		
			
			foreach ($statements as $query) {
				if (trim($query) != '') {
					//echo 'Executing query: ' . $query . "\n";
					$res = $this->mPer->save_item($query);			
					
				}
			}		
			
		
    }
	
	function createSettings() 
	{
	   $sql_file = 'sql-settings.sql';
	   $contents = file_get_contents($sql_file);
		
		// Remove C style and inline comments
		$comment_patterns = array('/\/\*.*(\n)*.*(\*\/)?/', //C comments
                          '/\s*--.*\n/', //inline comments start with --
                          '/\s*#.*\n/', //inline comments start with #
                          );
		$contents = preg_replace($comment_patterns, "\n", $contents);
			
		//Retrieve sql statements
		$statements = explode(";\n", $contents);
		$statements = preg_replace("/\s/", ' ', $statements);
			
		
			
			foreach ($statements as $query) {
				if (trim($query) != '') {
					//echo 'Executing query: ' . $query . "\n";
					$res = $this->mPer->save_item($query);			
					
				}
			}		
			
		
    }
	
	function createAdminUser($DATA) 
	{
				   	
        $this->mPer->createAdminUser($DATA);
		
    }
	
	function curPageURL() {
	 $pageURL = 'http';
	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
}

	
	
	
	
	
    
}

?>