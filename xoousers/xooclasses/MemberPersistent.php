<?php
require_once("Persistent.php");
class MemberPersistent extends Persistent 
{
	var $mTable;
	
	public function __construct() 
	{
		$this->setCon();
		$this->mTable= DB_PREFIX."_members";
		$this->mTableRoles= DB_PREFIX."_roles";
						 
	}
	
	function save_item($DATA) 
	{
		$sql = "INSERT INTO ".$this->mTable." (member_name , member_user, member_email , member_pass  , member_hash, member_role_id, member_creation_date 	)						
			
			VALUES(";			
		
		$sql.= "'".$DATA->member_name."', ";						
		$sql.= "'".$DATA->member_user."', ";		
		$sql.= "'".$DATA->member_email."', ";
		$sql.= "'".md5($DATA->member_pass)."', ";
		$sql.= "'".$DATA->member_hash."', ";	
		$sql.= "'".$DATA->member_role_id."', ";	
		
			
		
		$sql.= "NOW())";	
							
		$this->setSql($sql);
		$result = $this->save();
		return 	$result;
		
     }
	 
	 function save_fb($DATA) 
	 {				
		$sql = "INSERT INTO ".$this->mTable." (member_name , member_user, member_email , member_pass  , member_hash,member_fb,  member_registration_type, member_status, member_role_id,  member_activation_date,  member_creation_date 	) VALUES(";			
		
		$sql.= "'".$DATA->member_name."', ";						
		$sql.= "'".$DATA->member_user."', ";		
		$sql.= "'".$DATA->member_email."', ";
		$sql.= "'".md5($DATA->member_pass)."', ";
		$sql.= "'".$DATA->member_hash."', ";
		$sql.= "'".$DATA->member_fb."', ";
		$sql.= "'2', ";
		$sql.= "'1', ";		
		$sql.= "'".$DATA->member_role_id."', ";
		$sql.= "NOW(),";	
		$sql.= "NOW())";		
							
		$this->setSql($sql);
		$result = $this->save();
		return 	$result;
		
     }
	
	 function add_social($DATA)
	 {
		 $sql = "INSERT INTO ".$this->mTable." (member_name , member_user, member_email , member_pass  , member_hash, member_registration_type, member_status, member_role_id, member_activation_date	, member_creation_date 	) VALUES(";			
		
		$sql.= "'".$DATA->member_name."', ";						
		$sql.= "'".$DATA->member_user."', ";		
		$sql.= "'".$DATA->member_email."', ";
		$sql.= "'".md5($DATA->member_pass)."', ";
		$sql.= "'".$DATA->member_hash."', ";
		$sql.= "'".$DATA->member_registration_type."', ";
				
		$sql.= "'1', ";	
		$sql.= "'".$DATA->member_role_id."', ";
		$sql.= "NOW(),";
		$sql.= "NOW())";	
								
		$this->setSql($sql);
		$result = $this->save();
		return 	$result;		
     }
	 
	 function edit_item($DATA) 
	 {
		 $sql = "UPDATE ".$this->mTable." SET member_name =  '".$DATA->member_name."', member_role_id = '".$DATA->member_role_id."' WHERE member_id = '".$DATA->member_id."' ";	
			
		$this->setSql($sql);
		$result = $this->save();
		return 	$result;
	 }
	 
	 function update_login_stats($ui, $ip) 
	 {
		 				
		$sql = "UPDATE ".$this->mTable." SET member_last_ip =  '$ip', member_last_date = NOW() WHERE member_id = '".$ui."' ";	
	
		$this->setSql($sql);
		$result = $this->save();
		return 	$result;
	}	 
	
	function getOne($id) 
	{
        $sql = "SELECT *  FROM ".$this->mTable." where member_id = '$id' 	";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function getTotalOfType($type) 
	{
        $sql = "SELECT count(*) as total  FROM ".$this->mTable." where member_registration_type = '$type' 	";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function getWithFacebook($id, $email) 
	{
        $sql = "SELECT *  FROM ".$this->mTable." where  member_email= '$email' ";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function getAllOfRole($id) 
	{
        $sql = "SELECT *  FROM ".$this->mTable." where  member_role_id= '$id' ";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function getWithNick($id) 
	{
        $sql = "SELECT *  FROM ".$this->mTable." where member_user = '$id' 	";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function getWithHash($id) 
	{
        $sql = "SELECT *  FROM ".$this->mTable." where member_hash = '$id' AND member_status = 0	";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function getWithHashResetPassword($id) 
	{
        $sql = "SELECT *  FROM ".$this->mTable." where member_hash = '$id' AND member_status = 1	";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function getWithHashAndNumber($c , $number)
	{
        $sql = "SELECT *  FROM ".$this->mTable." where member_hash = '$c' AND   member_activation_string = '$number' AND member_status = 0	";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function confirmWithHash($id) 
	{
        $sql = "UPDATE ".$this->mTable." SET member_status = 1, member_activation_date = '".date('Y-m-d')."' where member_hash = '$id' AND member_status = 0	";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function reset_password($c, $new_password)
	{
        $sql = "UPDATE ".$this->mTable." SET member_pass = '".md5($new_password)."' where member_id = '$c' ";
		//echo $sql ;
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function update_personal_data($data, $c)
	{
        $sql = "UPDATE ".$this->mTable." SET member_name = '".$data."' where member_id = '$c' ";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function ban_user($c)
	{
        $sql = "UPDATE ".$this->mTable." SET member_status = '2' where member_id = '$c' ";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function update_avatar($c , $rand_name)
	{
        $sql = "UPDATE ".$this->mTable." SET member_avatar = '$rand_name' where member_id = '$c' ";
       	$this->setSql($sql);
        return $this->obtain();
    }
		
	function delete_user($c)
	{
        $sql = "DELETE FROM ".$this->mTable."  where member_id = '$c' ";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function activate_user($c)
	{
        $sql = "UPDATE ".$this->mTable." SET member_status = '1' where member_id = '$c' ";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function update_email($member_email, $c)
	{
        $sql = "UPDATE ".$this->mTable." SET member_email = '".$member_email."' where member_id = '$c' ";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function update_role($role_id, $c)
	{
        $sql = "UPDATE ".$this->mTable." SET member_role_id = '".$role_id."' where member_id = '$c' ";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function update_activation_number($user_id, $random) 
	{
        $sql = "UPDATE ".$this->mTable." SET member_activation_string = '$random' where member_id = '$user_id' ";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function change_user_status($user_id, $status) 
	{
        $sql = "UPDATE ".$this->mTable." SET member_status = '$status' where member_id = '$user_id' ";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function validate_user_name($member_email , $member_user)
	{
        $sql = "SELECT *  FROM ".$this->mTable." where member_email = '$member_email' OR   member_user = '$member_user'	";
       	$this->setSql($sql);
        return $this->obtain();
    }	
	
	function getWithEmail($id) 
	{
        $sql = "SELECT *  FROM ".$this->mTable." where member_email = '$id' 	";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function getWithEmailSocial($id) 
	{
        $sql = "SELECT *  FROM ".$this->mTable." where member_email = '$id' AND member_status = 1	";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function getWithEmailReset($id) 
	{
        $sql = "SELECT *  FROM ".$this->mTable." where member_email = '$id' AND member_status = 1	";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function getLatest($howmany) 
	{
		$sql = "SELECT  pr.*, role.* FROM ".$this->mTable." pr	";		
		$sql .= " RIGHT JOIN ".$this->mTableRoles."  role ON (role.role_id= pr.member_role_id)"; 		
		$sql .= " WHERE role.role_id= pr.member_role_id  ORDER BY pr.member_id DESC LIMIT $howmany 	 ";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function getAll($key, $from, $to) 
	{
        $sql = "SELECT  pr.*, role.* FROM ".$this->mTable." pr	";		
		$sql .= " RIGHT JOIN ".$this->mTableRoles."  role ON (role.role_id= pr.member_role_id)"; 		
		$sql .= " WHERE role.role_id= pr.member_role_id  	 ";
		
		if($key != "" )
		{
			$sql .= " AND (pr.member_name LIKE '%".$key."%' OR  pr.member_user LIKE '%".$key."%' OR pr.member_email LIKE '%".$key."%')"; 
		
		}
		
		if($from != "" && $to != ""){	$sql .= " LIMIT $from,$to"; }
	 	if($from == 0 && $to != ""){	$sql .= " LIMIT $from,$to"; }
		
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function getTotal($key, $from, $to) 
	{
        $sql = "SELECT count(*) as total, pr.*, role.* FROM ".$this->mTable." pr	";
		
		$sql .= " RIGHT JOIN ".$this->mTableRoles."  role ON (role.role_id= pr.member_role_id)";		
		$sql .= " WHERE role.role_id= pr.member_role_id  	 ";
		
	    if($key != "" )
		{
			$sql .= " AND (pr.member_name LIKE '%".$key."%' OR  pr.member_user LIKE '%".$key."%' OR pr.member_email LIKE '%".$key."%')"; 
		
		}
		 
     	$this->setSql($sql);
        return $this->obtain();
    }
	
	function getTotalPeriod($day, $month, $year) 
	{
        $sql = "SELECT count(*) as total FROM ".$this->mTable." 	WHERE member_id <> 0 ";
		
		
		if($day!="")
		{
			$sql .= " AND DAY(member_creation_date) = '$day'  ";
		}
		
		if($month!="")
		{
			$sql .= " AND MONTH(member_creation_date) = '$month'  ";
		}
		
		if($year!=""){$sql .= " AND YEAR(member_creation_date) = '$year'";}	
		
     	$this->setSql($sql);
        return $this->obtain();
    }
	
	function Login($usr, $password) 
	{
		$sql = "SELECT * from ".$this->mTable." where member_pass  = '".md5($password)."' AND member_user = '".$usr."'  AND member_status = 1";
		
		echo $sql;
       	$this->setSql($sql);
        return $this->obtain();
    }
		
	function LoginSocial($id) {
        $sql = "SELECT * from ".$this->mTable." where member_fb  = '$id' AND member_status = 1";
       	$this->setSql($sql);
        return $this->obtain();
    }
	
	function LoginWithID($id) {
        $sql = "SELECT * from ".$this->mTable." where member_id  = '$id' AND member_status = 1 ";
       	$this->setSql($sql);
        return $this->obtain();
    }	
	
}
?>