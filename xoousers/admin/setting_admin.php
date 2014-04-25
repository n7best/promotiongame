<?php
include("../xoo-ini.php");
require_once("security.php");

$auxSetting = new Setting();
$auxuUser = new User();





if($_POST["act"] == 'update') 
{
		
	
	
	if($_POST["user_email"] != '') //
	{
		//update email
		$auxUser = new User();
		$auxUser->update_email($_SESSION['user']->user_id, $_POST["user_email"]);
		
	}
	
	if($_POST["user_password"] != '') //
	{
		//update email
		$auxUser = new User();
		$auxUser->update_pass($_SESSION['user']->user_id, $_POST["user_password"]);
		
	}
	
	$status = true;
	$message = '<strong>Success!</strong> The information has been updated.';

}
$drF =   $auxuUser->giveOne($_SESSION['user']->user_id);
$rowUser =$drF->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Admin Home Page</title>
        <?php include("metainfo.php");?>
       
    </head>
    
    <body>
<?php include("top.php");?>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php include("nav.php");?>
                
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="index.php">Dashboard</a> <span class="divider">/</span>	
	                                    </li>
	                                   
	                                    <li class="active">Admin Setting</li>
	                                </ul>
                            	</div>
                        	</div>
               	  </div>
                    
      <div class="row-fluid">
      
                                 
                                    
                        <div class="span6">
                        
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
                                    
                                     <p style="color: #F00"><?php echo $ret_validate?> </p>
           <?php }?>                           
                                    
                                    
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Admin Settings</div>
                                </div>
                                <div class="block-content ">
                                
                                <div style="margin-top:10px; ">
										
										<p>Here you can change the admin email and password.</p>
                                       </div>   
                                       
                                       <form class="form-horizontal" action='' method="POST" name="frm1" id="frm1">
                                       
                                       <input type="hidden" name="act" id="act" value="update">
  <fieldset>
    <div id="legend">
      <legend class="">Access Data:</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Email Address::</label>
      <div class="controls">
        <input type="text" id="user_email" name="user_email" placeholder="" class="input-xlarge" value="<?php echo $rowUser->user_email?>">
        
      </div>
    </div>
    
     
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">New Password:</label>
      <div class="controls">
        <input type="text" id="user_password" name="user_password" placeholder="" class="input-xlarge" value="">
        
      </div>
    </div>
    
    <div class="control-group">
      <div class="controls">
      <small><strong>Leave password blank if dont want to change</strong></small>
    </div>
    </div>
          
    <div class="control-group">
    
     <div class="controls">
     	
        <button class="btn btn-success" >Submit</button>
      </div>
      
      
         </div>
 
    
  </fieldset>
</form>

                                       
                                        
                                    
                                </div>
                            </div>
                            <!-- /block -->
                        </div>
                        <div class="span6">
                            <!-- block --><!-- /block -->
              </div>
                    </div>
                   
                    
                </div>
            </div>
            <hr>
            <?php include("footer.php");?>
        </div>
        <!--/.fluid-container-->
       
       
    </body>

</html>