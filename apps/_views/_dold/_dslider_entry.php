			<div class="row">
				<div class="col-md-6">
					<?php $pickval = $cmncls->newpikval('slider_info','slno',$_GET['sx_cod']); ?>
					<form name="slider_info" method="post" enctype="multipart/form-data">
						<div class="row card" style="min-height:10px; margin-bottom:10px;">
							<div class="body" align="center" style="padding:10px;" >
								<input class="btn btn-warning" name="dslider_ad"  type="submit" id="dslider_ad" value="Add" />
								<input class="btn btn-warning" name="dslider_updt" type="submit" id="dslider_updt" value="Update" />
								<input class="btn btn-warning" name="dslider_dlt" type="submit" id="dslider_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');" />
								<input class="btn btn-warning" name="dslider_clr" type="button" id="dslider_clr" onclick="parent.location='index.php?pg=<?php echo $_GET[pg]; ?>'" value="Clear" />
							</div>
						</div>
						<div class="row card">
							<div class="header">
								<center><h3>Slider Details</h3></center>
							</div>
							<div class="body">
								<img class="imgpreviewl" src="<?php echo $pickval[slider_banner]; ?>" id="ImageId"/>
								<div class="file-field input-field form-group">
									<input type="hidden" id="slno" name="slno" value="<?php echo $pickval[slno]; ?>" />
									<div class="btn btn-warning">
										<span>Slider Banner</span>
										<input type="file" id="slider_banner" name="slider_banner" onchange='Test.UpdatePreview(this,ImageId)'/>
									</div>
									<div class="file-path-wrapper form-line"></div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" id="main_content" name="main_content" value="<?php echo $pickval[main_content]; ?>"/>
										<label class="form-label">Main Content</label>
									</div>
								</div>
								<div class="form-group form-float">
									<label class="form-label">Detail Content</label>
									<textarea class="txtedt form-control" id="detail_content" name="detail_content"><?php echo $pickval[detail_content]; ?></textarea>
								</div>
								<div class="radio-button form-group form-float">
									<input id="radio_1" name="slider_sts" value="Active" class="with-gap radio-col-orange" <?php if($pickval[slider_sts]==NULL || $pickval[slider_sts]=="Active"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="radio_1">Active</label>
									<input id="radio_2" name="slider_sts" value="De-active" class="with-gap radio-col-red" <?php if($pickval[slider_sts]!=NULL && $pickval[slider_sts]=="De-active"){ ?>checked="checked"<?php } ?> type="radio">
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
										<th ><strong>Main Content</strong></th>
										<th ><strong>Details Content</strong></th>
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
										$whr_cmd=" AND (main_content like '%".$_GET['sx_srsval']."%' 
										or detail_content like '%".$_GET['sx_srsval']."%')";
									}
									$sql_qry = "SELECT concat((LEFT(main_content , 20)),'...') as course_title, slno, 
												concat((LEFT(detail_content , 20)),'...') as detail_content, slider_sts
												FROM slider_info
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