<?php
include("../xoo-ini.php");
require_once("security.php");

$auxCommon = new Common();
$auxMember = new Member();

if($_POST["act"] == 'send_message') 
{
	$error = false;
	$message = '<strong>Error!</strong> Please fix the following errors.';
	
	
	foreach($_POST as $field_name => $val)
	{ 
		$assign = "\$".$field_name."='".$val."';"; 
		eval($assign); 
	}
		
	$required_fields = array(mess_subject => "Please input subject.", mess_text => "Please input text.", member_role_id => "Please select role." );
	
	
	//validate empy inputs	
	$ret_validate = $auxCommon->validate($required_fields);
	
	if($ret_validate!="") $error = true;	
	
	if($ret_validate=="")	
	{
		
		//send messsage	
		$auxMember->sendBulk($member_role_id, $mess_subject, $mess_text) ;	
		
		$status = true;
		$message = '<strong>Success!</strong> The message has been sent!.';

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
	                                   
	                                    <li class="active">Send Messages in Bulk</li>
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
                                    <div class="muted pull-left">Send Message in Bulk</div>
                                </div>
                                <div class="block-content ">
                                
                                <div style="margin-top:10px; ">
										
										<p>Here you can send messages to your users.</p>
                                       </div>   
                                       
                                       <form class="form-horizontal" action='' method="POST" name="frm1" id="frm1">
                                       
                                       <input type="hidden" name="act" id="act" value="send_message">
  <fieldset>
    <div id="legend">
      <legend class="">Message:</legend>
    </div>
    
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Subject:</label>
      <div class="controls">
        <input type="text" id="mess_subject" name="mess_subject" placeholder="input subject" class="input-xlarge" value="">
        
      </div>
    </div>
    
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail Body</label>
      <div class="controls">
        <textarea name="mess_text"  id="mess_text" class="input-text-xlarge input-xxlarge" placeholder="write message here ..."></textarea>
       
      </div>
    </div>
    
    
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Role:</label>
      <div class="controls">
        <select name="member_role_id" size="1" id="member_role_id">
        
        <option value=""  selected >--- Select a Role ----</option>
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
    
     <div class="controls">
     	<button class="btn" id="back-message" type="button">Cancel</button>
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