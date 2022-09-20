			<!-- Bootstrap
			<link href="plugins/select2/theme/material.css" rel="stylesheet">
			<link href="plugins/select2/css/select2.min.css" rel="stylesheet">
			-->
			<link href="assets/plugins/dropzone/min/dropzone.min.css" rel="stylesheet">
			<div class="row">
				<div class="col-md-6">
					<?php
					$sx_code=$action->escap_string($_GET['sx_cod']);
					$pick_sql="select item_info.slno, item_info.item_name, item_info.item_model,
					item_info.bar_cod, item_info.item_color,item_info.item_size,
					item_info.item_brate, item_info.item_srate, item_info.item_discount, item_info.item_vatrate, 
					item_info.item_taxrate, item_info.ditem_altcod, item_info.item_details, 
					item_info.stock_type, item_info.stock_sts, item_info.sts,
					vistore_info.slno as item_store,vistore_info.pram_name as item_storec,
					vicat_info.slno as item_cat,vicat_info.pram_name as item_catc,
					vitype_info.slno as item_type,vitype_info.pram_name as item_typec,
					vibrand_info.slno as item_brand,vibrand_info.pram_name as item_brandc,
					viunit_info.slno as item_unit,viunit_info.pram_name as item_unitc,
					visize_info.slno as item_size,visize_info.pram_name as item_sizec
					from item_info
					left join vistore_info on item_info.item_store=vistore_info.slno
					left join vicat_info on item_info.item_cat=vicat_info.slno
					left join vitype_info on item_info.item_type=vitype_info.slno
					left join vibrand_info on item_info.item_brand=vibrand_info.slno
					left join vicolor_info on item_info.item_color=vicolor_info.slno
					left join viunit_info on item_info.item_unit=viunit_info.slno
					left join visize_info on item_info.item_size=visize_info.slno
					where item_info.slno='".$sx_code."'
					";
					//echo $pick_sql;
					$pickval = $cmncls->newpikval('','','',$pick_sql); 
					?>
					<form name="store_info" method="post" enctype="multipart/form-data">
						<div class="row card" style="min-height:10px; margin-bottom:10px;">
							<div class="body" align="center" style="padding:10px;" >
								<input class="btn btn-warning" name="ditem_ad"  type="submit" id="ditem_ad" value="Add" />
								<input class="btn btn-warning" name="ditem_updt" type="submit" id="ditem_updt" value="Update" />
								<input class="btn btn-warning" name="ditem_dlt" type="submit" id="ditem_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');" />
								<input class="btn btn-warning" name="ditem_clr" type="button" id="ditem_clr" onclick="parent.location='?pg=<?php echo $_GET[pg]; ?>'" value="Clear" />
							</div>
						</div>
						<div class="row card">
							<div class="header">
								<center>
									<h3>
										Product Details
										<?php
										if(isset($pickval[slno])){ ?>
											<a href="#" data-toggle="modal" data-target="#imageUpModal" data-color="grey"><i class="material-icons">attach_file</i>Images</a>
										<?php
										} ?>
									</h3>
								</center>
							</div>
							<div class="body">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="hidden" id="slno" name="slno" value="<?php echo $pickval[slno]; ?>" />
										<input type="hidden" name="ppg" value="<?php echo $_GET['pg']; ?>" />
										<input type="text" class="form-control" autofocus id="item_name" name="item_name" value="<?php echo $pickval[item_name]; ?>" />
										<label class="form-label">Product Name</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="item_model" id="item_model" value="<? echo $pickval[item_model]; ?>">
										<label  class="form-label">Model</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="bar_cod" id="bar_cod" value="<? echo $pickval[bar_cod]; ?>">
										<label  class="form-label">Bar-code</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="input-group">
										<label class="form-label">Store</label>
										<select style="width:100%;" class="form-control select2auto" ppg="s2search" name="item_store">
											<?php echo $pickval[item_store]? ' <option value="'.$pickval[item_store].'" selected="selected">'.$pickval[item_storec].'</option>': ''; ?>
										</select>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="input-group">
										<label class="form-label">Brand</label>
										<select required style="width:100%;" class="form-control select2auto" ppg="s2search" name="item_brand">
											<?php echo $pickval[item_brand]? ' <option value="'.$pickval[item_brand].'" selected="selected">'.$pickval[item_brandc].'</option>': ''; ?>
										</select>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="input-group">
										<label class="form-label">Product Category</label>
										<select required style="width:100%;" class="form-control select2auto" ppg="s2search" name="item_cat">
											<?php echo $pickval[item_cat]? ' <option value="'.$pickval[item_cat].'" selected="selected">'.$pickval[item_catc].'</option>': ''; ?>
										</select>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="input-group">
										<label class="form-label">Product Type</label>
										<select required style="width:100%;" class="form-control select2auto" ppg="s2search" name="item_type">
											<?php echo $pickval[item_type]? ' <option value="'.$pickval[item_type].'" selected="selected">'.$pickval[item_typec].'</option>': ''; ?>
										</select>
									</div>
								</div>
								<div class="input-group input-group-lg">
									<div class="form-line">
										<label class="form-label">Color</label>
										<select required style="width:100%;" class="form-control select2auto" multiple="multiple" ppg="s2search" name="item_color[]">
											<?php 
												if($pickval['item_color']){
													$color=explode(',',$pickval['item_color']);
													$item_color="'".implode("','",$color)."'";
													$color_qry=$cmncls->sqlqry("select * from vicolor_info where slno in (".$item_color.") order by slno");
													while($data=@mysql_fetch_array($color_qry)){
														echo '<option value="'.$data['slno'].'" selected="selected">'.$data['pram_name'].'</option>'; 
													}
												}
											?>
										</select>
									</div>
									<span class="input-group-addon">
										<input type="checkbox" name="color_extract" value="1" class="filled-in" id="color_extract">
										<label for="color_extract">Extract</label>
									</span>
								</div>
								<div class="form-group form-float">
									<div class="input-group">
										<label class="form-label">Size</label>
										<select required style="width:100%;" class="form-control select2auto" ppg="s2search" name="item_size">
											<?php echo $pickval['item_size']? ' <option value="'.$pickval['item_size'].'" selected="selected">'.$pickval['item_sizec'].'</option>': ''; ?>
										</select>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="input-group">
										<label class="form-label">Unit</label>
										<select style="width:100%;" class="form-control select2auto" ppg="s2search" name="item_unit">
											<?php echo $pickval[item_unit]? ' <option value="'.$pickval[item_unit].'" selected="selected">'.$pickval[item_unitc].'</option>': ''; ?>
										</select>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="number" class="form-control" name="item_brate" id="item_brate" value="<? echo $pickval[item_brate]; ?>">
										<label  class="form-label">Buy Rate</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="number" class="form-control" name="item_srate" id="item_srate" value="<? echo $pickval[item_srate]; ?>">
										<label  class="form-label">Sale Rate</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="number" class="form-control" name="item_vatrate" id="item_vatrate" value="<? echo $pickval[item_vatrate]; ?>">
										<label  class="form-label">VAT Rate (%)</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="number" class="form-control" name="item_discount" id="item_discount" value="<? echo $pickval[item_discount]; ?>">
										<label  class="form-label">Discount Rate (%)</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="number" class="form-control" name="item_taxrate" id="item_taxrate" value="<? echo $pickval[item_taxrate]; ?>">
										<label  class="form-label">TAX Rate(%)</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="ditem_altcod" id="ditem_altcod" value="<? echo $pickval[ditem_altcod]; ?>">
										<label  class="form-label">Alternate Code</label>
									</div>
								</div>
								<div class="form-group form-float">
									<label  class="form-label">Product Details</label>
									<div class="form-line">
										<textarea name="item_details" class="form-control txtedt" id="item_details" cols="45"  rows="3"><? echo $pickval[item_details]; ?></textarea>
									</div>
								</div>
								<div class="form-group form-float">
									<input id="radio_1" name="stock_type" value="stockable" class="with-gap radio-col-red" <?php if($pickval[stock_type]==NULL || $pickval[stock_type]=="stockable"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="radio_1">Stock able</label> 
									<input id="radio_2" name="stock_type" value="nonstock"  class="with-gap radio-col-pink" <?php if($pickval[stock_type]!=NULL && $pickval[stock_type]=="nonstock"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="radio_2">Non-Stock</label>
									<input id="radio_3" name="stock_type" value="service" class="with-gap radio-col-purple" <?php if($pickval[stock_type]!=NULL && $pickval[stock_type]=="service"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="radio_3">Service</label>
								</div>
								<div class="form-group form-float">
									<input id="stock_sts1" name="stock_sts" value="available" class="with-gap radio-col-green" <?php if($pickval[stock_sts]==NULL || $pickval[stock_sts]=="available"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="stock_sts1">Available</label> 
									<input id="stock_sts2" name="stock_sts" value="unavailable"  class="with-gap radio-col-red" <?php if($pickval[stock_sts]!=NULL && $pickval[stock_sts]=="unavailable"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="stock_sts2">Un-Available</label>
								</div>
								<div class="radio-button form-group form-float">
									<input id="radio_4" name="sts" value="1" class="with-gap radio-col-red" <?php if($pickval[sts]==NULL || $pickval[sts]=="1"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="radio_4">Active</label> 
									<input id="radio_5" name="sts" value="2" class="with-gap radio-col-green" <?php if($pickval[sts]!=NULL && $pickval[sts]=="2"){ ?>checked="checked"<?php } ?> type="radio">
									<label for="radio_5">Inactive</label>
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
							<table class="table table-striped table-hover dataTable" data="item_info">
								<thead>
									<tr>
										<th ><strong>Product Name</strong></th>
										<th ><strong>Model</strong></th>
										<th ><strong>Price</strong></th>
										<th ><strong>Bar-Code</strong></th>
										<th ><strong>#</strong></th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th ><strong>Product Name</strong></th>
										<th ><strong>Model</strong></th>
										<th ><strong>Price</strong></th>
										<th ><strong>Bar-Code</strong></th>
										<th ><strong>#</strong></th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!--Image Upload Section-->
			<div class="modal fade" id="imageUpModal" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Upload Images</h4>
						</div>
						<div class="modal-body">
							<form action="index.php" id="frmFileUpload" class="dropzone" method="POST" enctype="multipart/form-data">
								<div class="dz-message">
									<div class="drag-icon-cph">
										<i class="material-icons">touch_app</i>
									</div>
									<h3>Drop files here or click to upload.</h3>
									<em>( Upload only images file like .jpg, .png, .gif etc )</em>
								</div>
								<div class="fallback">
									<input name="file[]" type="file" multiple="multiple" />
								</div>
								<input type="hidden" id="slno" name="slno" value="<?php echo $pickval[slno]; ?>" />
								<input type="hidden" name="ppg" value="<?php echo $_GET['pg']; ?>" />
							</form>
						</div>
						<div class="modal-footer">
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Bootstrap colorpicker Js -->
			<script src="assets/plugins/dropzone/min/dropzone.min.js"></script>
			<script src="assets/plugins/jQuery-Scanner-Detection-master/jquery.scannerdetection.js"></script>
			<script type="text/javascript">
				$(function () {
					$(window).scannerDetection();
					$(window).bind('scannerDetectionComplete',function(e,data){
						var barcode=data.string;
						$('#bar_cod').val(barcode);
					});
					//Dropzone
					Dropzone.options.frmFileUpload = {
						uploadMultiple: true,
						acceptedFiles:'image/*',
						parallelUploads: 100,
						maxFiles: 100
					};
				});
			</script>