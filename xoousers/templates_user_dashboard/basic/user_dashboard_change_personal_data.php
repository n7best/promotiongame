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
<title><?php echo WEBSITE_NAME?> - <?php echo $lang['U_DASHBOARD_DATA_H1']?></title>

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
           
           
             <form name="form1" method="post" action="">
             <input type="hidden" name="act" id="act" value="update_personal">
                <p><?php echo $lang['U_DASHBOARD_DATA_FULL_NAME']?>: </p>
                 <p>
                   <input type="text" name="member_name" id="member_name" value="<?php echo $rowMember->member_name?>">
                 </p>
                 
                <p><?php echo $lang['U_DASHBOARD_DATA_EMAIL']?>: </p>
              <p>
                   <input type="text" name="member_email" id="member_email" value="<?php echo $rowMember->member_email?>">
                   <input type="hidden" name="member_email2" id="member_email2" value="<?php echo $rowMember->member_email?>">
           </p>
                 
                                 
                   <div class="controls">
     	
        <button class="btn btn-success" ><?php echo $lang['BUTTONS_SUBMIT']?></button>
      </div>
                
                
                 </form>
                 
                  
            </div>	  
	</div>		
    
    
     <!-- Footer
    ================================================== -->
   <?php include("footer.php")?>
	</div>

   
    
</body>
</html>