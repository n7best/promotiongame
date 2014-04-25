<?php
include("../xoo-ini.php");
$auxC = new User();

if($_POST["act"] == 'send_password') 
{		
	//check if exists
	
	$dr = $auxC->recover_email($_POST["email"]);	
	$mess = "";
	
	$row_count = $dr->rowCount();
	
	if($row_count==0)
	{
		$mess .= "Oops! The email address you entered wasn't found!";				 
		
		$OK = false;
	
	
	}else{
		
		//reset password
		
		$rowUser =  $dr->fetch(PDO::FETCH_OBJ);
		
		$auxPer = new Persistent();
		$newpassword = $auxPer->getRandomPass();
		$auxC->update_pass($rowUser->user_id, $newpassword );
		
		//notify user		
		$auxC->notify_pass($rowUser, $newpassword);	    
		
		$mess .= "Thanks, a new password has been sent to ". $_POST["email"];
		
		
		$OK = true;
		
	
	
	
	}
	
	


}



?>
<!DOCTYPE html>
<html>

  <head>
    <title>Admin Login</title>
<?php include("metainfo.php");?>
  </head>
  <body id="login">
    <div class="container">
    
   

      <form class="form-signin" method="post">
      
      <input type="hidden" name="act" value="send_password">
        <h2 class="form-signin-heading">Password Reset</h2>
        <input name="email" type="text" class="input-block-level" id="email" placeholder="input email">
        
        
        <button class="btn btn-large btn-primary" type="submit">Submit</button>
         <p> <a href="login.php">Login</a> </p>
        
         <p style="color: #F00"><?php echo $mess?> </p>
      </form>

    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>