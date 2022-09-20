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
										<input type="password" class="form-control" name="passd" placeholder="Password" required>
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