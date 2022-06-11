<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<title>Welcome To <?php echo APP_NAME; ?> | Maintenance By Part One Technology | Designed & Develop By Advance Design & Technology | </title>
		<link rel="shortcut icon" href="_img/site_logo.png" type="image/png" >
		<link rel="icon" href="_img/site_logo.png" type="image/png" >
		<link href="assets/plugins/google_font/Roboto/Roboto.css" rel="stylesheet" type="text/css">
		<link href="assets/plugins/google_font/Material Icons/MaterialIcons.css" rel="stylesheet" type="text/css">
		<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/plugins/node-waves/waves.css" rel="stylesheet" />
		<link href="assets/plugins/animate-css/animate.css" rel="stylesheet" />
		<link href="assets/_css/style.min.css" rel="stylesheet">
	</head>
	<body class="login-page">
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
		<div class="login-box">
			<div class="logo">
				<a href="javascript:void(0);"><?php echo APP_NAME; ?></b></a>
				<small>Tech Inside</small>
			</div>
			<div class="card">
				<div class="body">
					<form id="sign_in" method="POST">
						<div class="msg">Sign in to start your session</div>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">person</i>
							</span>
							<div class="form-line">
								<input type="text" class="form-control" name="user" placeholder="Username" required autofocus>
							</div>
						</div>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">lock</i>
							</span>
							<div class="form-line">
								<input type="password" class="form-control" name="passd" placeholder="Password" required autofocus>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-8 p-t-5">
								<input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
								<label for="rememberme">Remember Me</label>
							</div>
							<div class="col-xs-4">
								<input type="submit"  class="btn btn-block bg-pink waves-effect" name="login" value="SIGN IN">
							</div>
						</div>
						<div class="row m-t-15 m-b--20">
							<div class="col-xs-6 align-right">
								<a href="#">Forgot Password?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="assets/plugins/jquery/jquery.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.js"></script>
		<script src="assets/plugins/node-waves/waves.js"></script>
		<script src="assets/plugins/jquery-validation/jquery.validate.js"></script>
		<script src="assets/js/admin.js"></script>
		<script src="assets/js/pages/examples/sign-in.js"></script>
	</body>
</html>