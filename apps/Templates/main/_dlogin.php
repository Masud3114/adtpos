<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<title>Welcome To <?php echo APP_NAME; ?> | <?=SERVICE_PROVIDER;?>| </title>
		<link rel="shortcut icon" href="assets/_img/site_logo.png" type="image/png">

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

		<!-- Bootstrap Core Css -->
		<link href="./assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

		<!-- Waves Effect Css -->
		<link href="./assets/plugins/node-waves/waves.css" rel="stylesheet" />

		<!-- Animation Css -->
		<link href="./assets/plugins/animate-css/animate.css" rel="stylesheet" />

		<!-- Custom Css -->
		<link href="./assets/_css/style.min.css" rel="stylesheet">
		<link href="./assets/_css/log_in.css" rel="stylesheet">
	</head>
	<body>
		<div class="login-page">
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
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header bg-blue-grey align-center">
							<h1><?=APP_NAME; ?></h1>
							<small>Tech Inside</small>
						</div>
						<div class="body">
							<form id="sign_in" method="POST">
								<div class="msg"><h3>Sign in to start your session</h3></div>
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
									<div class="col-xs-6 align-left">
										<a href="?pg=NewUser">Register Now!</a>
									</div>
									<div class="col-xs-6 align-right">
										<a href="#">Forgot Password?</a>
									</div>
								</div>
							</form>
						</div>
					</div>
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