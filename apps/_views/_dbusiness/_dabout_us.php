			<div class="row">
				<div class="col-md-6">
					<?php $pickval = $cmncls->newpikval('company_info','slno',$_GET['sx_cod']); ?>
					<form name="company_info" method="post" enctype="multipart/form-data">
						<div class="row card" style="min-height:10px; margin-bottom:10px;">
							<div class="body" align="center" style="padding:10px;" >
								<input class="btn btn-warning" name="dcmpinfo_ad"  type="submit" id="dcmpinfo_ad" value="Add" />
								<input class="btn btn-warning" name="dcmpinfo_updt" type="submit" id="dcmpinfo_updt" value="Update" />
								<input class="btn btn-warning" name="dcmpinfo_dlt" type="submit" id="dcmpinfo_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');" />
								<input class="btn btn-warning" name="dcmpinfo_clr" type="button" id="dcmpinfo_clr" onclick="parent.location='index.php?pg=<?php echo $_GET[pg]; ?>'" value="Clear" />
							</div>
						</div>
						<div class="row card">
							<div class="header">
								<center><h3>About Company</h3></center>
							</div>
							<div class="body">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="hidden" id="slno" name="slno" value="<?php echo $pickval[slno]; ?>" />
										<input type="text" class="form-control" required="required"  id="info_title" name="info_title" value="<?php echo $pickval[info_title]; ?>" />
										<label class="form-label">Title</label>
									</div>
								</div>
								<img class="imgpreviewl" src="<?php echo $pickval[info_banner]; ?>" id="ImageId"/>
								<div class="file-field input-field form-group">
									<div class="btn btn-warning">
										<span>Banner</span>
										<input type="file" id="info_banner" name="info_banner" onchange='Test.UpdatePreview(this,ImageId)'/>
									</div>
									<div class="file-path-wrapper form-line"></div>
								</div>
								<div class="form-group form-float">
									<label class="form-label">About CaddCore</label>
									<textarea type="text" class="txtedt form-control" id="info_details" name="info_details"><?php echo $pickval[info_details]; ?></textarea>
									<input type="hidden" name="info_location" value="about_us" />
									<input type="hidden" name="ppg" value="<? echo $_GET[pg]; ?>" />
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
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th ><strong>#</strong></th>
										<th ><strong>Title</strong></th>
									</tr>
								</thead>
								<tbody>
									<?
									$sx_val=array(
										"sx_cod_cap"=>"sx_cod",
										"sx_pag_cap"=>"sx_pag",
										"sx_search_cap"=>"sx_srsval");
									if(isset($_GET['sx_srsval']) && $_GET['sx_srsval']!=null){
										$whr_cmd=" AND (info_title like '%".$_GET['sx_srsval']."%' 
										or info_details like '%".$_GET['sx_srsval']."%')";
									}
									$sql_qry = "SELECT concat((LEFT(info_title , 40)),'...') as info_title, slno
										FROM company_info
										where info_location='about_us' AND sts = '1' ".$whr_cmd."";
									$lstprv->srch_tbl($sql_qry,'slno',30,$sx_val);
									?>
								</tbody> 
							</table>
						</div>
					</div>
				</div>
			</div>