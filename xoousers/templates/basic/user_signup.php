<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo WEBSITE_NAME?> - <?php echo $lang['SIGNUP_TITLE']; ?></title>

<?php include("metainfo.php")?>

</head>

<body>



	 <?php include("top.php")?>

	<div id="wrap">
	<div class="container">
		<div class="row">
			<div class="span3 hidden-phone"></div>
			<div class="span6" id="form-login"> 
            
            <?php if($ret_validate!=""){?>           
            <p style="color: #F00"><?php echo $ret_validate?> </p>
            
            <?php }?>  
				<form class="form-horizontal well" method="post">
                <input type="hidden" name="act" value="sign_up_confirm">
					<fieldset>
						<legend><?php echo $lang['SIGNUP_TITLE']; ?>				  </legend>
                      
                      
                       <div class="control-group">
							<div class="control-label">
								<label> <?php echo $lang['SIGNUP_FULL_NAME']; ?>:</label>
							</div>
							<div class="controls">
								<input name="member_name" type="text" class="input-large" id="member_name" placeholder="type your name" value="<?php echo $member_name?>">
							</div>
                            
						</div>
                      
                      <div class="control-group">
							<div class="control-label">
								<label> <?php echo $lang['SIGNUP_USERNAME']; ?>:</label>
								
						</div>
							<div class="controls">
								<input name="member_user" type="text" class="input-large" id="member_user" placeholder="type your user user name" value="<?php echo $member_user?>">
							</div>
                            
						</div>


						<div class="control-group">
							<div class="control-label">
								<label> <?php echo $lang['SIGNUP_EMAIL']; ?>:</label>
							</div>
							<div class="controls">
								<input name="member_email" type="text" class="input-large" id="member_email" placeholder="type your email" value="<?php echo $member_email?>">
							</div>
                            
						</div>
                        
                        <div class="control-group">
							<div class="control-label">
								<label> <?php echo $lang['SIGNUP_EMAIL_AGAIN']; ?>:</label>
							</div>
							<div class="controls">
								<input name="member_email2" type="text" class="input-large" id="member_email2" placeholder="type your email again" value="<?php echo $member_email2?>">
							</div>
                            
						</div>
                        
						<div class="control-group">
                        
					    <div class="control-label">
								<label>  <?php echo $lang['SIGNUP_PASSWORD']; ?>:</label>
							</div>
							<div class="controls">
								<input name="member_pass" type="password" class="input-large" id="member_pass" placeholder="type your password" value="<?php echo $member_pass?>">

								<!-- Help-block example -->
								<!-- <span class="help-block">Example block-level help text here.</span> -->
							</div>
						</div>
                        
                        <div class="control-group">
                        
					    <div class="control-label">
								<label>  <?php echo $lang['SIGNUP_PASSWORD_AGAIN']; ?>:</label>
							</div>
							<div class="controls">
								<input name="member_pass2" type="password" class="input-large" id="member_pass2" placeholder="type your password again" value="<?php echo $member_pass2?>">

								<!-- Help-block example -->
								<!-- <span class="help-block">Example block-level help text here.</span> -->
							</div>
						</div>
                        
                        <?php if($active_captcha==1) {
							?>
                        
                        	<div class="control-group">
                        
                         <div class="control-label">
								<label> Captcha:</label>
							</div>
							<div class="controls">
								<?php echo  recaptcha_get_html($publickey);?>
							</div>
						</div>
                        
                        <?php }?>
						<div class="control-group"  >
                        
                        
							<div class="controls">
                            
                            <div class="control-label">
								<label> &nbsp;</label>
							</div>
							<button type="submit" id="submit" class="btn btn-primary button-loading" data-loading-text="<?php echo $lang['BUTTONS_WAIT_MESSAGE']?>"><?php echo $lang['SIGNUP_SUBMIT']; ?></button>
							</div>
                            
                          <div class="buttn">
                             <?php if($activate_facebook==1) {?>
                            
                              <ul>                         
<li class="face"><a href="<?php echo $loginUrl?>"><?php echo $lang['SIGNUP_SOCIAL_S_FACEBOOK']?></a></li>
                            <?php }?>
                            
                             <?php if($activate_google==1) {?>
<li class="goog"><a href="user_signup_googlresponse.php?auth=ini&identity=google"><?php ECHO $lang['SIGNUP_SOCIAL_S_GOOGLE'] ?></a></li>
                               <?php }?>
                               
                              <?php if($activate_yahoo==1) {?>
<li class="yah"><a href="user_signup_googlresponse.php?auth=ini&identity=yahoo"><?php echo $lang['SIGNUP_SOCIAL_S_YAHOO']?></a></li>
                               <?php }?>
                               
                            <?php if($activate_linked==1) {?>
<li class="lin"><a href="user_signup_linkedin.php"><?php echo $lang['SIGNUP_SOCIAL_S_LINKEDIN']?></a></li>

                              <?php }?>
                              
<li><a href="user_login.php"><?php echo $lang['SIGNUP_ALREADY_USER']; ?></a></li>

 </ul>
            
                          </div>   
                            
                           
						</div>
					</fieldset>
				</form>
    			

				
			</div>
			
		</div>
	</div>
	
	</div>

    <!-- Footer
    ================================================== -->
    <?php include("footer.php")?>
    
</body>
</html>