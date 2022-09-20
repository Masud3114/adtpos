<?php
use Adt\apps\_model\Business;
use Adt\apps\_model\Users;
$business	= new Business();
$users	= new Users();
$business_info = $business->get($_SESSION['zid']);
$user_info = $users->get($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<title>Welcome To <?php echo APP_NAME; ?> | <?=SERVICE_PROVIDER;?>| </title>
		<!-- Favicon-->
		<link rel="shortcut icon" href="<?=$business_info['dcmpny_logo']?>" type="image/png">
		<!-- Jquery Core Js
		<script src="assets/plugins/jquery/jquery.min.js"></script> -->
		<script src="assets/AdminBSBMaterialDesign-master/plugins/jquery/jquery.min.js"></script>
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
		<!-- Bootstrap Core Css -->
		<link href="assets/AdminBSBMaterialDesign-master/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Bootstrap Select Css -->
		<link href="assets/AdminBSBMaterialDesign-master/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
		<!-- Waves Effect Css -->
		<link href="assets/AdminBSBMaterialDesign-master/plugins/node-waves/waves.css" rel="stylesheet" />
		<!-- Animation Css -->
		<link href="assets/AdminBSBMaterialDesign-master/plugins/animate-css/animate.css" rel="stylesheet" />
		<!-- font-awesome Css -->
		<link href="assets/AdminBSBMaterialDesign-master/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
		<!-- Sweetalert Css -->
		<link href="assets/AdminBSBMaterialDesign-master/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
		<!---flatpickr-->
		<link href="assets/plugins/flatpickr/flatpickr.min.css" rel="stylesheet">
		<!-- Select2 Css -->
		<link href="assets/plugins/select2/theme/select2.min.css" rel="stylesheet">
		<link href="assets/plugins/select2/theme/select2-bootstrap.css" rel="stylesheet">
		<link href="assets/plugins/select2/theme/pmd-select2.css" rel="stylesheet">
		<!--Datatable-->
		<link href="assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
		<!-- Custom Css -->
		<link href="assets/_css/style.css" rel="stylesheet">
		<link href="assets/AdminBSBMaterialDesign-master/css/themes/all-themes.css" rel="stylesheet" />
	</head>
	<body class="theme-blue-grey">
		<!-- Page Loader -->
		<div class="page-loader-wrapper">
			<div class="loader">
				<div class="preloader">
					<div class="spinner-layer pl-red">
						<div class="circle-clipper left">
							<div class="circle"></div>
						</div>
						<div class="circle-clipper right">
							<div class="circle"></div>
						</div>
					</div>
				</div>
				<p>Please wait...</p>
			</div>
		</div>
		<!-- #END# Page Loader -->
		<!-- Overlay For Sidebars -->
		<div class="overlay"></div>
		<!-- #END# Overlay For Sidebars -->
		<!-- Search Bar -->
		<?php
		if($_SESSION['user_id']==='USER-000001'){
		?>
		<div class="search-bar">
			<div class="search-icon">
				<i class="material-icons">search</i>
			</div>
			<div class="search-box">
				<select class="form-control select2auto" ppg="s2search" name="dcmpny_cod" id="business_cod"></select>
			</div>
			<!--<input type="text" placeholder="START TYPING...">-->
			<div class="close-search">
				<i class="material-icons">close</i>
			</div>
		</div>
		<?php
		}
		?>
		<!-- #END# Search Bar -->
		<!-- Top Bar -->
		<nav class="navbar">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
					<a href="javascript:void(0);" class="bars"></a>
					<a href="/" class="nav-header-brand waves-effect waves-cyan hover-expand-effect text-white">
						<span style="color:#fff; font-size:3rem; font-weight:bold; padding-left:10px;">
							<img class="img img-fluid" style="max-height:50px;"  src="<?=$business_info['dcmpny_logo']?>">
							<span class="hidden-sm hidden-xs"><?=$business_info['dcmpny_num']?></span>
						</span>
					</a>
				</div>
				<div class="collapse navbar-collapse" id="navbar-collapse">
					<ul class="nav navbar-nav navbar-right pull-right">
						<!-- Call Search -->
						<?php
						if($_SESSION['user_id']==='USER-000001'){
							echo '<li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>';
						}
						?>
						<!-- #END# Call Search -->
						<li><a href="index.php?sts=logout" class="js-right-sidebar" data-close="true" data-toggle="tooltip" title="Logout!"><i class="material-icons">power_settings_new</i></a></li>
					</ul>
				</div>
			</div>
		</nav>