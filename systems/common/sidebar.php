<?PHP
if(defined('BASEPATH')){
	$menue_manage=new module_manage();
?>
		<section>
			<!-- Left Sidebar -->
			<aside id="leftsidebar" class="sidebar">
				<!-- User Info -->
				<div class="user-info bg-blue-grey">
					<div class="image">
						<img src="<?=$user_info['dusr_img'];?>" alt="User" />
					</div>
					<div class="content">
						<div class="btn-group user-helper-dropdown">
							<span class="btn btn-default waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								<div class="name"><?=$user_info['dusr_num'];?></div>
								<div class="email">
									<?=$user_info['dusr_eml'];?>
									<i class="material-icons" >keyboard_arrow_down</i>
								</div>
							</span>
							<ul class="dropdown-menu pull-right">
								<li><a href="./?pg=sinup&&sx_code=<?=$_SESSION['user_id'];?>"><i class="material-icons">person</i>Profile</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="./?sts=logout"><i class="material-icons">input</i>Sign Out</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- #User Info -->
				<!-- Menu -->
				<div class="menu">
					<ul class="list">
						<li class="header">MAIN NAVIGATION</li>
						<?php $menue_manage->genarate_menu('USER-000001'); ?>
					</ul>
				</div>
				<!-- #Menu -->
				<!-- Footer -->
				<div class="legal">
					<div class="copyright">
						&copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
					</div>
					<div class="version">
						<b>Version: </b> 1.0.5
					</div>
				</div>
				<!-- #Footer -->
			</aside>
			<!-- #END# Left Sidebar -->
		</section>
		<!--Body content-->
		<section class="content">
			<div class="container-fluid">
	<?PHP
}else{
	echo "Directory access is forbidden";
	exit;
}
?>