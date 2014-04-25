<?php
include("../xoo-ini.php");
require_once("security.php");

$auxCommon = new Common();

if($_POST["act"] == 'add_role') 
{
	$error = false;
	$message = '<strong>Error!</strong> Please fix the following errors.';
	
	
	foreach($_POST as $field_name => $val)
	{ 
		$assign = "\$".$field_name."='".$val."';"; 
		eval($assign); 
	}
		
	$required_fields = array(role_name => "Please input role name." );
	
	
	//validate empy inputs	
	$ret_validate = $auxCommon->validate($required_fields);
	
	if($ret_validate!="") $error = true;	
	
	if($ret_validate=="")	
	{
		
		$auxRole = new MemberRole();
		
		$auxRole->add_item($_POST);
		
		$status = true;
		$message = '<strong>Success!</strong> The new role has been added.';

	}
	
	

}

	






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
	                                    <li>
	                                        <a href="roles.php">Roles</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li class="active">Add New Role</li>
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
                                    <div class="muted pull-left">Add New Role</div>
                                </div>
                                <div class="block-content ">
                                
                                <div style="margin-top:10px; ">
										
										<p>Here you can add new roles.</p>
                                       </div>   
                                       
                                       <form class="form-horizontal" action='' method="POST" name="frm1" id="frm1">
                                       
                                       <input type="hidden" name="act" id="act" value="add_role">
  <fieldset>
    <div id="legend">
      <legend class="">Role Data:</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Role Name:</label>
      <div class="controls">
        <input type="text" id="role_name" name="role_name" placeholder="" class="input-xlarge" value="">
        
      </div>
    </div>
    
     
    
          
    <div class="control-group">
    
     <div class="controls">
     	<button class="btn" id="back-roles" type="button">Cancel</button>
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