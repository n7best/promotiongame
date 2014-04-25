<?php
$a =basename($_SERVER['REQUEST_URI']);

$role = "";
$emails = "";
$user_tab = "";
$dashboard = "";

if (strpos($a,'setting') !== false) 
{
	$setting ='class="active"';
}

if (strpos($a,'rol') !== false) 
{
	$role ='class="active"';
}

if (strpos($a,'email') !== false) 
{
	$emails ='class="active"';
}

if (strpos($a,'user') !== false) 
{
	$user_tab ='class="active"';
}

if (strpos($a,'index') !== false) 
{
	$dashboard ='class="active"';
}

if (strpos($a,'stat') !== false) 
{
	$stats ='class="active"';
}
?>


    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <a class="navbar-brand" href="index.php" name="top"><?php echo PRODUCT_NAME?></a>
        </div>
        
        <div class="navbar-collapse collapse">
        
          <ul class="nav navbar-nav">
            
            
            <li <?php echo $dashboard?>><a href="index.php"><i class="glyphicon glyphicon-home"></i> Home</a></li>
            <li <?php echo $user_tab?>><a href="users.php"><i class="glyphicon glyphicon-user"></i> Users</a></li>
            
            <li <?php echo $send_message?>><a href="send_message.php"><i class="glyphicon glyphicon-comment"></i> Send Message</a></li>
            
            <li <?php echo $stats?>><a href="stats.php"><i class="glyphicon glyphicon-stats"></i> Stats</a></li>
            <li><a href="setting_admin.php"><i class="glyphicon glyphicon-wrench"></i> Admin Settings</a></li>
            
            
           
          </ul>
          
          
          <ul class="nav navbar-nav navbar-right">
						
						<li class="divider"></li>
						<li><a href="logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
					</ul>
          
          
          <ul class="nav navbar-nav navbar-right">
          
           <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Help <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="help_loged_based_protection.php">Login Based Protection</a></li>
                <li><a href="help_role_based_protection.php">Role Based Protection</a></li>
                
                <li class="divider"></li>
                <li class="dropdown-header">Public Link</li>
                 <li><a href="../user_signup.php" target="_blank">See Sign Up Link</a></li> 
              </ul>
            </li>
           
           
           
           
          </ul>
          
          
        </div><!--/.nav-collapse -->
      </div>
    </div>