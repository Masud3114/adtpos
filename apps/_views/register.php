			<div class="login-box">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header bg-blue align-center">
							<h1><?=APP_NAME; ?></h1>
							<small>Tech Inside</small>
						</div>
						<div class="body">
							<form id="sign_up" method="POST" enctype="multipart/form-data">
								<div class="msg">
									<h3>Register as a new user</h3>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" required id="dusr_logid" name="dusr_logid" value="<? echo $pickval[dusr_logid]; ?>" />
										<label class="form-label">Login ID</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="password" <?php if(!isset($pickval['dusr_pswd'])) { echo 'required'; } ?> class="form-control" id="password" name="dusr_pswd" value="" />
										<label class="form-label">Login Password</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="password" <?php if(!isset($pickval['dusr_pswd'])) { echo 'required'; } ?> class="form-control" id="confirm" name="confirm" value="" />
										<label class="form-label">Confirm Password</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" size="50" required class="form-control" name="dusr_num" id="dusr_num" value="<? echo $pickval[dusr_num]; ?>">
										<label class="form-label">User Name</label>
									</div>
								</div>
								<div class="file-field input-field form-group">
									<img style="max-height:100px; max-width:100px; " src="<? echo $pickval[dusr_img];?>" id="ImageId"/>
									<div class="btn btn-info">
										<span>Select User Photo</span>
										<input type="file" id="dusr_img" name="dusr_img" onchange='Test.UpdatePreview(this,ImageId)'/>
									</div>
									<div class="file-path-wrapper form-line"></div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" id="dusr_dsig"  class="form-control"  size="45" name="dusr_dsig" value="<? echo $pickval[dusr_dsig]; ?>" />
										<label class="form-label">Designation</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" id="dusr_dept"  class="form-control"  size="45" name="dusr_dept" value="<? echo $pickval[dusr_dept]; ?>" />
										<label class="form-label">Department</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" id="dusr_mobno" required class="form-control" size="45" name="dusr_mobno" value="<? echo $pickval[dusr_mobno]; ?>"/>
										<label class="form-label">Mobile No</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="email" size="50" required class="form-control" name="dusr_eml" value="<? echo $pickval[dusr_eml]; ?>" />
										<label class="form-label">User E-Mail</label>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-4">
										<input type="submit"  class="btn btn-block bg-blue waves-effect" name="register" value="SIGN-UP">
									</div>
								</div>
								<div class="row m-t-15 m-b--20">
									<div class="col-md-12 align-center">
										<a href="?pg=log_in">You already have a user?</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>