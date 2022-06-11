			<div class="row">
				<div class="col-md-6">
					<?php $pickval = $cmncls->newpikval('cert_info','slno',$_GET['sx_cod']); ?>
					<form name="cert_info" method="post" enctype="multipart/form-data">
						<div class="row card" style="min-height:10px; margin-bottom:10px;">
							<div class="body" align="center" style="padding:10px;" >
								<input class="btn btn-warning" name="dcert_ad"  type="submit" id="dcert_ad" value="Add" />
								<input class="btn btn-warning" name="dcert_updt" type="submit" id="dcert_updt" value="Update" />
								<input class="btn btn-warning" name="dcert_dlt" type="submit" id="dcert_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');" />
								<input class="btn btn-warning" name="dcert_clr" type="button" id="dcert_clr" onclick="parent.location='index.php?pg=<?php echo $_GET[pg]; ?>'" value="Clear" />
							</div>
						</div>
						<div class="row card">
							<div class="header">
								<center><h3>Certification Details</h3></center>
							</div>
							<div class="body">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="hidden" id="slno" name="slno" value="<?php echo $pickval[slno]; ?>" />
										<input type="text" class="form-control" id="vendor_name" name="vendor_name" value="<?php echo $pickval[vendor_name]; ?>"/>
										<label class="form-label">Vendor Name</label>
									</div>
								</div>
								<img class="imgpreviewp" src="<?php echo $pickval[vendor_logo]; ?>" id="ImageId"/>
								<div class="file-field input-field form-group">
									<div class="btn btn-warning">
										<span>Vendor Logo</span>
										<input type="file" id="vendor_logo" name="vendor_logo" onchange='Test.UpdatePreview(this,ImageId)'/>
									</div>
									<div class="file-path-wrapper form-line"></div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" id="cert_title" name="cert_title" value="<?php echo $pickval[cert_title]; ?>"/>
										<label class="form-label">Certified Title</label>
									</div>
								</div>
								<img class="imgpreviewp" src="<?php echo $pickval[cert_logo]; ?>" id="ImageIdtl"/>
								<div class="file-field input-field form-group">
									<div class="btn btn-warning">
										<span>Title Logo</span>
										<input type="file" id="cert_logo" name="cert_logo" onchange='Test.UpdatePreview(this,ImageIdtl)'/>
									</div>
									<div class="file-path-wrapper form-line"></div>
								</div>
								<div class="form-group form-float">
									<label class="form-label">Vendor Details Info</label>
									<div class="form-line">
										<textarea class="txtedt form-control" id="vendor_details" name="vendor_details"><?php echo $pickval[vendor_details]; ?></textarea>
									</div>
								</div>
								<div class="form-group form-float">
									<label class="form-label">Achievements</label>
									<div class="form-line">
										<textarea class="txtedt form-control" id="achievmnt" name="achievmnt"><?php echo $pickval[achievmnt]; ?></textarea>
									</div>
								</div>
								<div class="radio-button form-group form-float">
									<input id="radio_1" name="cert_sts" value="Regular" class="with-gap radio-col-orange" <?php if($pickval[cert_sts]==NULL || $pickval[cert_sts]=="Regular"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="radio_1">Regular</label>
									<input id="radio_2" name="cert_sts" value="Top" class="with-gap radio-col-red" <?php if($pickval[cert_sts]!=NULL && $pickval[cert_sts]=="Top"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="radio_2">Top</label> 
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
										<th ><strong>Vendor Name</strong></th>
										<th ><strong>Certification Title</strong></th>
										<th ><strong>Status</strong></th>
									</tr>
								</thead>
								<tbody>
									<?
									$sx_val=array(
										"sx_cod_cap"=>"sx_cod",
										"sx_pag_cap"=>"sx_pag",
										"sx_search_cap"=>"sx_srsval");
									if(isset($_GET['sx_srsval']) && $_GET['sx_srsval']!=null){
										$whr_cmd=" AND (vendor_name like '%".$_GET['sx_srsval']."%' 
										or cert_title like '%".$_GET['sx_srsval']."%')";
									}
									$sql_qry = "SELECT concat((LEFT(vendor_name , 30)),'...') as vendor_name, slno, 
												concat((LEFT(cert_title , 30)),'...') as cert_title, cert_sts
												FROM cert_info
												where sts = '1' ".$whr_cmd."
												ORDER BY slno DESC";
									$lstprv->srch_tbl($sql_qry,'slno',30,$sx_val);
									?>
								</tbody> 
							</table>
						</div>
					</div>
				</div>
			</div>