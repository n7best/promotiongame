
<div class="span3" id="sidebar">
                
                   <div class="sidebar-nav">
	<div class="well" style="width:250px; padding: 8px 0;">
		<ul class="nav nav-list"> 
		  <li class="nav-header">Admin Menu</li>        
		  <li <?php echo $dashboard?>><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
          <li <?php echo $emails?>><a href="email_templates.php"><i class="
glyphicon glyphicon-envelope"></i> Email Templates </a></li>
          
		  <li <?php echo $user_tab?> ><a href="users.php"><i class="glyphicon glyphicon-user"></i> Users</a></li>
           <li <?php echo $role?> ><a href="roles.php"><i class="glyphicon glyphicon-list-alt"></i> Roles</a></li>
             <li <?php echo $ipblocking?> ><a href="ip-blocking.php"><i class="glyphicon glyphicon-globe"></i> IP Blocking</a></li>
          <li class="divider"></li>
		  <li <?php echo $setting?>><a href="setting.php"><i class="glyphicon glyphicon-wrench"></i>System Settings</a></li>
		  <li><a href="logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
		</ul>
	</div>
</div>
              
              
</div>