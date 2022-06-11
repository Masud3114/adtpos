			<div class="row">
				<div class="col-md-6">
					<?php $pickval = $cmncls->newpikval('team_info','slno',$_GET['sx_cod']); ?>
					<form name="team_info" method="post" enctype="multipart/form-data">
						<div class="row card" style="min-height:10px; margin-bottom:10px;">
							<div class="body" align="center" style="padding:10px;" >
								<input class="btn btn-warning" name="dteam_ad"  type="submit" id="dteam_ad" value="Add" />
								<input class="btn btn-warning" name="dteam_updt" type="submit" id="dteam_updt" value="Update" />
								<input class="btn btn-warning" name="dteam_dlt" type="submit" id="dteam_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');" />
								<input class="btn btn-warning" name="dteam_clr" type="button" id="dteam_clr" onclick="parent.location='index.php?pg=<?php echo $_GET[pg]; ?>'" value="Clear" />
							</div>
						</div>
						<div class="row card">
							<div class="header">
								<center><h3>About Team</h3></center>
							</div>
							<div class="body">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="hidden" id="slno" name="slno" value="<?php echo $pickval[slno]; ?>" />
										<input type="text" class="form-control" id="member_name" name="member_name" value="<?php echo $pickval[member_name]; ?>"/>
										<label class="form-label">Member Name</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" id="member_desig" name="member_desig" value="<?php echo $pickval[member_desig]; ?>"/>
										<label class="form-label">Designation</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" id="member_celno" name="member_celno" value="<?php echo $pickval[member_celno]; ?>"/>
										<label class="form-label">Contact #</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" id="member_email" name="member_email" value="<?php echo $pickval[member_email]; ?>"/>
										<label class="form-label">E-Mail</label>
									</div>
								</div>
								<img class="imgpreviewp" src="<?php echo $pickval[member_photo]; ?>" id="ImageId"/>
								<div class="file-field input-field form-group">
									<div class="btn btn-warning">
										<span>Photo</span>
										<input type="file" id="member_photo" name="member_photo" onchange='Test.UpdatePreview(this,ImageId)'/>
									</div>
									<div class="file-path-wrapper form-line"></div>
								</div>
								<div class="form-group form-float">
									<label class="form-label">About Member</label>
									<textarea class="txtedt form-control" id="member_details" name="member_details"><?php echo $pickval[member_details]; ?></textarea>
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
								<div class="form-group form-float">
									<div class="form-line">
										<input type="number" class="form-control" id="priority_no" name="priority_no" value="<?php echo $pickval[priority_no]; ?>"/>
										<label class="form-label">Priority No</label>
									</div>
								</div>
								<div class="radio-button form-group form-float">
									<input id="radio_1" name="member_sts" value="Active" class="with-gap radio-col-orange" <?php if($pickval[member_sts]==NULL || $pickval[member_sts]=="Active"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="radio_1">Active</label>
									<input id="radio_2" name="member_sts" value="De-active" class="with-gap radio-col-red" <?php if($pickval[member_sts]!=NULL && $pickval[member_sts]=="De-active"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="radio_2">De-active</label> 
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
										<th ><strong>Name</strong></th>
										<th ><strong>Designation</strong></th>
										<th ><strong>E-Mail</strong></th>
									</tr>
								</thead>
								<tbody>
									<?
									$sx_val=array(
										"sx_cod_cap"=>"sx_cod",
										"sx_pag_cap"=>"sx_pag",
										"sx_search_cap"=>"sx_srsval");
									if(isset($_GET['sx_srsval']) && $_GET['sx_srsval']!=null){
										$whr_cmd=" AND (member_name like '%".$_GET['sx_srsval']."%' 
										or member_email like '%".$_GET['sx_srsval']."%')";
									}
									$sql_qry = "SELECT member_name, slno, member_desig,
												member_email
												FROM team_info
												where sts = '1' ".$whr_cmd."
												ORDER BY priority_no ASC";
									$lstprv->srch_tbl($sql_qry,'slno',30,$sx_val);
									?>
								</tbody> 
							</table>
						</div>
					</div>
				</div>
			</div>