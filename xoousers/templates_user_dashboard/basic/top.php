<?php if(!isset($_SESSION['XOOSCRIPTS_USER'])){echo "action not allowed"; exit;}?>
        <div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="user_dashboard.php" name="top"><?php echo PRODUCT_NAME?></a>
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li <?php echo $dashboard?>><a href="user_dashboard.php"><i class="icon-home"></i> <?php echo $lang['U_DASHBOARD_TOP_HOME']?></a></li>
					
					<li class="divider-vertical"></li>
					<li <?php echo $user_tab?>><a href="user_dashboard_avatar.php"><i class="icon-user"></i> <?php echo $lang['U_DASHBOARD_TOP_AVATAR']?></a></li>
					
					                                    
                    
					<li class="divider-vertical"></li>
				</ul>
				<div class="btn-group pull-right">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i> admin	<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="user_dashboard_change_password.php"><i class="icon-wrench"></i> <?php echo $lang['U_DASHBOARD_TOP_PASSWORD']?></a></li>
						<li class="divider"></li>
						<li><a href="logout.php"><i class="icon-share"></i> <?php echo $lang['U_DASHBOARD_TOP_LOGOUT']?></a></li>
					</ul>
				</div>
			</div>
			<!--/.nav-collapse -->
		</div>
		<!--/.container-fluid -->
	</div>
	<!--/.navbar-inner -->
</div>
<!--/.navbar -->
