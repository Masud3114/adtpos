<?PHP
if(defined('BASEPATH')){ ?>
		<section>
			<!-- Left Sidebar -->
			<aside id="leftsidebar" class="sidebar">
				<!-- User Info -->
				<div class="user-info">
					<div class="image">
						<img src="assets/images/user.png" width="50" height="50" alt="User" />
					</div>
					<div class="info-container">
						<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome</div>
						<div class="email"><?php echo $_SESSION['user_name']?></div>
					</div>
				</div>
				<!-- #User Info -->
				<!-- Menu -->
				<?php
				$menue_manage=new module_manage();
				?>
				<div class="menu">
					<ul class="list">
						<li class="header active">MAIN NAVIGATION</li>
						<div  id="main_nav">
						<?php $menue_manage->genarate_menu('USER-000001'); ?>
						</div>
					</ul>
				</div>
				<!-- #Menu -->
				<!-- Footer -->
				<div class="legal">
					<div class="copyright">
						&copy; 2017 <a href="javascript:void(0);">MAYA APPS</a>.
					</div>
					<div class="version">
						<b>Version: </b> 2.0.4
					</div>
				</div>
				<!-- #Footer -->
			</aside>
			<!-- #END# Left Sidebar -->
		</section>
		<section class="content">
			<div class="container-fluid">
	<?PHP
}else{
	echo "Directory access is forbidden";
	exit;
}
?>