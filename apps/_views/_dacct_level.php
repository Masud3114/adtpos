				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<?php
						$sx_code=$action->escap_string($_GET['sx_code']);
						//$pick_sql="select t1.*,
						//(case when t1.acct_parent_slno=t2.slno then t2.acct_level_name END ) as parents_name
						//from acc_calevel t1, acc_calevel t2 
						//where t1.slno='".$sx_code."'";
						$pick_sql="select t1.*
						from acc_calevel t1
						where t1.slno='".$sx_code."'";
						$pickval = $cmncls->newpikval('','','',$pick_sql);
						?>
						<form name="dcompny_info" method="post" enctype="multipart/form-data">
							<div class="row card" style="min-height:10px; margin-bottom:10px;">
								<div class="body" align="center" style="padding:10px;" >
									<input class="btn btn-warning" name="dacctlevel_ad"  type="submit" id="dacctlevel_ad" value="Add" />
									<input class="btn btn-warning" name="dacctlevel_updt" type="submit" id="dacctlevel_updt" value="Update" />
									<input class="btn btn-warning" name="dacctlevel_dlt" type="submit" id="dacctlevel_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');"/>
									<input class="btn btn-warning" name="dacctlevel_clr" type="button" id="dacctlevel_clr" onclick="parent.location='index.php?pg=<?php echo $_GET['pg']; ?>'" value="Clear" />
								</div>
							</div>
							<div class="row card">
								<div class="header">
									<center><h3>Account Level</h3></center>
								</div>
								<div class="body">
									<div class="form-group form-float">
										<div class="form-line">
											<input type="hidden" id="slno" name="slno" value="<?php echo $pickval[slno]; ?>" />
											<input type="text" required="required" class="form-control" id="acct_level_no" name="acct_level_no" value="<?php echo $pickval['acct_level_no']; ?>" />
											<label class="form-label">Level ID</label>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">
											<input type="text" required="required" class="form-control" id="acct_level_name" name="acct_level_name" value="<?php echo $pickval['acct_level_name']; ?>" />
											<label class="form-label">Name</label>
										</div>
									</div>
									<div class="form-group form-float" align="left">
										<div class="form-line">
											<select name="acct_type" class="form-control show-tick" required>
												<option value="">Type</option>
												<option value="Asset"<?php echo $pickval['acct_type']=='Asset'? 'selected':''; ?>>Asset</option>
												<option value="Liability"<?php echo $pickval['acct_type']=='Liability'? 'selected':''; ?>>Liability</option>
												<option value="Equity"<?php echo $pickval['acct_type']=='Equity'? 'selected':''; ?>>Equity</option>
												<option value="Income"<?php echo $pickval['acct_type']=='Income'? 'selected':''; ?>>Income</option>
												<option value="Expense"<?php echo $pickval['acct_type']=='Expense'? 'selected':''; ?>>Expense</option>
											</select>
										</div>
									</div>
									<div class="form-group form-float">
										<label  class="form-label">Details</label>
										<div class="form-line">
											<textarea name="acct_level_desc" class="form-control txtedt" id="acct_level_desc" cols="45"  rows="3"><? echo $pickval['acct_level_desc']; ?></textarea>
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
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="card">
							<div class="body table-responsive">
								<table class="table table-striped table-hover dataTable" data="acct_level">
									<thead>
										<tr>
											<th ><strong>ID</strong></th>
											<th ><strong>Name</strong></th>
											<th ><strong>Type</strong></th>
											<th ><strong>Details</strong></th>
											<th ><strong>#</strong></th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th ><strong>ID</strong></th>
											<th ><strong>Name</strong></th>
											<th ><strong>Type</strong></th>
											<th ><strong>Details</strong></th>
											<th ><strong>#</strong></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>