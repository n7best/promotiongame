<?php
include("../xoo-ini.php");
require_once("security.php");

//
$auxUser = new Member();

$auxCommon = new Common();

if($_GET["c"] != '') 
{
	$c = $_GET["c"];
	$rowMember = $auxUser->getOne($c);
	
	

}

if($_POST["act"] == 'update_info') 
{
	
	$error = false;
	$message = '<strong>Error!</strong> Please fix the following errors.';
	
	//validate email and username
	
	foreach($_POST as $field_name => $val)
	{ 
		$assign = "\$".$field_name."='".$val."';"; 
		eval($assign); 
	}
		
	$required_fields = array(member_name => "Please write your name.", member_user => "Please write your username." , member_email => "Please write your email." );
	
	
	//validate empy inputs	
	$ret_validate = $auxCommon->validate($required_fields);
	
	//validate if it's a valid email address	
	$ret_validate_email = $auxCommon->validate_valid_email($member_email);
	
	if(!$ret_validate_email)
	{
		$ret_validate .= "Please write a valid E-mail Address" ."<br>";
	}
	
	
	
	if($ret_validate!="") $error = true;
		
	
	//udpate email	
	if($member_email != $member_email2 && $member_email !="" && $ret_validate=="")
	{
		//check available email
		$rowEmail = $auxUser->getWithEmail($member_email);
		
		if($rowEmail->member_email=="")
		{
			//udpate		
			$auxUser->update_email($member_email, $c);		
		
		}else{
			
			//error			
			$error = true;		
			$ret_validate .= "The E-mail address is already in use";				
			
	    }
	
    }
	
	if($ret_validate=="")
	{
		//update user personal data
		
		$auxUser->edit_item($_POST,$c);		
		
		$status = true;
	    $message = '<strong>Success!</strong> The user information has been updated.';
		
		//reload user		
		$rowMember = $auxUser->getOne($c);
	}
	
	
	
	
	
	

}

if($_POST["act"] == 'reset_password') 
{
	
	//$c = $_POST["c"];
	$auxEmail = new EmailTemplate();
	$auxMess = new Messaging();		
	$auxPersistent = new Common();
	
	$new_password = $auxPersistent->genRandomPassword();
	
	//update member with new password
	
	$auxUser->reset_password($c, $new_password);
		
	
	$rowMess = $auxEmail->getOne(2);
	$template = $rowMess->template_text;		
	$message = $auxEmail->parse_reset_password_message($template, $rowMember, $new_password);
			
	include("../emailtemplates/email_skeleton.php");	
	$auxMess->member_reset_passoword($rowMember, $receipt);	
	
	//$auxTemplate->update_template($c, $n, $body);
	
	$status = true;
	$message = '<strong>Success!</strong> A new password has been sent to the user.';
	
	
	

}

if($_POST["act"] == 'ban_user') 
{
	
	$auxUser->ban_user($c);
	
	$status = true;
	$message = '<strong>Success!</strong> The user has been banned.';	
	//reload user		
	$rowMember = $auxUser->getOne($c);	

}

if($_POST["act"] == 'activate_user') 
{
	
	$auxUser->activate_user($c);	
	
	$auxEmail = new EmailTemplate();
	
	//update message
	$rowMess = $auxEmail->getOne(3);
	$template = $rowMess->template_text;
	
	$message = $auxEmail->parse_confirmation_message_sucess($template, $rowMember, $d_link);
	
	include("../emailtemplates/email_skeleton.php");	
	
	$auxMessaging = new Messaging();
	
	$auxMessaging->member_welcome($rowMember, $receipt);
	
	
	
	$status = true;
	$message = '<strong>Success!</strong> The user has been activated.';	
	//reload user		
	$rowMember = $auxUser->getOne($c);	

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
	                                    <li class="active">Edit User</li>
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
                                    <div class="muted pull-left">Edit User</div>
                                </div>
                                <div class="block-content ">
                                
                                <div style="margin-top:10px; ">
										
										<p>Here you can edit the user information.</p>
                                       </div>   
                                       
                                       <form class="form-horizontal" action='' method="POST" name="frm1" id="frm1">
                                       
                                       <input type="hidden" name="act" id="act">
  <fieldset>
    <div id="legend">
      <legend class="">New Password</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">First Name:</label>
      <div class="controls">
        <input type="text" id="member_name" name="member_name" placeholder="" class="input-xlarge" value="<?php echo $rowMember->member_name?>">
        
      </div>
    </div>
    
     <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Username:</label>
      <div class="controls">
        <input type="text" id="member_user" name="member_user" placeholder="" class="input-xlarge"  value="<?php echo $rowMember->member_user?>">
        
      </div>
    </div>
    
    
     <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">E-mail:</label>
      <div class="controls">
        <input type="text" id="member_email" name="member_email" placeholder="" class="input-xlarge" value="<?php echo $rowMember->member_email?>">
        
         <input type="hidden" id="member_email2" name="member_email2" placeholder="" class="input-xlarge" value="<?php echo $rowMember->member_email?>">
        
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

              while($rowItem =  $drC->fetch(PDO::FETCH_OBJ))
              {
				  
				  $sel = "";				  
				  if($rowItem->role_id==$rowMember->member_role_id) $sel = "selected";
                            
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
      
      <p>
      
      <?php
	  
	  if($rowMember->member_status==0)	  
	  {        
		 
		 echo '<span class="label label-warning">Pending </span>';
		 
	   }elseif($rowMember->member_status==1){
		   
		 echo '<span class="label label-success">Active</span>';
	   
	   }elseif($rowMember->member_status==2){
		   
		 echo '<span class="label label-important">Banned</span>';
	   
	   }
	  
	  ?>
      
      </p>
        
      </div>
    </div>
    
    <div class="control-group">
    
     <div class="controls">
        <button class="btn btn-success" id="save-changes" type="button">Save Changes</button>
      </div>
      
      
         </div>
 
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
       <p>Additional Actions.</p>
										<p>
											
											<button class="btn btn-inverse" id="reset-pass" type="button"><i class="icon-refresh icon-white"></i> Reset Password</button>
                                            
                                           <?php if($rowMember->member_status==2 || $rowMember->member_status==0)	{  ?> 
											<button class="btn btn-primary" id="activate-user" type="button"><i class="icon-pencil icon-white"></i> Activate User</button>
                                            
                                             <?php }?>
                                            
                                             <?php if($rowMember->member_status==0 || $rowMember->member_status==1)	{  ?>
											<button class="btn btn-danger" id="ban-user" type="button"><i class="icon-remove icon-white"></i> Ban User</button>
                                            
                                            <?php }?>
                                            
                                             <a class="modalbox btn" href="#inline" ><i class="icon-comment"></i> <i class="icon-plus"></i> <strong>Send Message</strong></a>
										</p>
      </div>
      
      <div style="text-align:left">
      
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
       <!-- hidden inline form -->
<div id="inline">
	<h2>Send New  Message</h2>

	<form id="contact" name="contact" action="#" method="post">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $c?>" />
    <label for="email">Subject:</label>
		<input type="input" id="message_subject" name="message_subject" class="txt">
		<br>
		<label for="msg">Enter a Message:</label>
		<textarea id="message_text" name="message_text" class="txtarea"></textarea>
		
		<button id="send_comment" class="btn btn-success">Send Message</button>
	</form>
</div>
       
    </body>

</html>