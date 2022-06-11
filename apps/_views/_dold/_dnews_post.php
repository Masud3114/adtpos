			<div class="row">
				<div class="col-md-6">
					<?php $pickval = $cmncls->newpikval('news_info','slno',$_GET['sx_cod']); ?>
					<form name="news_info" method="post" enctype="multipart/form-data">
						<div class="row card" style="min-height:10px; margin-bottom:10px;">
							<div class="body" align="center" style="padding:10px;" >
								<input class="btn btn-warning" name="dnews_ad"  type="submit" id="dnews_ad" value="Add" />
								<input class="btn btn-warning" name="dnews_updt" type="submit" id="dnews_updt" value="Update" />
								<input class="btn btn-warning" name="dnews_dlt" type="submit" id="dnews_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');" />
								<input class="btn btn-warning" name="dnews_clr" type="button" id="dnews_clr" onclick="parent.location='index.php?pg=<?php echo $_GET[pg]; ?>'" value="Clear" />
							</div>
						</div>
						<div class="row card">
							<div class="header">
								<center><h3>News Details</h3></center>
							</div>
							<div class="body">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="hidden" id="slno" name="slno" value="<?php echo $pickval[slno]; ?>" />
										<input type="text" class="form-control" required="required"  id="news_headline" name="news_headline" value="<?php echo $pickval[news_headline]; ?>" />
										<label class="form-label">News Head</label>
									</div>
								</div>
								<img class="imgpreviewl" src="<?php echo $pickval[news_banner]; ?>" id="ImageId"/>
								<div class="file-field input-field form-group">
									<div class="btn btn-warning">
										<span>News Banner</span>
										<input type="file" id="news_banner" name="news_banner" onchange='Test.UpdatePreview(this,ImageId)'/>
									</div>
									<div class="file-path-wrapper form-line"></div>
								</div>
								<div class="form-group form-float" align="left">
									<div class="form-line">
										<label class="form-label"> Post date</label>
										<input type="text" class="form-control datepicker" required="required"  id="news_date" name="news_date" value="<?php echo $pickval[news_date]; ?>"/>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" id="news_cat" name="news_cat" value="<?php echo $pickval[news_cat]; ?>"/>
										<label class="form-label">News Category</label>
									</div>
								</div>
								<div class="form-group form-float">
									<label class="form-label">News Details</label>
									<textarea type="text" class="txtedt form-control" id="news_details" name="news_details"><?php echo $pickval[news_details]; ?></textarea>
								</div>
								<div class="radio-button form-group form-float">
									<input id="radio_1" name="news_type" value="Top" class="with-gap radio-col-orange" <?php if($pickval[news_type]==NULL || $pickval[news_type]=="Top"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="radio_1">Top</label>
									<input id="radio_2" name="news_type" value="Regular" class="with-gap radio-col-red" <?php if($pickval[news_type]!=NULL && $pickval[news_type]=="Regular"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="radio_2">Regular</label> 
									<input id="radio_3" name="news_type" value="Most Rated" class="with-gap radio-col-green" <?php if($pickval[news_type]!=NULL && $pickval[news_type]=="Most Rated"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="radio_3">Most Rated</label>
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
										<th ><strong>News Head</strong></th>
										<th ><strong>Category</strong></th>
										<th ><strong>Date</strong></th>
										<th ><strong>Type</strong></th>
									</tr>
								</thead>
								<tbody>
									<?
									$sx_val=array(
										"sx_cod_cap"=>"sx_cod",
										"sx_pag_cap"=>"sx_pag",
										"sx_search_cap"=>"sx_srsval");
									if(isset($_GET['sx_srsval']) && $_GET['sx_srsval']!=null){
										$whr_cmd=" AND (news_headline like '%".$_GET['sx_srsval']."%' 
										or news_details like '%".$_GET['sx_srsval']."%')";
									}
									$sql_qry = "SELECT concat((LEFT(news_headline , 20)),'...') as news_headline, slno, news_cat, news_date,news_type
										FROM news_info
										where sts = '1' ".$whr_cmd."
										ORDER BY news_date DESC";
									$lstprv->srch_tbl($sql_qry,'slno',30,$sx_val);
									?>
								</tbody> 
							</table>
						</div>
					</div>
				</div>
			</div>