			<div class="row">
				<div class="col-md-6">
					<?php $pickval = $cmncls->newpikval('course_info','slno',$_GET['sx_cod']); ?>
					<form name="course_info" method="post" enctype="multipart/form-data">
						<div class="row card" style="min-height:10px; margin-bottom:10px;">
							<div class="body" align="center" style="padding:10px;" >
								<input class="btn btn-warning" name="dcourse_ad"  type="submit" id="dcourse_ad" value="Add" />
								<input class="btn btn-warning" name="dcourse_updt" type="submit" id="dcourse_updt" value="Update" />
								<input class="btn btn-warning" name="dcourse_dlt" type="submit" id="dcourse_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');" />
								<input class="btn btn-warning" name="dcourse_clr" type="button" id="dcourse_clr" onclick="parent.location='index.php?pg=<?php echo $_GET[pg]; ?>'" value="Clear" />
							</div>
						</div>
						<div class="row card">
							<div class="header">
								<center><h3>Course Details</h3></center>
							</div>
							<div class="body">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="hidden" id="slno" name="slno" value="<?php echo $pickval[slno]; ?>" />
										<input type="text" class="form-control" required  id="course_title" name="course_title" value="<?php echo $pickval[course_title]; ?>" />
										<label class="form-label">Course Title</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" id="course_cat" name="course_cat" value="<?php echo $pickval[course_cat]; ?>"/>
										<label class="form-label">Course Type</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="number" required class="form-control" id="course_fee" name="course_fee" value="<?php echo $pickval[course_fee]; ?>"/>
										<label class="form-label">Course Fees</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" required class="form-control datepicker" id="course_strdate" name="course_strdate" value="<?php echo $pickval[course_strdate]; ?>"/>
										<label class="form-label">Course Start Date</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="number" required class="form-control" id="course_duration" name="course_duration" value="<?php echo $pickval[course_duration]; ?>"/>
										<label class="form-label">Course Duration(Days)</label>
									</div>
								</div>
								<img class="imgpreviewl" src="<?php echo $pickval[course_bannerl]; ?>" id="ImageIdl"/>
								<div class="file-field input-field form-group">
									<div class="btn btn-warning">
										<span>Course Banner(landscape)</span>
										<input type="file" id="course_bannerl" name="course_bannerl" onchange='Test.UpdatePreview(this,ImageIdl)'/>
									</div>
									<div class="file-path-wrapper form-line"></div>
								</div>
								<img class="imgpreviewp" src="<?php echo $pickval[course_bannerp]; ?>" id="ImageIdp"/>
								<div class="file-field input-field form-group">
									<div class="btn btn-warning">
										<span>Course Banner(Portrait)</span>
										<input type="file" id="course_bannerp" name="course_bannerp" onchange='Test.UpdatePreview(this,ImageIdp)'/>
									</div>
									<div class="file-path-wrapper form-line"></div>
								</div>
								<div class="form-group form-float">
									<label class="form-label">Course Details</label>
									<textarea type="text" class="txtedt form-control" id="course_details" name="course_details"><?php echo $pickval[course_details]; ?></textarea>
								</div>
								<div class="radio-button form-group form-float">
									<input id="radio_1" name="course_type" value="Top" class="with-gap radio-col-orange" <?php if($pickval[course_type]==NULL || $pickval[course_type]=="Top"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="radio_1">Top</label>
									<input id="radio_2" name="course_type" value="Regular" class="with-gap radio-col-red" <?php if($pickval[course_type]!=NULL && $pickval[course_type]=="Regular"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="radio_2">Regular</label> 
									<input id="radio_3" name="course_type" value="Popular" class="with-gap radio-col-green" <?php if($pickval[course_type]!=NULL && $pickval[course_type]=="Popular"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="radio_3">Popular</label>
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
										<th ><strong>Type</strong></th>
										<th ><strong>Rate</strong></th>
									</tr>
								</thead>
								<tbody>
									<?
									$sx_val=array(
										"sx_cod_cap"=>"sx_cod",
										"sx_pag_cap"=>"sx_pag",
										"sx_search_cap"=>"sx_srsval");
									if(isset($_GET['sx_srsval']) && $_GET['sx_srsval']!=null){
										$whr_cmd=" AND (course_title like '%".$_GET['sx_srsval']."%' 
										or course_details like '%".$_GET['sx_srsval']."%')";
									}
									$sql_qry = "SELECT concat((LEFT(course_title , 20)),'...') as course_title, slno, course_cat, course_type
										FROM course_info
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