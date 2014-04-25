<?php
include("../xoo-ini.php");
require_once("security.php");

//
$auxTemplate = new EmailTemplate();
$status = false;
if($_POST["act"] == 'update') 
{
	
	$c = $_POST["c"];
	$n= $_POST["template_name"];
	$body = $_POST["template_text"];
	$auxTemplate->update_template($c, $n, $body);
	
	$status = true;
	$message = '<strong>Success!</strong> The information has been updated.';
	
	
	

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
	                                    
	                                    <li class="active">Email Templates</li>
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
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Manage Email Templates</div>
                                </div>
                                <div class="block-content ">
                                
                                <div style="margin-top:10px; ">
										
										<p>Here you can manage the Email Templates</p>
                                       </div>   
                                       
<?php
$rowMess = $auxTemplate->getOne(2);

?>                                       <form class="form-horizontal" action='' method="POST">
                                       
                                        <input type="hidden" name="act" value="update">
                                        <input type="hidden" name="c" value="2">
  <fieldset>
    <div id="legend">
      <legend class="">New Password:</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">E-mail Subject:</label>
      <div class="controls">
        <input type="text" id="template_name" name="template_name" placeholder="" class="input-xlarge" value="<?php echo $rowMess->template_name?>">
       
      </div>
    </div>
 
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail Body</label>
      <div class="controls">
        <textarea name="template_text"  id="template_text" placeholder="" class="input-text-xlarge input-xxlarge"><?php echo $rowMess->template_text?></textarea>
       
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

<?php
$rowMess = $auxTemplate->getOne(1);

?>

                                       <form class="form-horizontal" action='' method="POST">
                                       
                                        <input type="hidden" name="act" value="update">
                                        <input type="hidden" name="c" value="1">
  <fieldset>
    <div id="legend">
      <legend class="">Account Confirmation (Link)</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">E-mail Subject:</label>
      <div class="controls">
        <input type="text" id="template_name" name="template_name" placeholder="" class="input-xlarge" value="<?php echo $rowMess->template_name?>">
       
      </div>
    </div>
 
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail Body</label>
      <div class="controls">
        <textarea name="template_text"  id="template_text" placeholder="" class="input-text-xlarge input-xxlarge"><?php echo $rowMess->template_text?></textarea>
       
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

<?php
$rowMess = $auxTemplate->getOne(4);

?>

                                       <form class="form-horizontal" action='' method="POST">
                                       
                                       <input type="hidden" name="act" value="update">
                                        <input type="hidden" name="c" value="4">
  <fieldset>
    <div id="legend">
      <legend class="">Account Confirmation (Numeric)</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">E-mail Subject:</label>
      <div class="controls">
        <input type="text" id="template_name" name="template_name" placeholder="" class="input-xlarge" value="<?php echo $rowMess->template_name?>">
       
      </div>
    </div>
 
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail Body</label>
      <div class="controls">
        <textarea name="template_text"  id="template_text" placeholder="" class="input-text-xlarge input-xxlarge"><?php echo $rowMess->template_text?></textarea>
        
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

<?php
$rowMess = $auxTemplate->getOne(5);

?>

                                       <form class="form-horizontal" action='' method="POST">
                                       <input type="hidden" name="act" value="update">
                                        <input type="hidden" name="c" value="5">
  <fieldset>
    <div id="legend">
      <legend class="">Account Confirmation (Manual)</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">E-mail Subject:</label>
      <div class="controls">
        <input type="text" id="template_name" name="template_name" placeholder="" class="input-xlarge" value="<?php echo $rowMess->template_name?>">
        
      </div>
    </div>
 
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail Body</label>
      <div class="controls">
        <textarea name="template_text"  id="template_text" placeholder="" class="input-text-xlarge input-xxlarge"><?php echo $rowMess->template_text?></textarea>
        
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

<?php
$rowMess = $auxTemplate->getOne(3);

?>

                                       <form class="form-horizontal" action='' method="POST">
                                        <input type="hidden" name="act" value="update">
                                        <input type="hidden" name="c" value="3">
  <fieldset>
    <div id="legend">
      <legend class="">Account Confirmation Sucess</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">E-mail Subject:</label>
      <div class="controls">
        <input type="text" id="template_name" name="template_name" placeholder="" class="input-xlarge" value="<?php echo $rowMess->template_name?>">
        
      </div>
    </div>
 
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail Body</label>
      <div class="controls">
        <textarea name="template_text"  id="template_text" placeholder="" class="input-text-xlarge input-xxlarge"><?php echo $rowMess->template_text?></textarea>
        
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