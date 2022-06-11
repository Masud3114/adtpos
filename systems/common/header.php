<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<title>Welcome To <?php echo APP_NAME; ?> | Maintenance By Part One Technology | Designed & Develop By Advance Design & Technology | </title>
		<!-- Favicon-->
		<link rel="shortcut icon" href="assets/_img/site_logo.png" type="image/png">
		<link rel="icon" href="assets/_img/site_logo.png" type="image/png" >
		<!-- Jquery Core Js -->
		<script src="assets/plugins/jquery/jquery.min.js"></script>
		<script type="text/javascript">
		$(function () {
			//active menu//
			$( "li.active" ).parents('li').addClass("active");
		});
		</script>
		<!-- Bootstrap Core Js -->
		<script src="assets/plugins/bootstrap/js/bootstrap.js"></script>
		<!-- Google Fonts -->
		<link href="assets/plugins/google_font/Roboto/Roboto.css" rel="stylesheet" type="text/css">
		<link href="assets/plugins/google_font/Material Icons/MaterialIcons.css" rel="stylesheet" type="text/css">
		<!-- Bootstrap Core Css -->
		<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Bootstrap Select Css -->
		<link href="assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
		<!-- Waves Effect Css -->
		<link href="assets/plugins/node-waves/waves.css" rel="stylesheet" />
		<!-- Animation Css -->
		<link href="assets/plugins/animate-css/animate.css" rel="stylesheet" />
		<!-- font-awesome Css -->
		<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
		<!-- Sweetalert Css -->
		<link href="assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
		<!---flatpickr-->
		<link href="assets/plugins/flatpickr/flatpickr.min.css" rel="stylesheet">
		<!-- Select2 Css -->
		<link href="assets/plugins/select2/theme/select2.min.css" rel="stylesheet">
		<link href="assets/plugins/select2/theme/select2-bootstrap.css" rel="stylesheet">
		<link href="assets/plugins/select2/theme/pmd-select2.css" rel="stylesheet">
		<!--Datatable-->
		<link href="assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
		<!-- Morris Chart Css
		<link href="plugins/morrisjs/morris.css" rel="stylesheet" />-->
		<!--jquery-ui
		<link href="jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css" />
		<link href="jquery-ui/jquery-ui.theme.css" rel="stylesheet" type="text/css" />-->
		<!-- Custom Css -->
		<link href="assets/_css/style.css" rel="stylesheet">
		<!-- MAYA Themes-->
		<link href="assets/_css/themes/theme-lime.css" rel="stylesheet" />
		
	</head>
	<body class="theme-lime ls-closed">
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
		<!-- Top Bar -->
		<nav class="navbar">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
					<a href="javascript:void(0);" class="bars"></a>
					<a class="navbar-brand" href="index.php">
						<span><i class="material-icons">home</i></span>
					</a>
					<img style="width:120px;" class="img img-fluid" src="<?php echo $cmp_info['dcmpny_logo']; ?>">
				</div>
				<div class="collapse navbar-collapse" id="navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="pull-right"><a href="index.php?sts=logout" class="js-right-sidebar" data-close="true" data-toggle="tooltip" title="Logout!"><i class="material-icons">power_settings_new</i></a></li>
					</ul>
				</div>
			</div>
		</nav>