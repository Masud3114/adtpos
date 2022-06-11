				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<?php
						$sx_code=$action->escap_string($_GET['sx_code']);
						//$pick_sql="select t1.*,
						//(case when t1.acct_parent_slno=t2.slno then t2.acct_level_name END ) as parents_name
						//from acc_calevel t1, acc_calevel t2 
						//where t1.slno='".$sx_code."'";
						$pick_sql="select t1.*
						from acct_vou_prfx t1
						where t1.slno='".$sx_code."'";
						$pickval = $cmncls->newpikval('','','',$pick_sql);
						?>
						<form name="dcompny_info" method="post" enctype="multipart/form-data">
							<div class="row card" style="min-height:10px; margin-bottom:10px;">
								<div class="body" align="center" style="padding:10px;" >
									<input class="btn btn-warning" name="dacct_trn_prfx_ad"  type="submit" id="dacct_trn_prfx_ad" value="Add" />
									<input class="btn btn-warning" name="dacct_trn_prfx_updt" type="submit" id="dacct_trn_prfx_updt" value="Update" />
									<input class="btn btn-warning" name="dacct_trn_prfx_dlt" type="submit" id="dacct_trn_prfx_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');"/>
									<input class="btn btn-warning" name="dacct_trn_prfx_clr" type="button" id="dacct_trn_prfx_clr" onclick="parent.location='index.php?pg=<?php echo $_GET['pg']; ?>'" value="Clear" />
								</div>
							</div>
							<div class="row card">
								<div class="header">
									<center><h3>Transaction Prefix Set</h3></center>
								</div>
								<div class="body">
									<div class="form-group form-float">
										<div class="form-line">
											<input type="hidden" id="slno" name="slno" value="<?php echo $pickval[slno]; ?>" />
											<input type="text" required="required" class="form-control" id="prfx_name" name="prfx_name" value="<?php echo $pickval['prfx_name']; ?>" />
											<label class="form-label">Prefix:</label>
										</div>
									</div>
									<div class="form-group form-float" align="left">
										<div class="form-line">
											<select name="prfx_type" class="form-control show-tick" required>
												<option value="">Select Type</option>
												<option <?php echo $pickval['prfx_type']=='Inter Company'? 'selected':''; ?> value="Inter Company">Inter Company</option>
												<option <?php echo $pickval['prfx_type']=='Journal'? 'selected':''; ?> value="Journal">Journal</option>
												<option <?php echo $pickval['prfx_type']=='Opening Balance'? 'selected':''; ?> value="Opening Balance">Opening Balance</option>
												<option <?php echo $pickval['prfx_type']=='Payment'? 'selected':''; ?> value="Payment">Payment</option>
												<option <?php echo $pickval['prfx_type']=='Receipt'? 'selected':''; ?> value="Receipt">Receipt</option>
											</select>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">
											<input type="number" required="required" class="form-control" id="prfx_strt" name="prfx_strt" value="<?php echo $pickval['prfx_strt']; ?>" />
											<label class="form-label">Starting Number</label>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">
											<input type="number" required="required" class="form-control" id="prfx_incr" name="prfx_incr" value="<?php echo $pickval['prfx_incr']; ?>" />
											<label class="form-label">Increment</label>
										</div>
									</div>
									<div class="form-group form-float">
										<label  class="form-label">Description</label>
										<div class="form-line">
											<textarea name="prfx_desc" class="form-control txtedt" id="prfx_desc" cols="45"  rows="3"><? echo $pickval['prfx_desc']; ?></textarea>
											<input type="hidden" name="ppg" value="<?php echo $_GET['pg']; ?>" />
										</div>
									</div>
									<?php 
									if($pickval['dent_dt']!=NULL || $pickval['dent_id']!=NULL){ ?>
									<div class="form-group">
										<label  class="col-lg-4 control-label">Entered By :</label>
										<div class="col-lg-8">
											<?php
											$user_info = $cmncls->eventer_info($pickval['dent_id']);
											echo $user_info['name_']."<br />Date & Time-".date('h:i:sA, d-M-Y',strtotime($pickval['dent_dt'])); 
											?>
										</div>
									</div>
									<?php
									}
									if($pickval['dupdt_id']!=NULL || $pickval['dupdt_id']!=NULL){
									?> 
									<div class="form-group">
										<label  class="col-lg-4 control-label">Updated By :</label>
										<div class="col-lg-8">
											<?php
											$user_info = $cmncls->eventer_info($pickval['dupdt_id']);
											echo $user_info['name_']."<br />Date & Time-".date('h:i:sA, d-M-Y',strtotime($pickval['dupdt_dt'])); 
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
					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
						<div class="card">
							<div class="body table-responsive">
								<table class="table table-striped table-hover dataTable" data="acct_vouchr_prfx">
									<thead>
										<tr>
											<th ><strong>Prefix</strong></th>
											<th ><strong>Type</strong></th>
											<th ><strong>Starting No.</strong></th>
											<th ><strong>Increment</strong></th>
											<th ><strong>Details</strong></th>
											<th ><strong>#</strong></th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th ><strong>Prefix</strong></th>
											<th ><strong>Type</strong></th>
											<th ><strong>Starting No.</strong></th>
											<th ><strong>Increment</strong></th>
											<th ><strong>Details</strong></th>
											<th ><strong>#</strong></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>