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
<title><?php echo WEBSITE_NAME?> - <?php echo $lang['U_DASHBOARD_AVATAR_H1']?></title>

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
              
               <h3><?php echo $h2?></h3>
               
                <?php if($status){?>
      
              <div class="alert alert-success">
                <button class="close" data-dismiss="alert">&times;</button>
                    <?php echo $message?>
                </div>
               <?php }?> 
               
               
                <?php if($error){?>
               <div class="alert alert-error">
                        <button class="close" data-dismiss="alert">&times;</button>
                        <?php echo $message?>
                                            </div>
                                    
                                     
               <?php }?>   
           
             <form name="form1" method="post" action="" enctype="multipart/form-data">
             <input type="hidden" name="act" id="act" value="update_password">
             
                 <div class="custom_avatar">
                <p><strong><?php echo $lang['U_DASHBOARD_AVATAR_YOUR_AVATAR']?>: </strong></p>
                 <p>
                 
                 <?php if ($rowMember->member_avatar!="") {?>
                     <img src="<?php echo MEDIA_PATH?>/<?php echo $c?>/<?php echo $rowMember->member_avatar?>" >
                 <?php }else{?>
               
                 <img src="templates_user_dashboard/<?php echo TEMPLATE_USER_DASHBOARD?>/img/djywxxif2gk.png" width="64" height="64">
                 
                 <?php }?>
                 </p>
                 
                
                 
                <p>
                  <input type="file" name="avatar" id="avatar">
                  <br>
                  <small><?php echo $lang['U_DASHBOARD_AVATAR_EXT_ONLY']?>: jpg,png,jpeg & gift <?php echo $lang['U_DASHBOARD_AVATAR_EXT_ALLOWED']?>
                -  <?php echo $lang['U_DASHBOARD_AVATAR_RESIZED']?>: <?php echo $lang['U_DASHBOARD_AVATAR_RESIZED_W']?> <?php echo $auxSetting->getSetting("website",  "avatar_width");?>px X <?php echo $lang['U_DASHBOARD_AVATAR_RESIZED_H']?>: <?php echo $auxSetting->getSetting("website",  "avatar_height");?>px. </small></p>
                 
                  <div class="controls">
     	
        <button class="btn btn-success" ><?php echo $lang['BUTTONS_SUBMIT']?></button>
      </div>
                 
                 </div>
                
                  <?php if($_SESSION['XOOSCRIPTS_USER']->member_fb != "" && $_SESSION['XOOSCRIPTS_USER']->member_registration_type == 2 ){ //avatar from FB?>
                  
                   <div class="fb_avatar">
                   <p><strong><?php echo $lang['U_DASHBOARD_AVATAR_YOUR_AVATAR_FROM_FB']?></strong></p>
                  <p>
                                  
                  <img src="https://graph.facebook.com/<?php echo $_SESSION['XOOSCRIPTS_USER']->member_fb?>/picture">
                   </p>
                   
                   </div>
                   <?php }?>
                
                 </form>
                
            </div>	  
	</div>		
    
    
     <!-- Footer
    ================================================== -->
   <?php include("footer.php")?>
	</div>

   
    
</body>
</html>