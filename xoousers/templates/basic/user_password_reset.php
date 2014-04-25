<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo WEBSITE_NAME?> - <?php echo $lang['PASSWORD_RESET_TITLE']?></title>

<?php include("metainfo.php")?>

</head>

<body>


<!-- Navbar
    ================================================== -->

<?php include("top.php")?>

	<div id="wrap">
	<div class="container">
		<div class="row">
			<div class="span3 hidden-phone"></div>
			<div class="span6" id="form-login">
              <?php if(!$OK){ ?>
            <p style="color: #F00"><?php echo $ret_validate?> </p>
             <?php }?>
             
             <?php if($OK){ ?>
             <p style="color: #090"><?php echo $ret_validate?> </p>
             <?php }?>
            
				<form class="form-horizontal well" method="post">
                <input type="hidden" name="act" value="password_reset">
					<fieldset>
						<legend><?php echo $lang['PASSWORD_RESET_TITLE']?></legend>
						<div class="control-group">
							<div class="control-label">
								<label><?php echo $lang['PASSWORD_RESET_EMAIL']?>:</label>
							</div>
							<div class="controls">
								<input name="member_email" type="text" class="input-large" id="member_email" placeholder="type your user name" value="">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
                            
                             <div class="control-label"> &nbsp;
								
							</div>

							<button type="submit" id="submit" class="btn btn-primary button-loading" data-loading-text="<?php echo $lang['BUTTONS_WAIT_MESSAGE']?>"><?php echo $lang['PASSWORD_RESET_SEND_BUTTON']?></button>

							</div>
                            
                            <p>&nbsp;</p>
                               
         <p style="text-align:center"><a href="user_login.php"><?php echo $lang['PASSWORD_RESET_ALREADY_MEMBER']?></a></p>
						</div>
					</fieldset>
				</form>
    			

				
			</div>
			<div class="span3 hidden-phone"></div>
		</div>
	</div>
	<div id="push"></div>
	</div>

    <!-- Footer
    ================================================== -->
   <?php include("footer.php")?>
    
</body>
</html>