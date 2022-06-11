			<div class="row">
				<div class="col-md-6">
					<?php $pickval = $cmncls->newpikval('item_pram','slno',$_GET['sx_cod']); ?>
					<form name="store_info" method="post" enctype="multipart/form-data">
						<div class="row card" style="min-height:10px; margin-bottom:10px;">
							<div class="body" align="center" style="padding:10px;" >
								<input class="btn btn-warning" name="dsize_ad"  type="submit" id="dsize_ad" value="Add" />
								<input class="btn btn-warning" name="dsize_updt" type="submit" id="dsize_updt" value="Update" />
								<input class="btn btn-warning" name="dsize_dlt" type="submit" id="dsize_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');" />
								<input class="btn btn-warning" name="dsize_clr" type="button" id="dsize_clr" onclick="parent.location='index.php?pg=<?php echo $_GET[pg]; ?>'" value="Clear" />
							</div>
						</div>
						<div class="row card">
							<div class="header">
								<center><h3>Size Details</h3></center>
							</div>
							<div class="body">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="hidden" id="slno" name="slno" value="<?php echo $pickval[slno]; ?>" />
										<input type="hidden" name="pram_type" value="<?php echo $pickval[pram_type]; ?>" />
										<input type="hidden" name="ppg" value="<?php echo $_GET['pg']; ?>" />
										<input type="text" class="form-control" required="required"  id="pram_name" name="pram_name" value="<?php echo $pickval[pram_name]; ?>" />
										<label class="form-label">Size Name</label>
									</div>
								</div>
								<?php
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
							<table class="table table-striped table-hover dataTable" data="size_info">
								<thead>
									<tr>
										<th ><strong>Size Name</strong></th>
										<th ><strong>#</strong></th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th ><strong>Size Name</strong></th>
										<th ><strong>#</strong></th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>