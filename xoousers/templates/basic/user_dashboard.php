<?php
$login = new Login();
if(!$login->checkLoggedIn())
{
	echo "Not logged in";
	exit;

}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo WEBSITE_NAME?>- Account Confirmation</title>

<?php include("metainfo.php")?>

</head>

<body>


<!-- Navbar
    ================================================== -->

<?php include("top.php")?>

	<div id="wrap">
	<div class="container">
		<div class="row">
			<div class="span3 hidden-phone"></div>
			<div class="span6" id="form-login">
            
            <div ><a href="logout.php">Log out</a></div>
            
             <h1><?php echo $h1?></h1>
              <p><?php echo $mess?></p>
              
               <h3><?php echo $h2?></h3>
            
                <p>Your name is: <?php echo $_SESSION['XOOSCRIPTS_USER']->member_name?> </p>
                 <p>Your user is: <?php echo $_SESSION['XOOSCRIPTS_USER']->member_user?> </p>
                  <p>Your email is: <?php echo $_SESSION['XOOSCRIPTS_USER']->member_email?> </p>
                
                
				
			</div>
			<div class="span3 hidden-phone"></div>
		</div>
	</div>
	<div id="push"></div>
	</div>

    <!-- Footer
    ================================================== -->
   <?php include("footer.php")?>
    
</body>
</html>