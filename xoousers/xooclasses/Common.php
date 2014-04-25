<?php
class Common {
	
	var $mPer;	
	
	public function __construct() 
	{
				 
	}
	
	function fetchResults($dr)
	{
		$dr =  $dr->fetch(PDO::FETCH_OBJ);	
		return $dr;
	}
	
	function cleanStr($str) 
	{
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return $str;
	}
	
	function seo_standar($chain){
    	$chain = trim($chain);
		$chain = str_replace(" ", "-",  $chain);
		$chain = str_replace("ñ", "N",  $chain);
		$chain = str_replace("Ñ", "N",  $chain);
		$chain = str_replace("N", "N",  $chain);
		$chain = str_replace("í", "i",  $chain);
		$chain = str_replace("á", "a",  $chain);
		$chain = str_replace("ó", "o",  $chain);
		$chain = str_replace(",", "-",  $chain);
		$chain = str_replace(":", "-",  $chain);
		$chain = str_replace("´", "-",  $chain);
		$chain = str_replace("Ç", "c",  $chain);
		$chain = str_replace("ç", "c",  $chain);
		$chain = str_replace("'", "",   $chain);
		$chain = str_replace(".", "-",  $chain);
		$chain = str_replace("/", "-",  $chain);
		$chain = str_replace("&", "-",  $chain);
		$chain = strtolower($chain);

	return $chain;
	}
	
	function validate ($required_fields)
	{
		$ret = "";
		foreach($required_fields as $field_name => $val)
		{
			$field_to_save = $this->givemePostData($field_name);
			
			if($field_to_save=="")
			{
				$ret .= $val."<br>" ;			
			}			
										
							
		} 
		
		return $ret;
	
	}	
	
	function validate_valid_email ($myString)
	{
		$ret = true;
		if (!filter_var($myString, FILTER_VALIDATE_EMAIL)) {
    		// invalid e-mail address
			$ret = false;
		}
					
		return $ret;
	
	
	}
	
	//validate password one letter and one number	
	function validate_password_numbers_letters ($myString)
	{
		$ret = false;
		
		
		if (preg_match('/[A-Za-z]/', $myString) && preg_match('/[0-9]/', $myString))
		{
			$ret = true;
		}
					
		return $ret;
	
	
	}
	
	//at least one upper case character 	
	function validate_password_one_uppercase ($myString)
	{	
		
		if( preg_match( '~[A-Z]~', $myString) ){
   			 $ret = true;
		} else {
			
			$ret = false;
		  
		}
					
		return $ret;
	
	}
	
	//at least one lower case character 	
	function validate_password_one_lowerrcase ($myString)
	{	
		
		if( preg_match( '~[a-z]~', $myString) ){
   			 $ret = true;
		} else {
			
			$ret = false;
		  
		}
					
		return $ret;	
	
	}
	
	function genRandomPassword() 
	{
		$length = 6;
		$characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWZYZ";
		//$characters = "0123456789";
		
		$real_string_legnth = strlen($characters) ;
		//$real_string_legnth = $real_string_legnth– 1;
		$string="";
		
		for ($p = 0; $p < $length; $p++) {
		$string .= $characters[mt_rand(0, $real_string_legnth-1)];
		}
		
		return strtolower($string);
	}
	
	function genRandomActivation() 
	{
		$length = 6;
		//$characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWZYZ";
		$characters = "0123456789";
		
		$real_string_legnth = strlen($characters) ;
		//$real_string_legnth = $real_string_legnth– 1;
		$string="";
		
		for ($p = 0; $p < $length; $p++) {
		$string .= $characters[mt_rand(0, $real_string_legnth-1)];
		}
		
		return $string;
	}
	
	function givemePostData ($field){ 
	
		$val_ret = "";
			
		foreach($_POST as $field_name => $val){ 
		   $asignation2 = "\$".$field_name."='" . $val . "';"; 	
			  
		  if ($field_name == $field){		  
			  $val_ret = $val; 	  
		  }
		   
		}  
		
		return $val_ret;
		   
	}
	
	function getPager($TotalReg, $page, $targetpage, $limit )
	{
					
		// How many adjacent pages should be shown on each side?
		$adjacents = 1;
		
		//echo $target_page;
		
		/* 
		   First get total number of rows in data table. 
		   If you have a WHERE clause in your query, make sure you mirror it here.
		*/
		
		$total_pages = $TotalReg;
		
		/* Setup vars for query. */
		//$targetpage = "filename.php"; 	//your file name  (the name of this file)
		//$limit = 2; 								//how many items to show per page
		//$page = $_GET['page'];
		if($page) 
			$start = ($page - 1) * $limit; 			//first item to display on this page
		else
			$start = 0;								//if no page var is given, set start to 0
		
				
		/* Setup page vars for display. */
		if ($page == 0) $page = 1;					//if no page var is given, default to 1.
		$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 = $lastpage - 1;						//last page minus 1
		
		/* 
			Now we apply our rules and draw the pagination object. 
			We're actually saving the code to a variable in case we want to draw it more than once.
		*/
		$sep_get = "&";
		
		$pagination = "";
		if($lastpage > 1)
		{	
			$pagination .= "<div class=\"pagination\">";
			//previous button
			if ($page > 1) 
				$pagination.= "<a href=\"$targetpage".$sep_get."page=$prev\">Previous</a>";
			else
				$pagination.= "<span class=\"disabled\">Previous</span>";	
			
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"active\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage".$sep_get."page=$counter\">$counter</a>";					
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 2))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"active\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage".$sep_get."page=$counter\">$counter</a>";					
					}
					$pagination.= "...";
					$pagination.= "<a href=\"$targetpage".$sep_get."page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"$targetpage".$sep_get."page=$lastpage\">$lastpage</a>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href=\"$targetpage".$sep_get."page=1\">1</a>";
					$pagination.= "<a href=\"$targetpage".$sep_get."page=2\">2</a>";
					$pagination.= "...";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"active\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage".$sep_get."page=$counter\">$counter</a>";					
					}
					$pagination.= "...";
					$pagination.= "<a href=\"$targetpage".$sep_get."page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"$targetpage".$sep_get."page=$lastpage\">$lastpage</a>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination.= "<a href=\"$targetpage".$sep_get."page=1\">1</a>";
					$pagination.= "<a href=\"$targetpage".$sep_get."page=2\">2</a>";
					$pagination.= "...";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"active\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage".$sep_get."page=$counter\">$counter</a>";					
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
				$pagination.= "<a href=\"$targetpage".$sep_get."page=$next\">Next</a>";
			else
				$pagination.= "<span class=\"disabled\">Next</span>";
			$pagination.= "</div>\n";		
		}
		
		return $pagination;
	
	}
    
}

?>