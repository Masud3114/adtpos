				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<?php
						$sx_code=$action->escap_string($_GET['sx_code']);
						$pick_sql="select *, (select module_name from usystem_module AS tc where tc.slno=tp.parent_slno) as parent_name 
						from usystem_module AS tp
						where slno='".$sx_code."'";
						$pickval = $cmncls->newpikval('','','',$pick_sql);
						?>
						<form name="dcompny_info" method="post" enctype="multipart/form-data">
							<div class="row card" style="min-height:10px; margin-bottom:10px;">
								<div class="body" align="center" style="padding:10px;" >
									<input class="btn btn-warning" name="dmodule_ad"  type="submit" id="dmodule_ad" value="Add" />
									<input class="btn btn-warning" name="dmodule_updt" type="submit" id="dmodule_updt" value="Update" />
									<input class="btn btn-warning" name="dmodule_dlt" type="submit" id="dmodule_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');"/>
									<input class="btn btn-warning" name="dmodule_clr" type="button" id="dmodule_clr" onclick="parent.location='index.php?pg=<?php echo $_GET['pg']; ?>'" value="Clear" />
								</div>
							</div>
							<div class="row card">
								<div class="header">
									<center><h3>Modules Information</h3></center>
								</div>
								<div class="body">
									<div class="form-group form-float">
										<div class="form-line">
											<input type="hidden" id="slno" name="slno" value="<?php echo $pickval[slno]; ?>" />
											<input type="text" class="form-control" required="required" id="module_name" name="module_name" value="<?php echo $pickval['module_name']; ?>" />
											<label class="form-label">Module Name</label>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">
											<input type="text" required="required" class="form-control" id="module_description" name="module_description" value="<?php echo $pickval['module_name']; ?>" />
											<label class="form-label">Module Description</label>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">
											<input type="text" size="50" required="required" class="form-control" name="link_caption" id="link_caption" value="<?php echo $pickval['link_caption']; ?>">
											<label class="form-label">Link Caption</label>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">
											<input type="text" size="50" required="required" class="form-control" name="link_url" id="link_url" value="<?php echo $pickval['link_url']; ?>">
											<label class="form-label">Link URL</label>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">
											<select name="link_type" id="link_type" class="form-control show-tick">
												<option required value="">--Link Type--</option>
												<option <? if ($pickval[link_type] == 'pg') {?> selected="selected" <? }?> value="pg">Page</option>
												<option <? if ($pickval[link_type] == 'pgr') {?> selected="selected" <? }?> value="pgr">Report</option>
											</select>
											<input type="hidden" name="ppg" value="<? echo $_GET['pg']; ?>" />
										</div>
									</div>
									<div class="form-group form-float">
										<div class="input-group">
											<label class="form-label">Parent Module</label>
											<select style="width:100%;" class="form-control select2auto" ppg="s2search" name="parent_slno">
												<?php echo $pickval['parent_slno']? ' <option value="'.$pickval['parent_slno'].'" selected="selected">'.$pickval['parent_name'].'</option>': ''; ?>
											</select>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">
											<input type="text" size="50" class="form-control" name="url_icon" id="url_icon" value="<?php echo $pickval['url_icon']; ?>">
											<label class="form-label">Link Icon</label>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">
											<input type="text" size="50" required="required" class="form-control" name="index_slno" id="index_slno" value="<?php echo $pickval['index_slno']; ?>">
											<input type="hidden" name="ppg" value="<?php echo $_GET['pg']; ?>" />
											<label class="form-label">Link Serial</label>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="demo-switch">
											<div class="switch">
												<label>Admin<input type="checkbox" name="admin" value="1" <?php if($pickval['admin']!=NULL && $pickval['admin']=="1"){ ?>checked<?php } ?> ><span class="lever switch-col-red"></span></label>
											</div>
											<div class="switch">
												<label>User<input type="checkbox" name="user" value="1"  <?php if($pickval['user']!=NULL && $pickval['user']=="1"){ ?>checked<?php } ?> ><span class="lever switch-col-red"></span></label>
											</div>
											<div class="switch">
												<label>Cashier<input type="checkbox" name="cashier" value="1"  <?php if($pickval['cashier']!=NULL && $pickval['cashier']=="1"){ ?>checked<?php } ?> ><span class="lever switch-col-red"></span></label>
											</div>
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
								<table class="table table-striped table-hover dataTable" data="systems_module">
									<thead>
										<tr>
											<th ><strong>Name</strong></th>
											<th ><strong>Caption</strong></th>
											<th ><strong>Link</strong></th>
											<th ><strong>P_id</strong></th>
											<th ><strong>#</strong></th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th ><strong>Name</strong></th>
											<th ><strong>Caption</strong></th>
											<th ><strong>Link</strong></th>
											<th ><strong>P_id</strong></th>
											<th ><strong>#</strong></th>
										</tr>
									</tfoot> 
								</table>
							</div>
						</div>
					</div>
				</div>