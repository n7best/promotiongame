<?php
include("../xoo-ini.php");
require_once("security.php");

$auxSetting = new Setting();

foreach($_POST as $field_name => $val)
	{ 
		$assign = "\$".$field_name."='".$val."';"; 
		eval($assign); 
	}

if($_POST["act"] == 'update') 
{
		
	
	
	if($_POST["c"] == '1') //facebook 
	{
		$auxSetting->update_setting("social",  "facebook_id", $_POST["facebook_id"]);
		$auxSetting->update_setting("social",  "facebook_secret", $_POST["facebook_secret"]);
		$auxSetting->update_setting("social",  "facebook_enable", $_POST["facebook_enable"]);
	
	}
	
	if($_POST["c"] == '2') //yahoo 
	{
		$auxSetting->update_setting("social",  "yahoo_enable", $_POST["yahoo_enable"]);
	
	}
	
	if($_POST["c"] == '3') //google 
	{
		$auxSetting->update_setting("social",  "google_enable", $_POST["google_enable"]);
	
	}
	
	if($_POST["c"] == '4') //linked 
	{
		$auxSetting->update_setting("social",  "linkedin_api_public", $_POST["linkedin_api_public"]);
		$auxSetting->update_setting("social",  "linkedin_api_private", $_POST["linkedin_api_private"]);
		$auxSetting->update_setting("social",  "linkedin_enable", $_POST["linkedin_enable"]);
	
	}
	
	$status = true;
	$message = '<strong>Success!</strong> The settings have been updated.';

	
	

}

if($_POST["act"] == 'update_security') 
{
		
	
	
	if($_POST["c"] == '1') // 
	{
		$auxSetting->update_setting("security",  "password_1_letter_1_number", $_POST["password_1_letter_1_number"]);
		$auxSetting->update_setting("security",  "password_one_uppercase", $_POST["password_one_uppercase"]);
		$auxSetting->update_setting("security",  "password_one_lowercase", $_POST["password_one_lowercase"]);
		$auxSetting->update_setting("security",  "password_lenght", $_POST["password_lenght"]);
	
	}
	
	if($_POST["c"] == '2') // 
	{
		$auxSetting->update_setting("acc_activation",  "activation_type", $_POST["activation_type"]);
		
	}
	
	if($_POST["c"] == '3') // 
	{
		
		$auxSetting->update_setting("recaptcha",  "public_key", $_POST["public_key"]);
		$auxSetting->update_setting("recaptcha",  "private_key", $_POST["private_key"]);
		$auxSetting->update_setting("recaptcha",  "active_c", $_POST["active_c"]);
	
	}
	
		
	$status = true;
	$message = '<strong>Success!</strong> The settings have been updated.';

	
	

}

if($_POST["act"] == 'update_web_settings') 
{
		
	
	
	if($_POST["c"] == '1') // 
	{
		$auxSetting->update_setting("website",  "name", $_POST["web_name"]);
		$auxSetting->update_setting("website",  "url", $_POST["url"]);
		$auxSetting->update_setting("website",  "main_email", $_POST["main_email"]);
		$auxSetting->update_setting("website",  "items_per_page", $_POST["items_per_page"]);
		$auxSetting->update_setting("website",  "default_role", $_POST["default_role"]);		
		$auxSetting->update_setting("website",  "avatar_width", $_POST["avatar_width"]);
		$auxSetting->update_setting("website",  "avatar_height", $_POST["avatar_height"]);	
	
	}	
		
	$status = true;
	$message = '<strong>Success!</strong> The settings have been updated.';
}
	
	

if($_POST["act"] == 'update_emailing_settings') 
{
		
	
	
	if($_POST["c"] == '1') // 
	{
		$auxSetting->update_setting("mailer_smtp",  "active_c", $_POST["active_c"]);
		$auxSetting->update_setting("mailer_smtp",  "host_name", $_POST["host_name"]);
		$auxSetting->update_setting("mailer_smtp",  "username", $_POST["username"]);
		$auxSetting->update_setting("mailer_smtp",  "pass_d", $_POST["pass_d"]);
		
		$auxSetting->update_setting("mailer_smtp",  "port", $_POST["port"]);
		$auxSetting->update_setting("mailer_smtp",  "requires_ssl", $_POST["requires_ssl"]);	
		
	
	}
	
	
		
	$status = true;
	$message = '<strong>Success!</strong> The settings have been updated.';
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
	                                   
	                                    <li class="active">Settings</li>
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
                                    <div class="muted pull-left">System Settings</div>
                                </div>
                                <div class="block-content ">
                                
  
<div id="tab" class="btn-group" data-toggle="buttons-radio">
  <a href="#settings" class="btn active" data-toggle="tab">Settings</a>
  <a href="#socialmedia" class="btn" data-toggle="tab">Social Media Registration</a>
  <a href="#security" class="btn" data-toggle="tab">Security</a>

</div>
 
<div class="tab-content">
  <div class="tab-pane active" id="settings">
  
   <form class="form-horizontal" action='' method="POST">
                                       
                                        <input type="hidden" name="act" value="update_web_settings">
                                        <input type="hidden" name="c" value="1">
  <fieldset>
    <div id="legend">
      <legend class="">Website Data:</legend>
    </div>
   
    
     <div class="control-group">
    
      <label class="control-label" for="email"> Website Name:</label>
      <div class="controls"> <input type="text" id="web_name" name="web_name" placeholder="" class="input-xlarge" value="<?php echo $auxSetting->getSetting("website",  "name");?>">
       
      </div>
    </div>
    
    
     <div class="control-group">
    
      <label class="control-label" for="email"> Website Url:</label>
      <div class="controls"> <input type="text" id="url" name="url" placeholder="" class="input-xlarge" value="<?php echo $auxSetting->getSetting("website",  "url");?>">
       
      </div>
    </div>
    
     <div class="control-group">
    
      <label class="control-label" for="email"> Website Email:</label>
      <div class="controls"> <input type="text" id="main_email" name="main_email" placeholder="" class="input-xlarge" value="<?php echo $auxSetting->getSetting("website",  "main_email");?>">
       
      </div>
    </div>
    
    <div class="control-group">
    <?php $selected_role= $auxSetting->getSetting("website",  "default_role");?>
      <label class="control-label" for="email">Default Role:</label>
      <div class="controls">
        <label for="select"></label>
        <select name="default_role" id="default_role">
        
        
          
         
        <?php
			$i=1;
			$auxRole = new MemberRole();
			$drC = $auxRole->getAllInternal();

              while($rowItem =  $drC->fetch(PDO::FETCH_OBJ))
              {			  
				  $sel = "";				  
				  if($rowItem->role_id==$selected_role) $sel = "selected";
                            
               ?>    
        
                 <option value="<?php echo $rowItem->role_id?>" <?php echo $sel?> ><?php echo $rowItem->role_name?></option>
                 
          
          
          <?php }?>
          
        </select>
      
       
      </div>
    </div>
    
    <div class="control-group">
    
      <label class="control-label" for="email"> Items per page:</label>
      <div class="controls"> <input type="text" id="items_per_page" name="items_per_page" placeholder="" class="input-mini" value="<?php echo $auxSetting->getSetting("website",  "items_per_page");?>">
       
      </div>
    </div>
    
     <div class="control-group">
    
      <label class="control-label" for="email"> Avatars  Width/Height:</label>
      <div class="controls"> <input type="text" id="avatar_width" name="avatar_width" placeholder="" class="input-mini" value="<?php echo $auxSetting->getSetting("website",  "avatar_width");?>">
       
      /
        <input type="text" id="avatar_height" name="avatar_height" placeholder="" class="input-mini" value="<?php echo $auxSetting->getSetting("website",  "avatar_height");?>">
      </div>
    </div>
    
        
    
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success">Submit</button>
      </div>
  </div>
  </fieldset>
</form>


   <form class="form-horizontal" action='' method="POST">
                                       
                                        <input type="hidden" name="act" value="update_emailing_settings">
                                        <input type="hidden" name="c" value="1">
  <fieldset>
    <div id="legend">
      <legend class="">SMTP Mailer Settings:</legend>
    </div>
    
    <div class="control-group">
    <?php $visibility= $auxSetting->getSetting("mailer_smtp",  "active_c");?>
      <label class="control-label" for="email">Enable SMTP Mailer:</label>
      <div class="controls"> <input name="active_c" id="active_c" type="checkbox" value="1"  <?php if($visibility == "1" ){echo 'checked';}?>>
       
      </div>
    </div>
   
    
     <div class="control-group">
    
      <label class="control-label" for="email">SMTP Hostname:</label>
      <div class="controls"> <input type="text" id="host_name" name="host_name" placeholder="" class="input-xlarge" value="<?php echo $auxSetting->getSetting("mailer_smtp",  "host_name");?>">
       
      </div>
    </div>
    
    
     <div class="control-group">
    
      <label class="control-label" for="email">SMTP Username:</label>
      <div class="controls"> <input type="text" id="username" name="username" placeholder="" class="input-xlarge" value="<?php echo $auxSetting->getSetting("mailer_smtp",  "username");?>">
       
      </div>
    </div>
    
    
    
     <div class="control-group">
    
      <label class="control-label" for="email">SMTP Password:</label>
      <div class="controls"> <input type="text" id="pass_d" name="pass_d" placeholder="" class="input-xlarge" value="<?php echo $auxSetting->getSetting("mailer_smtp",  "pass_d");?>">
       
      </div>
    </div>
    
           
    
     <div class="control-group">
    
      <label class="control-label" for="email">SMTP Port:</label>
      <div class="controls"> <input type="text" id="port" name="port" placeholder="" class="input-xlarge" value="<?php echo $auxSetting->getSetting("mailer_smtp",  "port");?>">
       
      </div>
    </div>
    
    
     <div class="control-group">
    <?php $visibility= $auxSetting->getSetting("mailer_smtp",  "requires_ssl");?>
      <label class="control-label" for="email">Encryption system:</label>
      <div class="controls">
        <label for="select"></label>
        <select name="requires_ssl" id="requires_ssl">
          <option value="">--- Select Encryption Type ---</option>
          <option value="ssl" <?php if($visibility == "ssl" ){echo 'selected';}?> >SSL</option>
          <option value="tls"  <?php if($visibility == "tls" ){echo 'selected';}?> >TLS</option>
        </select>
      
       
      </div>
    </div>
    
    
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success">Submit</button>
      </div>
  </div>
  </fieldset>
</form>
  
  </div>
  
  <div class="tab-pane" id="socialmedia">
  
  	<form class="form-horizontal" action='' method="POST">
                                       
                                        <input type="hidden" name="act" value="update">
                                        <input type="hidden" name="c" value="1">
  <fieldset>
    <div id="legend">
      <legend class=""><img src="bootstrap/img/f2.png" alt="">Facebook Signup</legend>
    </div>
    
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">App ID:</label>
      <div class="controls">
        <input type="text" id="facebook_id" name="facebook_id" placeholder="" class="input-xlarge" value="<?php echo $auxSetting->getSetting("social",  "facebook_id");?>">
       
      </div>
    </div>
    
     <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">App Secret:</label>
      <div class="controls">
         <input type="text" id="facebook_secret" name="facebook_secret" placeholder="" class="input-xlarge" value="<?php echo $auxSetting->getSetting("social",  "facebook_secret");?>">
       
      </div>
    </div>
 
    <div class="control-group">
     <?php $visibility= $auxSetting->getSetting("social",  "facebook_enable");?>
      <label class="control-label" for="email">Enable</label>
      <div class="controls">
      
      <input name="facebook_enable" type="checkbox" id="facebook_enable" value="1"   <?php if($visibility == "1" ){echo 'checked';}?>>
       
       
      </div>
    </div>
    
    
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success">Submit</button>
      </div>
  </div>
  </fieldset>
</form>

<form class="form-horizontal" action='' method="POST">
                                       
                                        <input type="hidden" name="act" value="update">
                                        <input type="hidden" name="c" value="2">
  <fieldset>
    <div id="legend">
      <legend class=""><img src="bootstrap/img/y2.png" alt="">Yahoo Signup</legend>
    </div>
    
   
   
    <div class="control-group">
     <?php $visibility= $auxSetting->getSetting("social",  "yahoo_enable");?>
      <label class="control-label" for="email">Enable</label>
      <div class="controls">
      
      <input name="yahoo_enable" type="checkbox" id="yahoo_enable" value="1"   <?php if($visibility == "1" ){echo 'checked';}?>>
       
       
      </div>
    </div>
    
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success">Submit</button>
      </div>
  </div>
  </fieldset>
</form>

<form class="form-horizontal" action='' method="POST">
                                       
                                        <input type="hidden" name="act" value="update">
                                        <input type="hidden" name="c" value="3">
  <fieldset>
    <div id="legend">
      <legend class=""><img src="bootstrap/img/g2.png" alt="">Google Signup</legend>
    </div>
    
   
   
    <div class="control-group">
     <?php $visibility= $auxSetting->getSetting("social",  "google_enable");?>
      <label class="control-label" for="email">Enable</label>
      <div class="controls">
      
      <input name="google_enable" type="checkbox" id="google_enable" value="1"   <?php if($visibility == "1" ){echo 'checked';}?>>
       
       
      </div>
    </div>
    
    
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success">Submit</button>
      </div>
  </div>
  </fieldset>
</form>

<form class="form-horizontal" action='' method="POST">
                                       
                                        <input type="hidden" name="act" value="update">
                                        <input type="hidden" name="c" value="4">
  <fieldset>
    <div id="legend">
      <legend class=""><img src="bootstrap/img/in2.png" alt="">LinkedIn Signup</legend>
    </div>
    
    
     <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">API Key Public:</label>
      <div class="controls">
      <input type="text" id="linkedin_api_public" name="linkedin_api_public" placeholder="" class="input-xlarge" value="<?php echo $auxSetting->getSetting("social",  "linkedin_api_public");?>">
       
      </div>
    </div>
    
     <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">API Key Private:</label>
      <div class="controls">
        <input type="text" id="linkedin_api_private" name="linkedin_api_private" placeholder="" class="input-xlarge" value="<?php echo $auxSetting->getSetting("social",  "linkedin_api_private");?>">
      </div>
    </div>
    
    <div class="control-group">
     <?php $visibility= $auxSetting->getSetting("social",  "linkedin_enable");?>
      <label class="control-label" for="email">Enable</label>
      <div class="controls">
      
      <input name="linkedin_enable" type="checkbox" id="linkedin_enable" value="1"   <?php if($visibility == "1" ){echo 'checked';}?>>
       
       
      </div>
    </div>
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success">Submit</button>
      </div>
  </div>
  </fieldset>
</form>
  
  
  </div>
  <div class="tab-pane " id="security">
  
  <form class="form-horizontal" action='' method="POST">
                                       
                                        <input type="hidden" name="act" value="update_security">
                                        <input type="hidden" name="c" value="1">
  <fieldset>
    <div id="legend">
      <legend class="">Password Strenght</legend>
    </div>
   
    
     <div class="control-group">
     <?php $active= $auxSetting->getSetting("security",  "password_1_letter_1_number");?>
      <label class="control-label" for="email">  <input name="password_1_letter_1_number" type="checkbox" id="password_1_letter_1_number" value="1"   <?php if($active == "1" ){echo 'checked';}?>></label>
      <div class="controls"><p>The Password must contain at least one letter and one number</p>
       
      </div>
    </div>
    
    
     <div class="control-group">
     <?php $visibility= $auxSetting->getSetting("security",  "password_one_uppercase");?>
      <label class="control-label" for="email"><input name="password_one_uppercase" type="checkbox" id="password_one_uppercase" value="1"   <?php if($visibility == "1" ){echo 'checked';}?>></label>
      <div class="controls"><p>The Password must contain at least one upper case character</p>
       
       
      </div>
    </div>
    
     <div class="control-group">
     <?php $visibility= $auxSetting->getSetting("security",  "password_one_lowercase");?>
      <label class="control-label" for="email">  <input name="password_one_lowercase" type="checkbox" id="password_one_lowercase" value="1"   <?php if($visibility == "1" ){echo 'checked';}?>></label>
      <div class="controls"><p>The Password must contain at least one lower case character</p>
      </div>
    </div>
    
    
     <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Must contain at least :</label>
      <div class="controls">
      <input type="text" id="password_lenght" name="password_lenght" placeholder="" class="input-mini" value="<?php echo $auxSetting->getSetting("security",  "password_lenght");?>"> characters
       
      </div>
    </div>
    
    
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success">Submit</button>
      </div>
  </div>
  </fieldset>
</form>

  <form class="form-horizontal" action='' method="POST">
                                       
                                        <input type="hidden" name="act" value="update_security">
                                        <input type="hidden" name="c" value="2">
  <fieldset>
    <div id="legend">
      <legend class="">Account Activation Method</legend>
    </div>
   
    
     <div class="control-group">
     <?php $active= $auxSetting->getSetting("acc_activation",  "activation_type");?>
      <label class="control-label" >
              <input type="radio" name="activation_type" id="RadioGroup1_1"  value="1"   <?php if($active == "1" || $active == ""  ){echo 'checked';}?>>
         
        </label>
      <div class="controls"><p>Email with activation link</p> </div>
    </div>
    
     <div class="control-group">
    
      <label class="control-label" >
              <input type="radio" name="activation_type" id="RadioGroup1_1"  value="2"   <?php if($active == "2" ){echo 'checked';}?>>
         
        </label>
      <div class="controls"><p>Email with random Number</p> </div>
    </div>
    
    
     <div class="control-group">
    
      <label class="control-label" >
              <input type="radio" name="activation_type" id="RadioGroup1_1"  value="3"   <?php if($active == "3" ){echo 'checked';}?>>
         
        </label>
      <div class="controls"><p>Automatic activation</p> </div>
    </div>
    
    
    <div class="control-group">
     
      <label class="control-label" >
              <input type="radio" name="activation_type" id="RadioGroup1_1"  value="4"   <?php if($active == "4" ){echo 'checked';}?>>
         
        </label>
      <div class="controls"><p>Manual activation</p> </div>
    </div>
  
    
    
      
    
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success">Submit</button>
      </div>
  </div>
  </fieldset>
</form>

 <form class="form-horizontal" action='' method="POST">
                                       
                                        <input type="hidden" name="act" value="update_security">
                                        <input type="hidden" name="c" value="3">
  <fieldset>
    <div id="legend">
      <legend class="">reCAPTCHA Settings</legend>
    </div>
   
    
     <div class="control-group">
     <?php $visibility= $auxSetting->getSetting("recaptcha",  "active_c");?>
      <label class="control-label" for="email">  <input name="active_c" type="checkbox" id="active_c" value="1"   <?php if($visibility == "1" ){echo 'checked';}?>></label>
      <div class="controls"><p>Activate reCAPTCHA</p>
      </div>
    </div>
    
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Public Key:</label>
      <div class="controls">
         <input type="text" id="public_key" name="public_key" placeholder="" class="input-xlarge" value="<?php echo $auxSetting->getSetting("recaptcha",  "public_key");?>">
       
      </div>
    </div>
    
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Private Key:</label>
      <div class="controls">
         <input type="text" id="private_key" name="private_key" placeholder="" class="input-xlarge" value="<?php echo $auxSetting->getSetting("recaptcha",  "private_key");?>">
       
      </div>
    </div>
    
    
        
     
    
    
      
    
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success">Submit</button>
      </div>
  </div>
  </fieldset>
</form>
  
  </div>
 
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