<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo WEBSITE_NAME?> - <?php echo $lang['ACC_CONFIRMATION_NUMERIC_TITLE']?></title>

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
                <input type="hidden" name="act" value="activate_ac">
                
                <?php if($valid) {?>
					<fieldset>
						<legend><?php echo $lang['ACC_CONFIRMATION_NUMERIC_TITLE']?>
					  </legend>
                      
                      <div class="control-group">
                      
                      <p><?php echo $lang['ACC_CONFIRMATION_NUMERIC_INPUT_HELLO']?> <?php echo $p_name?>. <?php echo $lang['ACC_CONFIRMATION_NUMERIC_INPUT_ACT_CODE']?></p>
							<div class="control-label">
								<label><?php echo $lang['ACC_CONFIRMATION_NUMERIC_INPUT_ACTIVATION_NUMBER']?>:</label></div>
							<div class="controls">
								<input name="activation_number" type="text" class="input-large" id="activation_number" placeholder="type activation code" >
							</div>
						</div>

						
						<div class="control-group">
							<div class="controls">

							<button type="submit" id="submit" class="btn btn-primary button-loading" data-loading-text="<?php echo $lang['BUTTONS_WAIT_MESSAGE']?>"><?php echo $lang['BUTTONS_SUBMIT']?></button>

							

							</div>
                            
                            <p>&nbsp;</p>
                               
      
						</div>
					</fieldset>
				</form>
    			
			<?php }else{?>
            
             <h1><?php echo $h1?></h1>
            
                <p><?php echo $mess?></p>
            
            
            <?php }?>
				
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