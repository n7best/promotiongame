<?php
require_once(SCRIPT_REAL_PATH."/xoo-ini.php");
class Persistent 
{
	
	var $mCod;
	var $mCon;
	var $mSQL;	
	var $mDateToday ;
	
	
	function conectDB()
	{
			
		
		try {
			$conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.'',DB_USER, DB_PASSWORD);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
		
		return $conn;


		
	}

	function setCon()
	{
		$this->mCon = $this->conectDB();		
		
	}
	
	function startTransaction()
	{
		$this->mSQL ="BEGIN";
		$this->save();
	}
	
	function commitTransaction()
	{
		$this->mSQL ="COMMIT";
		$this->save();
	}
	
	function rollBackTransaction()
	{
		$this->mSQL ="ROLLBACK";
		$this->save();
		echo "Transaction Failed";
	}	
	
	function setSql($pVal)
	{
		$this->mSQL = $pVal;
	}	
	
	function getSql()
	{
		return $this->mSQL ;
	}
	
	function save()
	{			
		 /*** INSERT data ***/
		 
		 $insert = $this->mCon->prepare($this->getSql()) or die(print_link_error());        
         $insert->execute();
        
         $id = $this->mCon->lastInsertId();
		
		return $id;
	}
	
	function obtain()
	{		
		
		$result =$this->mCon->query($this->getSql());
		return $result;
	}
	
	function delete()
	{		
		
		return $this->mCon->exec($this->getSql());
	}
	
	function modify()
	{
		
		$this->mCon->exec($this->getSql());
	}

	function dynamic_Delete($cod,$tabla,$clave)
	{		
		$sql = "Delete from ".$tabla. " where ".$clave." = '$cod'";	
		$this->setCon();	
		$this->setSql($sql);
		$this->delete();
	}
	
	function getOneDynamic($id, $key, $table, $fields) 
	{
		
        $sql = "SELECT ".$fields." FROM ".$table."  where ".$key." = '".$id."' ";
        $this->setSql($sql);
		$ret = $this->obtain();	
        return  $ret;
    }
	
	function updateOneDynamic($id, $key, $table, $fields) 
	{
		$this->setCon();
        $sql = "UPDATE ".$table." SET ".$fields."  where ".$key." = '".$id."' ";
        $this->setSql($sql);		
        $this->obtain();
    }
	
	

    function dynamic_DeleteLists($tabla, $clave, $colReg) 
	{
		if(sizeof($colReg) > 0) 
		{
        	foreach($colReg as $i)
			 {
				$this->dynamic_Delete($i, $tabla, $clave);
            }
        }
    }
	function dynamic_update($table, $clave,$field,$status,$cod)
	{
		$sql = "Update ".$table." Set ".$field." = ".$status." where ".$clave." = ".$cod."";
		$this->setCon();
		$this->setSql($sql);
		$this->modify();
            
        
    }
	
	function genRandomString() 
	{
		$length = 5;
		$characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWZYZ";
		
		$real_string_legnth = strlen($characters) ;
		//$real_string_legnth = $real_string_legnth– 1;
		$string="ID";
		
		for ($p = 0; $p < $length; $p++)
		{
			$string .= $characters[mt_rand(0, $real_string_legnth-1)];
		}
		
		return strtolower($string);
	}
	

	
	function getRandomPass()
	{
		$clave="";	
		
		$max_chars=6;  
		$chars=array();
		
		for($i="a";$i<"z";$i++)
		{
		  $chars[]=$i;  
		  $chars[] = "z";
		}
		
		for ($i=0; $i<$max_chars; $i++)
		{
		  $char=round(rand(0, 1));  
		  if ($char) 
		  { 
		 	$clave.= $chars[round(rand(0,count($chars)-1))];
			
		  }else {
			  
		 	$clave.= round(rand(0, 9));
		  }
		}
		return $clave;
	}
	
	function getMonthName($month) 
	{
		$mo = "";
		
		if($month == 1)
		{
			$mo = "Jan";
			
		}elseif($month==2){	
			
			$mo = "Feb";			
			
		}elseif($month==3){	
			
			$mo = "Mar";
		
		}elseif($month==4){	
			
			$mo = "Apr";		
		
		}elseif($month==5){	
			
			$mo = "May";
		
		}elseif($month==6){	
			
			$mo = "Jun";
			
		}elseif($month==7){	
			
			$mo = "Jul";
			
		}elseif($month==8){	
			
			$mo = "Aug";
			
		}elseif($month==9){	
			
			$mo = "Sep";
		
		}elseif($month==10){	
			
			$mo = "Oct";
			
		
		}elseif($month==11){	
			
			$mo = "Nov";
			
		}elseif($month==12){	
			
			$mo = "Dec";			
		}
		
		return $mo;
	}	

	function convertToMySql($dateAux) 
	{
		$month=substr($dateAux,0,2);
		$day=substr($dateAux,3,2);
		$year=substr($dateAux,6,10);
		$unVal = "$year-$month-$day" ;
		return $unVal;
       
    }
	
	function total_format($amount, $dec) 
	{
		$amount = number_format($amount,$dec,".",",") ;
		return $amount;
       
    }
}
?>