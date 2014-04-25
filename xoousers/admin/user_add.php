<?php
include("../xoo-ini.php");
require_once("security.php");

//
$auxUser = new Member();

$auxCommon = new Common();


if($_POST["act"] == 'add_new') 
{
	
	$error = false;
	$message = '<strong>Error!</strong> Please fix the following errors.';
	
	//validate email and username
	
	foreach($_POST as $field_name => $val)
	{ 
		$assign = "\$".$field_name."='".$val."';"; 
		eval($assign); 
	}
		
	$required_fields = array(member_name => "Please write name.", member_user => "Please write username." , member_email => "Please write email." );
	
	
	//validate empty inputs	
	$ret_validate = $auxCommon->validate($required_fields);
	
	//validate if it's a valid email address	
	$ret_validate_email = $auxCommon->validate_valid_email($member_email);
	
	if(!$ret_validate_email)
	{
		$ret_validate .= "Please write a valid E-mail Address" ."<br>";
	}
	
	
	
	if($ret_validate!="") $error = true;
		
	
	//udpate email	
	if($member_email !="" && $ret_validate=="")
	{
		
		$rowEmail = $auxUser->getWithNick($member_user);
		if($rowEmail->member_email!="")
		{
    		//error			
			$error = true;		
			$ret_validate .= "The Username is already in use";				
	    }
		
		//check available email
		$rowEmail = $auxUser->getWithEmail($member_email);
		
		if($rowEmail->member_email!="")
		{
    		//error			
			$error = true;		
			$ret_validate .= "The E-mail address is already in use";				
	    }
		
		
	
    }
	
	if($ret_validate=="")
	{
		
		$auxMember = new Member();
		$user_id = $auxMember->add_item($_POST);
		  		
		//activate account automatically			
		$auxMember->change_user_status($user_id, 1);
		
		$auxMember->update_role($member_role_id, $user_id);
		
		//generate password
		 $auxPersistent = new Persistent();
		
		$new_password = $auxMember->genRandomPassword();
		
		
		//update member with new password		
		$auxUser->reset_password($user_id, $new_password);
		
		$auxMember->member_pass = $new_password;
				
		
		$auxEmail = new EmailTemplate();
	
		//update message
		$rowMess = $auxEmail->getOne(6);
		$template = $rowMess->template_text;
		
		$message = $auxEmail->parse_confirmation_message_sucess_social($template, $auxMember, $d_link);
		
		include("../emailtemplates/email_skeleton.php");				
		$auxMessaging = new Messaging();			
		$auxMessaging->member_welcome($auxMember, $receipt);		
		
		$status = true;
	    $message = '<strong>Success!</strong> The user has been created.';
		
		$member_name = NULL;
		$member_email = NULL;
		$member_user = NULL;
		$member_pass = NULL;
		$member_role_id = NULL;
		
		
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
	                                        <a href="users.php">Users</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li class="active">Add New User</li>
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
                                    <div class="muted pull-left">Add New User</div>
                                </div>
                                <div class="block-content ">
                                
                                <div style="margin-top:10px; ">
										
										<p>Here you can add a new user.</p>
                                       </div>   
                                       
                                       <form class="form-horizontal" action='' method="POST" name="frm1" id="frm1">
                                       
                                       <input type="hidden" name="act" id="act">
  <fieldset>
    <div id="legend">
      <legend class="">User Data:</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Full Name:</label>
      <div class="controls">
        <input type="text" id="member_name" name="member_name" placeholder="" class="input-xlarge" value="<?php echo $member_name?>">
        
      </div>
    </div>
    
     <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Username:</label>
      <div class="controls">
        <input type="text" id="member_user" name="member_user" placeholder="" class="input-xlarge"  value="<?php echo $member_user?>">
        
      </div>
    </div>
    
    
     <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">E-mail:</label>
      <div class="controls">
        <input type="text" id="member_email" name="member_email" placeholder="" class="input-xlarge" value="<?php echo $member_email?>">
        
        
        
      </div>
    </div>
    
     <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Role:</label>
      <div class="controls">
        <select name="member_role_id" size="1" id="member_role_id">
        
        <?php
			$i=1;
			$auxRole = new MemberRole();
			$drC = $auxRole->getAllInternal();

              while($rowItem = $drC->fetch(PDO::FETCH_OBJ))
              {
				  
				  $sel = "";				  
				  if($rowItem->role_id==$member_role_id) $sel = "selected";
                            
               ?>    
        
                 <option value="<?php echo $rowItem->role_id?>" <?php echo $sel?> ><?php echo $rowItem->role_name?></option>
          
          
          <?php }?>
          </select>
      </div>
    </div>
    
      <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Status:</label>
      <div class="controls">
      
       <select name="member_status" size="1" id="member_status">
        
      
        
                 <option value="1" selected  >Active</option>
                 <option value="0"  >Pending</option>
          
          
         
          </select>
      
     
      </div>
    </div>
    
    <div class="control-group">
    
     <div class="controls">
        <button class="btn btn-success" id="save-changes-add" type="button">Submit</button>
      </div>
      
      
         </div>
 
    <div class="control-group">
      <!-- Button --></div>
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