<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo WEBSITE_NAME?> - <?php echo $lang['LOGIN_TITLE']?></title>

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
            
            <p style="color: #F00"><?php echo $ret_validate?> </p>
				<form class="form-horizontal well" method="post">
                <input type="hidden" name="act" value="signin">
					<fieldset>
						<legend><?php echo $lang['LOGIN_TITLE']?></legend>
						<div class="control-group">
							<div class="control-label">
								<label><?php echo $lang['LOGIN_USER_NAME']?>:</label>
							</div>
							<div class="controls">
								<input name="member_user" type="text" class="input-large" id="member_user" placeholder="type your user name" value="<?php echo $member_user?>">
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<label><?php echo $lang['LOGIN_PASSWORD']?>:</label>
							</div>
							<div class="controls">
								<input name="member_pass" type="password" class="input-large" id="member_pass" placeholder="type your password" value="<?php echo $member_pass?>">

								<!-- Help-block example -->
								<!-- <span class="help-block">Example block-level help text here.</span> -->
							</div>
						</div>

						<div class="control-group">
                        <div class="control-label"> &nbsp;
								
							</div>
							<div class="controls">

							<button type="submit" id="submit" class="btn btn-primary button-loading" data-loading-text="Loading..."><?php echo $lang['LOGIN_SIGNIN_BUTTON']?></button>

							<button type="button" class="btn btn-secondary button-loading" id="button-forgot" data-loading-text="Loading..."><?php echo $lang['LOGIN_FORGOT_PASSWORD']?></button>

							</div>
                            
                                                        
                              <div class="buttn">
                             <?php if($activate_facebook==1) {?>
                            
                              <ul>                         
<li class="face"><a href="<?php echo $loginUrl?>"><?php echo $lang['LOGIN_SOCIAL_S_FACEBOOK']?></a></li>
                            <?php }?>
                            
                             <?php if($activate_google==1) {?>
<li class="goog"><a href="user_signup_googlresponse.php?auth=ini&identity=google"><?php echo $lang['LOGIN_SOCIAL_S_GOOGLE']?></a></li>
                               <?php }?>
                               
                              <?php if($activate_yahoo==1) {?>
<li class="yah"><a href="user_signup_googlresponse.php?auth=ini&identity=yahoo"><?php echo $lang['LOGIN_SOCIAL_S_YAHOO']?></a></li>
                               <?php }?>
                               
                            <?php if($activate_linked==1) {?>
<li class="lin"><a href="user_signup_linkedin.php"><?php echo $lang['LOGIN_SOCIAL_S_LINKEDIN']?></a></li>

                              <?php }?>
                              
<li><a href="user_signup.php"><?php echo $lang['LOGIN_CREATE_AN_ACCOUNT']?></a></li>
						

 </ul>
            
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