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
	                                    
	                                    <li class="active">Protection</li>
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
                                    <div class="muted pull-left">Safeguarding Web Pages Based Upon User Levels</div>
                                </div>
                                <div class="block-content ">
                                
                                <div style="margin-top:10px; ">
										
										<p>Begin by simply putting together a brand new php web page that you would like to grant permission to access to all of your current users having user levels of 1 and 4.
Why don't we refer to this as web page with regards to this guide 'Levels_1-4_ Only.php".
</p>
                                        
                                        <b>1. On the beginning of your web page begin by putting in the following php code: </b>
                                        
                                        
                                          <p>
                                        <pre class="prettyprint lang-basic">

include("xoo-ini.php");

$login = new Login();

if(!$login->userRoleCheck("1,4"))
{	
	$login->redirect_to("index.php");	
}

echo "OK";

</pre>                 
                                        </p>
                                        <p>Always make sure that  your xoo-ini.php points to the right directory. One example is, In the event that the Levels_1-4_only.php page is within the exact same directory as the main script, then no changes should be made. If it doesn't then  you need to enter the correct path to the xoo-ini.php page. Depending on exactly where you placed Levels_3-4 _only.php page,  if below or above root directory xoo-ini.php will become  ../xoo-ini.php, if it is  below the root or other dir/xoo-ini.php,  if above the root. </p>
                                        
                                       
                           <b>2. At this point why don't we start adding some safeguards: </b>
                                         
                                         <p>The two main new lines of the code are the level's verification.  The first line  of code checks to see if the if user belongs to the  levels 1 or 4.  The second line of code will redirect the user to the login page index.php.</p>
                                         
                                         <b>3. Now you may go on to add some typical HTML code or even php code on your web page.</b>
                                         
                                         <p>Within this illustration we safeguarded a single web page by using a user level authentication process. In the event that the user does not have a appropriate user level in this instance 3 or 4,  we rerouted them to the login web page, if they did have the appropriate user level, they were allowed to view the web page.</p>
                                         
                                         
                                         <p>An additional example of this could be to display a custom-made error message in the event that the user doesn't have the correct user level. 
Your own customized error message could say something like , ' Oops!- You don't have Access to this Page'.

</p>
                                         
                                       </div>   
                                       
                                       

                                       
                                        
                                    
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