			<div class="row">
				<div class="col-md-6">
					<?php $pickval = $cmncls->newpikval(dcmpny_info,dcmpny_cod,$_GET[sx_code]); ?>
					<form name="dcompny_info" method="post" enctype="multipart/form-data">
						<div class="row card" style="min-height:10px; margin-bottom:10px;">
							<div class="body" align="center" style="padding:10px;" >
								<input class="btn btn-warning" name="dcmpny_ad"  type="submit" id="dcmpny_ad" value="Add" />
								<input class="btn btn-warning" name="dcmpny_updt" type="submit" id="dcmpny_updt" value="Update" />
								<input class="btn btn-warning" name="dcmpny_dlt" type="submit" id="dcmpny_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');" />
								<input class="btn btn-warning" name="dcmpny_clr" type="button" id="dcmpny_clr" onclick="parent.location='index.php?pg=com_bnc_info'" value="Clear" />
							</div>
						</div>
						<div class="row card">
							<div class="header">
								<center><h3>Company Details Information</h3></center>
							</div>
							<div class="body">
								<div class="form-group">
									<div class="form-line">
										<input type="text" readonly="readonly"  placeholder="Code (Auto Generate)" class="form-control" id="dcmpny_cod" name="dcmpny_cod" value="<? echo $pickval[dcmpny_cod]; ?>" />
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" required id="dcmpny_num" name="dcmpny_num" value="<? echo $pickval[dcmpny_num]; ?>" />
										<label class="form-label">Name</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" id="dcmpny_moto" name="dcmpny_moto" value="<? echo $pickval[dcmpny_moto]; ?>" />
										<label class="form-label">Motto</label>
									</div>
								</div>
								<img class="imgpreviewl" src="<? echo $pickval[dcmpny_logo];?>" id="ImageId"/>
								<div class="file-field input-field form-group">
									<div class="btn btn-warning">
										<span> Company Logo </span>
										<input type="file" id="dcmpny_logo" name="dcmpny_logo" onchange='Test.UpdatePreview(this,ImageId)'/>
									</div>
									<div class="file-path-wrapper form-line"></div>
								</div>
								<img class="imgpreviewl" src="<? echo $pickval[dcmpny_logoi];?>" id="ImageIdi"/>
								<div class="file-field input-field form-group">
									<div class="btn btn-warning">
										<span> Company Logo (Inverse) </span>
										<input type="file" id="dcmpny_logoi" name="dcmpny_logoi" onchange='Test.UpdatePreview(this,ImageIdi)'/>
									</div>
									<div class="file-path-wrapper form-line"></div>
								</div>
								<div class="form-group" align="left">
									<label class="form-label"> Address</label>
									<div class="form-line">
										<textarea name="dcmpny_adrs" id = "dcmpny_adrs" class="form-control no-resize auto-growth"/><?php echo $pickval[dcmpny_adrs]; ?></textarea>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" id="dcmpny_telno" name="dcmpny_telno" value="<? echo $pickval[dcmpny_telno]; ?>"/>
										<label class="form-label">Telephone</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" id="dcmpny_mobno" name="dcmpny_mobno" value="<? echo $pickval[dcmpny_mobno]; ?>"/>
										<label class="form-label">Mobile</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" id="dcmpny_fxno" name="dcmpny_fxno" value="<? echo $pickval[dcmpny_fxno]; ?>"/>
										<label class="form-label">Fax</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="email" class="form-control" id="dcmpny_eml" name="dcmpny_eml" value="<? echo $pickval[dcmpny_eml]; ?>" />
										<label class="form-label">E-mail</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" id="dcmpny_web" name="dcmpny_web" value="<? echo $pickval[dcmpny_web]; ?>" />
										<input type="hidden" name="ppg" value="<? echo $_GET[pg]; ?>" />
										<label class="form-label">Web</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" id="fb_link" name="fb_link" value="<?php echo $pickval[fb_link]; ?>"/>
										<label class="form-label">Face-book Link</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" id="twit_link" name="twit_link" value="<?php echo $pickval[twit_link]; ?>"/>
										<label class="form-label">Twitter Link</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" id="linked_link" name="linked_link" value="<?php echo $pickval[linked_link]; ?>"/>
										<label class="form-label">Linked In Link</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" id="gplus_link" name="gplus_link" value="<?php echo $pickval[gplus_link]; ?>"/>
										<label class="form-label">G-Plus Link</label>
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
				<div class="col-md-6">
					<div class="card">
						<div class="body table-responsive">
							<table class="table table-striped table-hover dataTable" data="address_info">
								<thead>
									<tr>
										<th ><strong>Name</strong></th>
										<th ><strong>Motto</strong></th>
										<th ><strong>Address</strong></th>
										<th ><strong>Mobile</strong></th>
										<th ><strong>#</strong></th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th ><strong>Name</strong></th>
										<th ><strong>Motto</strong></th>
										<th ><strong>Address</strong></th>
										<th ><strong>Mobile</strong></th>
										<th ><strong>#</strong></th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>