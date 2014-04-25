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
                                    <div class="muted pull-left">Safeguarding Web Pages Based Upon User Login Status</div>
                                </div>
                                <div class="block-content ">
                                
                                <div style="margin-top:10px; ">
										
										<p>Start by simply making a brand new php web page that you would like to grant access to all of your current users. Let's refer to this page when it comes to this specific guide 'Only_Loged_Users.php'.</p>
                                        
                                      
                                        
                                  <b>1. On the very start of the web page begin by putting in this php code: </b>
                                        
                                          <p>
                                        <pre class="prettyprint lang-basic">

include("xoo-ini.php");

$login = new Login();

if($login->checkLoggedIn())
{
	$login->redirect_to("user_dashboard.php");
	
}else{
	
	//user is not logged in	
	echo "Your custom error message goes here, such as You're not loged in!!!";
	exit;	
}

</pre>                 
                                        </p>
                                        
                                        <p>Be sure that  xoo-init.php points to the right  directory. </p>
                                        
                                        
                           <p><b>2. At this point we should add protection: </b>                                  </p>
             <p>The two new lines of code will be the login verification. The first line will check  if user is not logged in. While the second line will display an error message. You may redirect users to a custom error page as well by adding this line of code $login->redirect_to("user_dashboard.php");.</p>
                                         
                                        
                                         
                                    <p>Within this illustration we safeguarded an individual web page by using a login verification procedure. When the user is  logged in, they are then redirected to a default page &quot;user_dashboard.php&quot; page, otherwise, if they are not logged in we display an error message.</p>
                                         
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