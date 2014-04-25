<?php
require("MemberPersistent.php");

class Member extends Common 
{
	
	var $mPer;	
	var $member_id;	
	var $member_name;
	var $member_user;
	var $member_email;
	var $member_pass;
	var $member_status; // 0 - no confirmed, 1-active, 2--banned
	var $member_role_id;
	var $member_hash;	
	var $member_google;	
	var $member_yahoo;
	var $member_linkedin;
	var $member_fb;	
	var $member_registration_type; // 1-common, 2 facebook, 3 yahoo, 4 google, 5 linkedin	
	var $avatar_temp_file;
	
	public function __construct() 
	{
		$this->mPer = new MemberPersistent();				 
	}
	
	function add_item($DATA) 
	{
		//default role
		$auxSetting = new Setting();
		$selected_role= $auxSetting->getSetting("website",  "default_role");
		
		if($selected_role=="")
		{			
			$selected_role=1;			
		}
		
		$this->member_role_id = $selected_role;
		 
		$this->member_name = $this->cleanStr($DATA["member_name"]);		
		$this->member_user = $this->cleanStr($DATA["member_user"]);		
		$this->member_email = $this->cleanStr($DATA["member_email"]);
		$this->member_pass =$this->cleanStr($DATA["member_pass"]);
		$this->member_hash =session_id()."_".time();		
    	
        return $this->mPer->save_item($this);
    }
	
	function add_fb() 
	{
		//default role
		$auxSetting = new Setting();
		$selected_role= $auxSetting->getSetting("website",  "default_role");
		
		if($selected_role=="")
		{			
			$selected_role=1;			
		}
		
		$this->member_role_id = $selected_role;
	
        return $this->mPer->save_fb($this);
    }
	
	function add_social() 
	{
		//default role
		$auxSetting = new Setting();
		$selected_role= $auxSetting->getSetting("website",  "default_role");
		
		if($selected_role=="")
		{			
			$selected_role=1;			
		}
		
		$this->member_role_id = $selected_role;
		
        return $this->mPer->add_social($this);
    }
	
	
	function update_personal_data($data, $c)
	{
		$data = $this->cleanStr($data);		   	
        return $this->mPer->update_personal_data($data, $c);
    }
	
	function update_avatar($o_id , $rand_name)
	{		
		$this->mPer->update_avatar($o_id , $rand_name);		
    }
	
	 function CreateDir($root)
	 {
		 if (is_dir($root))
		 {
			 $retorno = "0";
			 
         }else{
			 
			$oldumask = umask(0);
            $valrRet = mkdir($root,0777);
            umask($oldumask);
            $retorno = "1";
         }

     }
	 
	 function create_avatar($file,$path_pics, $w, $h) 
     {  

        $thumb_max_width = $w; 
        $thumb_max_height = $h; 
		$o_id = $this->member_id;				
		
		$info = pathinfo($file['name']);
        $ext = $info['extension'];
		$ext=strtolower($ext);
		
		$this->real_name = $file['name'];	   
			
			
		if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif') 
		{
			if($o_id != '')
			{
				if(!is_dir($path_pics."/".$o_id."")) 
				{
					$this->CreateDir($path_pics."/".$o_id);								   
				}
				
				$pathBig = $path_pics."/".$o_id."/".$this->avatar_temp_file.".".$ext;					
					
				$rand_name =	$this->avatar_temp_file;	
	
					
					
				if (copy($file['tmp_name'], $pathBig)) 
				{
					$uploaded_file_path = $pathBig;
					$processed_file_path = $pathBig;
						
											
						//check max width						
					
						$max_witdh =$thumb_max_width;
						$max_heigth =$thumb_max_height;
						
						list( $source_width, $source_height, $source_type ) = getimagesize($pathBig);
						
						if($source_width > $max_witdh) 
						{
							//resize
							if ($this->createthumb($pathBig, $pathBig, $max_witdh, $max_heigth,$ext)) 
							{
								$old = umask(0);
								chmod($pathBig, 0777);
								umask($old);
														
							}
						
						
						}
					
							
						//images
						$rand_name = $rand_name.".".$ext;
						$this->update_avatar($o_id , $rand_name)	;					
						
					}
					
					$men="Photo  uploaded" .$pathBig. "Water mark: ".$water_added; 
					
					
					}else{
						
						$men="Photo was not uploaded" .$pathBig. "Water mark: ".$water_added; 					
					
			     }
			  
			
        } // image type
		return $men;
    }
	
	function createthumb($imagen,$newImage,$toWidth, $toHeight,$extorig)
	{
		$ext=strtolower($extorig);
        
		switch($ext)
        {
			case 'png' : $img = imagecreatefrompng($imagen);
            break;
			
            case 'jpg' : $img = imagecreatefromjpeg($imagen);
            break;
			
            case 'jpeg' : $img = imagecreatefromjpeg($imagen);
            break;
			
			case 'gif' : $img = imagecreatefromgif($imagen);
            break;
          }

               
		  $width = imagesx($img);
		  $height = imagesy($img);  		  
		  $xscale=$width/$toWidth;
		  $yscale=$height/$toHeight;
		  
		  // Recalculate new size with default ratio
		  if ($yscale>$xscale)
		  {
			  $new_w = round($width * (1/$yscale));
			  $new_h = round($height * (1/$yscale));
			  
		  }else {
			  
			  $new_w = round($width * (1/$xscale));
			  $new_h = round($height * (1/$xscale));
		  }	  
		  
		  if($width < $toWidth)  {
			  
			  $new_w = $width;	
		  
		  //}else {					
			  //$new_w = $current_w;			
		  
		  }
		  
		  if($height < $toHeight)  {
			  
			  $new_h = $height;	
		  
		  //}else {					
			  //$new_h = $current_h;			
		  
		  }		  
		  
		  $dst_img = imagecreatetruecolor($new_w,$new_h);
		  
		  /* fix PNG transparency issues */                       
		  imagefill($dst_img, 0, 0, IMG_COLOR_TRANSPARENT);         
		  imagesavealpha($dst_img, true);      
		  imagealphablending($dst_img, true); 				
		  imagecopyresampled($dst_img,$img,0,0,0,0,$new_w,$new_h,imagesx($img),imagesy($img));
		  
		  
		   switch($ext)
			{
			 case 'png' : $img = imagepng($dst_img,"$newImage",9);
			 break;
			 case 'jpg' : $img = imagejpeg($dst_img,"$newImage",100);
			 break;
			 case 'jpeg' : $img = imagejpeg($dst_img,"$newImage",100);
			 break;
			 case 'gif' : $img = imagegif($dst_img,"$newImage");
			 break;
			}
			
			 imagedestroy($dst_img);	  
		  
		  return true;

    }
	
	
	function edit_item($DATA, $c) 
	{
		$this->member_id = $c;		
		$this->member_name = $DATA["member_name"];		
		$this->member_role_id = $DATA["member_role_id"];    	
        return $this->mPer->edit_item($this);
    }
	
	function getOne($c) 
	{
		$dr = $this->mPer->getOne($c);
		$row = $this->fetchResults($dr);		
        return $row;
    }
	
	function getTotalOfType($type) 
	{
		$dr = $this->mPer->getTotalOfType($type);
		$row = $this->fetchResults($dr);		
        return $row->total;
    }
	
	function getWithFacebook($c, $email) 
	{
		$dr = $this->mPer->getWithFacebook($c,  $email);
		$row = $this->fetchResults($dr);		
        return $row;
    }	
	
	function getWithEmail($c) 
	{
		$dr = $this->mPer->getWithEmail($c);
		$row = $this->fetchResults($dr);		
        return $row;
    }
	
	function getWithEmailSocial($c) 
	{
		$dr = $this->mPer->getWithEmailSocial($c);
		$row = $this->fetchResults($dr);
		
        return $row;
    }
	
	function getWithHash($c) 
	{
		$dr = $this->mPer->getWithHash($c);
		$row = $this->fetchResults($dr);
		
        return $row;
    }
	
	function getWithHashResetPassword($c) 
	{
		$dr = $this->mPer->getWithHashResetPassword($c);
		$row = $this->fetchResults($dr);
		
        return $row;
    }	
	
	function getWithHashAndNumber($c, $number) 
	{
		$dr = $this->mPer->getWithHashAndNumber($c , $number);
		$row = $this->fetchResults($dr);
		
        return $row;
    }	
	
	function validateCode($id) 
	{
		return $this->mPer->validateCode($id) ;		
    }
	
	function update_email($member_email, $c) 
	{
		return $this->mPer->update_email($member_email, $c);		
    }
	
	function update_role($role_id, $c)
	{
		return $this->mPer->update_role($role_id, $c);		
    }
		
	function reset_password($c, $new_password)
	{
		return $this->mPer->reset_password($c, $new_password) ;		
    }
	
	function ban_user($c)
	{
		return $this->mPer->ban_user($c) ;		
    }
	
	function delete_user($c)
	{
		return $this->mPer->delete_user($c) ;		
    }
	
	function getWithEmailReset($c) 
	{
		$dr = $this->mPer->getWithEmailReset($c);
		$row = $this->fetchResults($dr);
		
        return $row;
    }
	
	function getWithNick($c) 
	{
		$dr = $this->mPer->getWithNick($c);
		$row = $this->fetchResults($dr);
		
        return $row;
    }
	
	function activate_user($c)
	{
		return $this->mPer->activate_user($c) ;		
    }
	
	function getAll($key, $from, $to)
	{
		return $this->mPer->getAll($key, $from, $to) ;
		
    }
	
	function getLatest($howmany)
	{
		return $this->mPer->getLatest($howmany) ;		
    }
	
	function getAllOfRole($id)
	{
		return $this->mPer->getAllOfRole($id) ;		
    }
	
	
		
	function getTotal($key, $from, $to) 
	{				
		$dr = $this->mPer->getTotal($key, $from, $to);
		$row = $this->fetchResults($dr);		
        return $row->total;		
    } 
	
	function update_activation_number($user_id, $random) 
	{
		return $this->mPer->update_activation_number($user_id, $random) ;		
    }
	
	function validate_user_name($member_email , $member_user)
	{
		return $this->mPer->validate_user_name($member_email , $member_user) ;
		
    }
	
	function change_user_status($user_id, $status)
	{
		return $this->mPer->change_user_status($user_id, $status) ;
		
    }
	
	function confirmWithHash($id) 
	{
		return $this->mPer->confirmWithHash($id) ;		
    }
	
	function getTotalPeriod($day, $month, $year) 
	{
		$dr = $this->mPer->getTotalPeriod($day, $month, $year) ;
		$row = $this->fetchResults($dr);
		
        return $row->total;
		
    }	
	
	function sendBulk($role_id, $subject, $message) 
	{
		//get users
		$dr = $this->mPer->getAllOfRole($role_id) ;
		$email_arrary = array();
		
		 while($rowItem =  $dr->fetch(PDO::FETCH_OBJ))
         {
			 $email_arrary[] =  $rowItem->member_name.",". $rowItem->member_email;		 
		 
		 }
		 
		 
		 $auxMessage = new Messaging();
		 
	     $auxMessage->sendMessageBulk($email_arrary, $subject, $message);
		//print_r($email_arrary);
       
		
    }	
	
	function deleteRecord($id)  
	{
		return $this->mPer->deleteRecord($id)  ;
		
    }
	
	function Login($user, $password)
	{
		$resp = "NOOK";
    	$rowCutomer = 	$this->mPer->Login($user, $password);
			
		if(isset($_SESSION['XOOSCRIPTS_USER']))
		{
			unset($_SESSION['XOOSCRIPTS_USER']);
        }
		
		$row_countD = $rowCutomer->rowCount();
		
		if($row_countD != 0)
		{
			$_SESSION['XOOSCRIPTS_USER'] = $rowCutomer->fetch(PDO::FETCH_OBJ);	
			$resp = "";
			
			//reg last login ip adddress
			$id = $_SESSION['XOOSCRIPTS_USER']->member_id;
			$ip =  $_SERVER['REMOTE_ADDR'] ;			
			$this->mPer->update_login_stats($id, $ip);
						
		}
		return $resp;
		        
    }
	
	
	function LoginSocial($id) 
	{
	    $resp = "NOOK";
    	$rowCutomer = 	$this->mPer->LoginSocial($id);
			
		if(isset($_SESSION['XOOSCRIPTS_USER'])) 
		{
			unset($_SESSION['XOOSCRIPTS_USER']);
        }
		
		$row_countD = $rowCutomer->rowCount();
		
		 
		if($row_countD != 0)
		{
			$_SESSION['XOOSCRIPTS_USER'] = $rowCutomer->fetch(PDO::FETCH_OBJ);		
			$resp = "";
						
			//reg last login ip adddress
			$id = $_SESSION['XOOSCRIPTS_USER']->member_id;
			$ip =  $_SERVER['REMOTE_ADDR'] ;			
			$this->mPer->update_login_stats($id, $ip);
			
		}
		return $resp;		        
    }
	
	function LoginWithID($id) 
	{
	    $resp = "NOOK";
    	$rowCutomer = 	$this->mPer->LoginWithID($id);
			
		if(isset($_SESSION['XOOSCRIPTS_USER'])) 
		{
			unset($_SESSION['XOOSCRIPTS_USER']);
        }
		
		$row_countD = $rowCutomer->rowCount();
		
		if($row_countD != 0)
		{
			$_SESSION['XOOSCRIPTS_USER'] = $rowCutomer->fetch(PDO::FETCH_OBJ);	
			$resp = "";			
			//reg last login ip adddress
			$id = $_SESSION['XOOSCRIPTS_USER']->member_id;
			$ip =  $_SERVER['REMOTE_ADDR'] ;			
			$this->mPer->update_login_stats($id, $ip);			
		}
		return $resp;
		        
    }	
}
?>