				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<?php $pickval = $cmncls->newpikval(dusr_info,dusr_id,$_GET[sx_code]); ?>
						<form name="dcompny_info" method="post" enctype="multipart/form-data">
							<div class="row card" style="min-height:10px; margin-bottom:10px;">
								<div class="body" align="center" style="padding:10px;" >
									<input class="btn btn-warning" name="dusr_ad"  type="submit" id="dusr_ad" value="Add" />
									<input class="btn btn-warning" name="dusr_updt" type="submit" id="dusr_updt" value="Update" />
									<input class="btn btn-warning" name="dusr_dlt" type="submit" id="dusr_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');"/>
									<input class="btn btn-warning" name="dusr_clr" type="button" id="dusr_clr" onclick="parent.location='index.php?pg=sinup'" value="Clear" />
								</div>
							</div>
							<div class="row card">
								<div class="header">
									<center><h3>User Details Information</h3></center>
								</div>
								<div class="body">
									<div class="form-group">
										<div class="form-line">
											<input type="text" readonly="readonly" placeholder="User ID (Auto Generate)" class="form-control" id="dusr_id" name="dusr_id" value="<? echo $pickval[dusr_id]; ?>" />
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" required="required" id="dusr_logid" name="dusr_logid" value="<? echo $pickval[dusr_logid]; ?>" />
											<label class="form-label">Login ID</label>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">
											<input type="password" <?php if(!isset($pickval['dusr_pswd'])) { echo 'required="required"'; } ?> class="form-control" id="dusr_pswd" name="dusr_pswd" value="" />
											<label class="form-label">Login Password</label>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">
											<input type="text" size="50" required="required" class="form-control" name="dusr_num" id="dusr_num" value="<? echo $pickval[dusr_num]; ?>">
											<label class="form-label">User Name</label>
										</div>
									</div>
									<div class="file-field input-field form-group">
										<img style="max-height:100px; max-width:100px; " src="<? echo $pickval[dusr_img];?>" id="ImageId"/>
										<div class="btn btn-warning">
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
											<input type="text" id="dusr_mobno"   class="form-control" size="45" name="dusr_mobno" value="<? echo $pickval[dusr_mobno]; ?>"/>
											<label class="form-label">Mobile No</label>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">
											<input type="email" size="50" class="form-control" name="dusr_eml" value="<? echo $pickval[dusr_eml]; ?>" />
											<label class="form-label">User E-Mail</label>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">
											<select name="dusr_acscod" id="dusr_acscod" class="form-control show-tick">
												<option required value="">--Select Access Code--</option>
												<option <? if ($pickval[dusr_acscod] == 'admin') {?> selected="selected" <? }?> value="admin">Admin</option>
												<option <? if ($pickval[dusr_acscod] == 'user') {?> selected="selected" <? }?> value="user">User</option>
												<option <? if ($pickval[dusr_acscod] == 'cashier') {?> selected="selected" <? }?> value="cashier">Cashier</option>
											</select>
											<input type="hidden" name="ppg" value="<? echo $_GET['pg']; ?>" />
										</div>
									</div>
									<? 
									if($pickval[dent_dt]!=NULL || $pickval[dent_id]!=NULL){ ?>
									<div class="form-group">
										<label  class="col-lg-4 control-label">Entered By :</label>
										<div class="col-lg-8">
											<?php
											$user_info = $cmncls->eventer_info($pickval[dent_id]);
											echo $user_info['name_']."<br />Date & Time-".date('h:i:sA, d-M-Y',strtotime($pickval[dent_dt])); 
											?>
										</div>
									</div>
									<?php
									}
									if($pickval[dupdt_id]!=NULL || $pickval[dupdt_id]!=NULL){
									?> 
									<div class="form-group">
										<label  class="col-lg-4 control-label">Updated By :</label>
										<div class="col-lg-8">
											<?php
											$user_info = $cmncls->eventer_info($pickval[dupdt_id]);
											echo $user_info['name_']."<br />Date & Time-".date('h:i:sA, d-M-Y',strtotime($pickval[dupdt_dt])); 
											?> 
										</div>
									</div>
									<?php
									}
									?>
								</div>
							</div>
						</form>	
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="card">
							<div class="body table-responsive">
								<table class="table table-striped table-hover dataTable" data="sinup">
									<thead>
										<tr>
											<th ><strong>Name</strong></th>
											<th ><strong>Login ID</strong></th>
											<th ><strong>Designation</strong></th>
											<th ><strong>Mobile</strong></th>
											<th ><strong>#</strong></th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th ><strong>Name</strong></th>
											<th ><strong>Login ID</strong></th>
											<th ><strong>Designation</strong></th>
											<th ><strong>Mobile</strong></th>
											<th ><strong>#</strong></th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>