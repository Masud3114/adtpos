			<div class="row">
				<div class="col-md-6">
					<?php $pickval = $cmncls->newpikval('sptraining_info','slno',$_GET['sx_cod']); ?>
					<form name="sptraining_info" method="post" enctype="multipart/form-data">
						<div class="row card" style="min-height:10px; margin-bottom:10px;">
							<div class="body" align="center" style="padding:10px;" >
								<input class="btn btn-warning" name="dsptraining_ad"  type="submit" id="dsptraining_ad" value="Add" />
								<input class="btn btn-warning" name="dsptraining_updt" type="submit" id="dsptraining_updt" value="Update" />
								<input class="btn btn-warning" name="dsptraining_dlt" type="submit" id="dsptraining_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');" />
								<input class="btn btn-warning" name="dsptraining_clr" type="button" id="dsptraining_clr" onclick="parent.location='index.php?pg=<?php echo $_GET[pg]; ?>'" value="Clear" />
							</div>
						</div>
						<div class="row card">
							<div class="header">
								<center><h3>Specialized Training</h3></center>
							</div>
							<div class="body">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="hidden" id="slno" name="slno" value="<?php echo $pickval[slno]; ?>" />
										<input type="text" class="form-control" required="required"  id="training_title" name="training_title" value="<?php echo $pickval[training_title]; ?>" />
										<label class="form-label">Title</label>
									</div>
								</div>
								<div class="form-group form-float">
									<p>
										<b>Type</b>
									</p>
									<select name="training_type" required class="form-control show-tick">
										<option	value="">--Select Type of Training--</option>
										<option	<? if ($pickval['training_type'] == 'Corporate') {?> selected="selected" <? }?> value="Corporate">Corporate Training</option>
										<option	<? if ($pickval['training_type'] == 'Industrial') {?> selected="selected" <? }?> value="Industrial">Industrial Training</option>
										<option	<? if ($pickval['training_type'] == 'GovernmentSector') {?> selected="selected" <? }?> value="GovernmentSector">Government Sector Training</option>
										<option	<? if ($pickval['training_type'] == 'Organizational') {?> selected="selected" <? }?> value="Organizational">Organizational Training</option>
									</select>
								</div>
								<img class="imgpreviewl" src="<?php echo $pickval[training_banner]; ?>" id="ImageId"/>
								<div class="file-field input-field form-group">
									<div class="btn btn-warning">
										<span>Banner</span>
										<input type="file" id="training_banner" name="training_banner" onchange='Test.UpdatePreview(this,ImageId)'/>
									</div>
									<div class="file-path-wrapper form-line"></div>
								</div>
								<div class="form-group form-float">
									<label class="form-label">Training Details</label>
									<textarea type="text" class="txtedt form-control" id="training_details" name="training_details"><?php echo $pickval[training_details]; ?></textarea>
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
										$whr_cmd=" AND (training_title like '%".$_GET['sx_srsval']."%' 
										or training_details like '%".$_GET['sx_srsval']."%')";
									}
									$sql_qry = "SELECT training_title, slno
										FROM sptraining_info
										where sts = '1' ".$whr_cmd."";
									$lstprv->srch_tbl($sql_qry,'slno',30,$sx_val);
									?>
								</tbody> 
							</table>
						</div>
					</div>
				</div>
			</div>