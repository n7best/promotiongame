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
<title><?php echo WEBSITE_NAME?> - <?php echo $lang['U_DASHBOARD_CHANGE_PASS_H1']?></title>

<?php include("metainfo.php")?>

</head>

<body>






	
    <!-- TOP
    ================================================== -->
    <?php include("top.php")?>
	<div class="container-fluid">
		
            
       <div class="container-custom">
       
        <div class="header_dashboard" >
     <h1>Your Custom Header Goes Here</h1>
    </div>
		
            
       
             <div class="col1">
              <?php include("nav.php")?>
             </div>
            <div class="col2">
            
            
               <?php if(!$error && $_POST["act"] == 'update_password'){?>
                    <h4><?php echo $h1?></h4>
              <p><?php echo $mess?></p>
              
               <h3><?php echo $h2?></h3>
               
               
               <?php }else{ ?>
               
               <h4><?php echo $h1?></h4>
              <p><?php echo $mess?></p>
              
               <h3><?php echo $h2?></h3>
             <form name="form1" method="post" action="">
             <input type="hidden" name="act" id="act" value="update_password">
                <p><?php echo $lang['U_DASHBOARD_CHANGE_PASS_NEW_P']?>: </p>
                 <p>
                   <input type="password" name="u_password_1" id="u_password_1">
                 </p>
                 
                <p><?php echo $lang['U_DASHBOARD_CHANGE_PASS_NEW_P_AGAIN']?>: </p>
              <p>
                   <input type="password" name="u_password_2" id="u_password_2">
               </p>
                 
                               
                   <div class="controls">
     	
        <button class="btn btn-success" ><?php echo $lang['BUTTONS_SUBMIT']?></button>
      </div>
                
                 </form>
                 
                  <?php } ?>
            </div>	  
	</div>		
    
    
     <!-- Footer
    ================================================== -->
   <?php include("footer.php")?>
	</div>

   
    
</body>
</html>