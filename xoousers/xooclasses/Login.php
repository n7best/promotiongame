<?php
class Login extends Common 
{
			
	function checkLoggedIn() 
	{		
		if(isset($_SESSION['XOOSCRIPTS_USER']))	
		{
			$ret = true;			
		
		}else{
			
			$ret = false;		
		}
		    	
        return $ret;
    }
	
	function userRoleCheck($roles) 
	{
		$user_role = $_SESSION['XOOSCRIPTS_USER']->member_role_id;
		
		if (strpos($roles, $user_role) !== false) 
		{		
		    $ret = true;			
		
		}else{
			
			$ret = false;		
		}
		
        return $ret;
    }
	
	function redirect_to($url) 
	{		
		header("Location: ".$url."");
		exit;
    }
}
?>