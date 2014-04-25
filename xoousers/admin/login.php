<?php
include("../xoo-ini.php");
$auxC = new User();

if(isset($_SESSION['user'])) {header("Location: index.php");}

if($_POST["act"] == 'sign_up') 
{	
	
	
	$resp = $auxC->Login($_POST["nick"],  $_POST["pass1"]);
	
	$mess = "";
	
	if($resp=="NOOK")
	{
		$mess .= "Error, invalid username or password!";				 
		
		$OK = false;
	
	
	}else{		
		
		
		$OK = true;
		//redirect	
				
		header("Location: index.php");	
			
		
	
	
	
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
      
      <input type="hidden" name="act" value="sign_up">
        <h2 class="form-signin-heading">Admin Login</h2>
        <input type="text" class="input-block-level" placeholder="input username" name="nick">
        <input type="password" class="input-block-level" placeholder="Password" name="pass1">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
        
        <p> <a href="password_forgot.php">Forgot password?</a> </p>
        
         <p style="color: #F00"><?php echo $mess?> </p>
      </form>

    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>