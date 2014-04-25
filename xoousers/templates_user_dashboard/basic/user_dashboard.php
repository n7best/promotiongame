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
<title><?php echo WEBSITE_NAME?> - Dashboard</title>

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
            
             <h4><?php echo $h1?></h4>
              <p><?php echo $mess?></p>
              
               <p>
                 
                 <?php if ($rowMember->member_avatar!="") {?>
                     <a href="user_dashboard_avatar.php"><img src="<?php echo MEDIA_PATH?>/<?php echo $c?>/<?php echo $rowMember->member_avatar?>" ></a>
                 <?php }else{?>
               
                 <a href="user_dashboard_avatar.php"><img src="templates_user_dashboard/<?php echo TEMPLATE_USER_DASHBOARD?>/img/djywxxif2gk.png" width="64" height="64"></a>
                 
                 <?php }?>
                 </p>
                 
                  <p><?php echo $lang['U_DASHBOARD_LAST_IP']?>: <?php echo $_SESSION['XOOSCRIPTS_USER']->member_last_ip?> </p> 
                  
                    <p><?php echo $lang['U_DASHBOARD_LAST_LOGIN_DATE']?>: <?php echo date("m/d/Y H:m", strtotime($_SESSION['XOOSCRIPTS_USER']->member_last_date))?> </p> 
                  
                 <p><?php echo $lang['U_DASHBOARD_MEMBER_SINCE']?>: <?php echo date("m/d/Y", strtotime($_SESSION['XOOSCRIPTS_USER']->member_creation_date))?> </p>            
                <p><?php echo $lang['U_DASHBOARD_YOUR_NAME']?>: <?php echo $_SESSION['XOOSCRIPTS_USER']->member_name?> </p>
                 <p><?php echo $lang['U_DASHBOARD_YOUR_USER_IS']?>: <?php echo $_SESSION['XOOSCRIPTS_USER']->member_user?> </p>
                  <p><?php echo $lang['U_DASHBOARD_YOUR_EMAIL_IS'] ?>: <?php echo $_SESSION['XOOSCRIPTS_USER']->member_email?> </p>
                
         </div>	  
	</div>	
    
    </div>	
    
    
     <!-- Footer
    ================================================== -->
   <?php include("footer.php")?>
	

   
    
</body>
</html>