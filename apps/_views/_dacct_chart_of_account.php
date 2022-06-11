				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<?php
						$sx_code=$action->escap_string($_GET['sx_code']);
						$pick_sql="select *, (select acct_level_name from acc_calevel AS tc where tc.slno=tp.parrent_code) as parent_name
						from acc_chart_of_account AS tp
						where slno='".$sx_code."'";
						$pickval = $cmncls->newpikval('','','',$pick_sql);
						?>
						<form name="dcompny_info" method="post" enctype="multipart/form-data">
							<div class="row card" style="min-height:10px; margin-bottom:10px;">
								<div class="body" align="center" style="padding:10px;" >
									<input class="btn btn-warning" name="dacc_ca_ad"  type="submit" id="dacc_ca_ad" value="Add" />
									<input class="btn btn-warning" name="dacc_ca_updt" type="submit" id="dacc_ca_updt" value="Update" />
									<input class="btn btn-warning" name="dacc_ca_dlt" type="submit" id="dacc_ca_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');"/>
									<input class="btn btn-warning" name="dacc_ca_clr" type="button" id="dacc_ca_clr" onclick="parent.location='index.php?pg=<?php echo $_GET['pg']; ?>'" value="Clear" />
								</div>
							</div>
							<div class="row card">
								<div class="header">
									<center><h3>Chart of Account</h3></center>
								</div>
								<div class="body">
									<div class="form-group form-float">
										<div class="form-line disabled">
											<input type="hidden" id="slno" name="slno" value="<?php echo $pickval[slno]; ?>" />
											<input type="text" class="form-control" disabled readonly required id="acct_code" name="acct_code" value="<?php echo $pickval['acct_code']; ?>" />
											<label class="form-label">Code</label>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">
											<input type="text" required class="form-control" id="acct_name" name="acct_name" value="<?php echo $pickval['acct_name']; ?>" />
											<label class="form-label">Name</label>
										</div>
									</div>
									<div class="form-group form-float" align="left">
										<div class="form-line">
											<select name="acct_type" class="form-control show-tick" required>
												<option value="">Select Account Type</option>
												<option value="1"<?php echo $pickval['acct_type']=='1'? 'selected':''; ?>>Asset</option>
												<option value="2"<?php echo $pickval['acct_type']=='2'? 'selected':''; ?>>Liability</option>
												<option value="3"<?php echo $pickval['acct_type']=='3'? 'selected':''; ?>>Owner's Equity</option>
												<option value="4"<?php echo $pickval['acct_type']=='4'? 'selected':''; ?>>Revenue/Income</option>
												<option value="5"<?php echo $pickval['acct_type']=='5'? 'selected':''; ?>>Expenditure</option>
											</select>
										</div>
									</div>
									<div class="form-group form-float" align="left">
										<div class="form-line">
											<select name="acct_usages" class="form-control show-tick" required>
												<option value="">Select Account Usages</option>
												<option value="1"<?php echo $pickval['acct_usages']=='1'? 'selected':''; ?>>AP</option>
												<option value="2"<?php echo $pickval['acct_usages']=='2'? 'selected':''; ?>>AR</option>
												<option value="3"<?php echo $pickval['acct_usages']=='3'? 'selected':''; ?>>BANK</option>
												<option value="4"<?php echo $pickval['acct_usages']=='4'? 'selected':''; ?>>CASH</option>
												<option value="5"<?php echo $pickval['acct_usages']=='5'? 'selected':''; ?>>LEDGER</option>
											</select>
										</div>
									</div>
									<div class="form-group form-float" align="left">
										<div class="form-line">
											<select name="acct_source" class="form-control show-tick" required>
												<option value="">Select Account Source</option>
												<option value="1"<?php echo $pickval['acct_source']=='1'? 'selected':''; ?>>Customer</option>
												<option value="2"<?php echo $pickval['acct_source']=='2'? 'selected':''; ?>>Employee</option>
												<option value="3"<?php echo $pickval['acct_source']=='3'? 'selected':''; ?>>None</option>
												<option value="4"<?php echo $pickval['acct_source']=='4'? 'selected':''; ?>>Sub-account</option>
												<option value="5"<?php echo $pickval['acct_source']=='5'? 'selected':''; ?>>Supplier</option>
											</select>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="input-group">
											<label class="form-label">Level</label>
											<select style="width:100%;" class="form-control select2auto" ppg="s2search" name="parrent_code">
												<?php echo $pickval['parrent_code']? ' <option value="'.$pickval['parrent_code'].'" selected="selected">'.$pickval['parent_name'].'</option>': ''; ?>
											</select>
										</div>
									</div>
									<div class="form-group form-float">
										<label  class="form-label">Details</label>
										<div class="form-line">
											<textarea name="acct_desc" class="form-control txtedt" id="acct_desc" cols="45"  rows="3"><? echo $pickval['acct_desc']; ?></textarea>
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
											echo $user_info['name_']."<br />".date('h:i:sA, d-M-Y',strtotime($pickval['dent_dt'])); 
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
											echo $user_info['name_']."<br />".date('h:i:sA, d-M-Y',strtotime($pickval['dupdt_dt'])); 
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
								<table class="table table-striped table-hover dataTable" data="acct_chart_of_account">
									<thead>
										<tr>
											<th ><strong>Code</strong></th>
											<th ><strong>Type</strong></th>
											<th ><strong>Level</strong></th>
											<th ><strong>Name</strong></th>
											<th ><strong>Usages</strong></th>
											<th ><strong>Source</strong></th>
											<th ><strong>#</strong></th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th ><strong>Code</strong></th>
											<th ><strong>Type</strong></th>
											<th ><strong>Level</strong></th>
											<th ><strong>Name</strong></th>
											<th ><strong>Usages</strong></th>
											<th ><strong>Source</strong></th>
											<th ><strong>#</strong></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>