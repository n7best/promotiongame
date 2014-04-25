<?php
include("../xoo-ini.php");

$auxSetup = new XooScriptsSetup();
$auxSetting = new Setting();
$auxPer = new Persistent();

$url = $auxSetup->curPageURL();
$url = str_replace("setup/", "",  $url);

//check db conection
$auxSetup->checkConection();

//check if already installed
$auxSetup->checkAlreadyInstalled();



if($_POST["act"] == "create_website")
{	
	
	//create DB structure
	$auxSetup->createDBStructure();
	
	//create admin user	
	$auxSetup->createAdminUser($_POST);	
	
	//basic settings	
	$auxSetup->createSettings();
	
	//website name
	$auxSetting->update_setting("website", "name", $_POST["websitename"]);	
	
	//main email
	$auxSetting->update_setting("website", "main_email", $_POST["email"]);
	
	//website URL
	$auxSetting->update_setting("website", "url", $url );
	
	
	//create one role
	
	$sql = "INSERT INTO xoousers_roles (role_name) VALUES('Basic Role')";
	$auxPer->setSql($sql);
	$auxPer->setCon();
	$auxPer->save();
	
	
	//website root folder
	
	$mess ="All done!. Your website has been successfully created and is ready for use.";
	$SETUP= true;

	
	

}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title><?php echo PRODUCT_NAME?> | Setup Wizard</title>
    
    <!-- // Meta //  -->
    <meta charset="utf-8">   

    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
    <![endif]-->
    
    <!-- // Stylesheets // -->
    <link rel="stylesheet" href="style.css" />
   
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="shortcut icon" href="images/favicon.ico">
        
    <script src="../admin/js/modernizr-1.7.min.js"></script>
    
     <!-- Grab Google CDN's jQuery. fall back to local if necessary -->
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="js/jquery-ui-1.8.6.min.js"></script>
    
    <script src="js/js_auto.js"></script>

</head>
<body>
    <div id="container">
        <form method="post" name="frm1" id="frm1"> 
        <input type="hidden" name="act" id="act">
        
        
        
        <div id="wizard-box" class="corners shadow">
        
         <div class="wizard-box-header corners">
              <img src="logo_wizard.png" width="377" height="58" /></div>
              
               <?php if(!$OK && $_POST["act"] == 'sign_up')	{?>
                
                <div class="wizard-box-error-small corners">
                    <p><?php echo $mess?></p>
                </div>
                <?php }?>
            
              <div class="wizard-box-header corners">
                    <h2>Website Details:</h2>
              </div>
              
                <?php if($SETUP && $_POST["act"] == 'create_website')	{?>
                
                 <div class="login-box-succes-small corners">
                    <p><?php echo $mess?></p>
                </div>
                
                
                <p><strong>Please keep this information:</strong></p>
                
                <p>Your Username: <?php echo $_POST["nick"]?></p>
                 <p>Your Password:  <?php echo $_POST["pass1"]?></p>
                
                                 <p>&nbsp;</p>
                  <p>Administrator Panel <a href="../admin/">Click here</a></p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>

                
                 <?php }else{?>
                
                 <div class="wizard-box-row-wrap corners">
                  <label for="username">Website Name: <img src="questionicon.png" width="16" height="16" align="absmiddle" /></label>
                  <input type="text" id="websitename" value="" name="websitename" class="input-1"/>
              </div>
                
<div class="wizard-box-header corners">
                    <h2>Admin Login Details</h2>
                </div>
                
               
                <div class="wizard-box-row-wrap corners">
                  <label for="username">Username: <img src="questionicon.png" width="16" height="16" align="absmiddle" /></label>
                  <input type="text" id="username" value="admin" name="nick" class="input-1"/>
                </div>
                
                <div class="wizard-box-row-wrap corners">
                  <label for="username">Email: <img src="questionicon.png" width="16" height="16" align="absmiddle" /></label>
                  <input type="text" id="email" value="" name="email" class="input-1"/>
</div>
                <div class="wizard-box-row-wrap corners">
                    <div>
                        <label for="password">Password: <img src="questionicon.png" width="16" height="16" align="absmiddle" /></label>
                        <input type="password" id="pass1" value="" name="pass1" class="input-1 password"/>
                    </div>    
                   
                </div>
                
                 <div class="wizard-box-row corners">
                  <p>All the fields are mandatory</p>
                </div>
                <div class="wizard-box-row corners">
                  <input type="button" value="Yes, I want to Install <? echo PRODUCT_NAME?> Now!" id="btns" onClick="javascript:validate_wizard()"/>
                </div>
                
               <?php }?>   
            <div class="wizard-box-row corners">
                  <p>Copyright © <?php echo date("Y")?> <a href="http://www.xooscripts.com" target="_blank">www.xooscripts.com</a> All rights reserved.</p>
          </div>
                
            </div>
           
        </form>
    </div><!-- END "#container" -->
    
    
        
   

        
</body>
</html>