					<?php
					unset($_SESSION['item_code']);
					?>
					<script src="assets/plugins/jQuery-Scanner-Detection-master/jquery.scannerdetection.js"></script>
					<div class="row">
						<div class="col-md-12">
							<form name="dcompny_info" method="post" enctype="multipart/form-data">
								<div class="row card">
									<div class="header">
										<center><h3>Production Plan</h3></center>
									</div>
									<div class="body">
										<div class="col-md-4">
											<div class="form-group form-float">
												<div class="input-group">
													<label class="form-label">Target Item/Product</label>
													<input type="hidden" placeholder="Code (Auto Generate)" class="form-control" readonly="readonly" name="plan_code" id="plan_code" value="<? echo $pickval['plan_code']; ?>" />
													<select style="width:100%;" required class="form-control select2auto" ppg="s2search" name="targt_item">
														
													</select>
												</div>
											</div>
											<div class="form-group form-float">
												<div class="form-line">
													<input type="number" step="0.5" required class="form-control" name="targt_qty" id="targt_qty" value="">
													<label  class="form-label">Target Quantity</label>
												</div>
											</div>
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control datepicker" name="trn_date" id="trn_date" required="required" value="<? echo date('Y-m-d'); ?>">
													<label  class="form-label">Date</label>
												</div>
											</div>
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" name="trn_ref" id="trn_ref" value="<? echo $pickval[trn_ref]; ?>">
													<label  class="form-label">Ref. Note</label>
												</div>
											</div>
											<div class="form-group form-float">
												<div class="form-line">
													<input type="hidden" name="ppg" value="<? echo $_GET[pg]; ?>" />
													<textarea name="trn_description" class="form-control" id="trn_description" rows="2"><? echo $pickval[trn_description]; ?></textarea>
													<label  class="form-label">Description</label>
												</div>
											</div>
											<div class="form-group form-float">
												<button type="submit" id="add_trn" name="add_trn" class="btn btn-success waves-effect">
													<i class="material-icons">save</i> Save
												</button>
												<a type="button" id="new_sale" name="new_sale" href="?pg=prdc_plan_list" class="btn btn-default waves-effect">
													<i class="material-icons">list</i> Plan List
												</a>
											</div>
										</div>
										<div class="col-md-8">
											<h5>
												Add Products
											</h5>
											<div>
												<div class="col-sm-6">
													<div class="form-group form-float">
														<div class="input-group">
															<select style="width:100%;" class="form-control select2auto" ppg="s2search" id="item_code" name="item_code"></select>
														</div>
													</div>
												</div>
												<div class="col-sm-2">
													<div class="form-group form-float">
														<div class="form-line">
															<input type="number" class="form-control" id="item_qty">
															<label class="form-label">Quantity </label>
														</div>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group form-float">
														<div class="form-line">
															<input type="text" class="form-control" id="item_brate"/>
															<label class="form-label">Price</label>
														</div>
													</div>
												</div>
												<div class="col-sm-1">
													<div class="form-group form-float">
														<div class="form">
															<button type="button" id="add_row" data="add_data" class="btn btn-success waves-effect">
																<i class="material-icons">add_box</i>
															</button>
														</div>
													</div>
												</div>
											</div>
											<table class="table table-striped" id="product_table">
												<thead>
													<tr>
														<th>Product Name</th>
														<th>Quantity</th>
														<th>Unit</th>
														<th>Rate</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php 
													if(isset($issueitem_info) && $issueitem_info!=NULL){
														echo $issueitem_info;
													}
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</form>	
						</div>
					</div>
					<div id="rsp_div"></div>
					<script type="text/javascript">
						jQuery(document).ready(function($) {
							$(window).scannerDetection();
							$(window).bind('scannerDetectionComplete',function(e,data){
								var item_code=data.string;
								var post_data='post_method=ajax'+'&ppg='+'<?php echo $_GET[pg]; ?>'+'&ac_method=addFromScan'+'&item_code='+item_code;
								$.ajax({
									type: 'POST',
									url: 'index.php',
									data: post_data,
									dataType: 'json',
									success: function (data) {
										$( "#item_qty" ).val('');
										$( "#item_brate" ).val('');
										$( "#product_table tbody").append(data.rtndata);
									}
								});
							});
							$( "#add_row" ).click(function() {
								var tbody_data;
								var rtn_html;
								var item_code=$( "#item_code" ).val();
								var item_qty=$( "#item_qty" ).val();
								var item_brate=$( "#item_brate" ).val();
								if(item_code && $.isNumeric(item_qty)){
									var post_data='post_method=ajax'+'&ppg='+<?php echo "'".$_GET[pg]."'"; ?>
									+'&ac_method=addFromScan'+'&item_code='+item_code;
									$.ajax({
										type: 'POST',
										url: 'index.php',
										data: {	post_method:'ajax', 
												ppg:<?php echo "'".$_GET['pg']."'"; ?>,
												ac_method:$(this).attr('data'),
												item_code:item_code,
												item_qty:item_qty,
												item_brate:item_brate
										},
										dataType: 'json',
										success: function (data) {
											$( "#item_qty" ).val('');
											$( "#item_brate" ).val('');
											$( "#product_table tbody").append(data.rtndata);
										}
									});
								}else{
									swal({
										title:'Please input valid data!',
										type: 'warning',
										timer: 1500,
										showConfirmButton: true
									});
								}
							});
							$('#product_table').delegate('.delete_row','click',function(){
								var ac_method=$(this).attr('data');
								var target_tr=$(this).parent().parent();
								var item_code=target_tr.find(".item_code").val();
								//alert(item_code);
								$.ajax({
									type: 'POST',
									url: 'index.php',
									data: {post_method:'ajax', 
										ppg:<?php echo "'".$_GET[pg]."'"; ?>,
										ac_method:ac_method,
										item_code:item_code
									},
									dataType: 'json',
									success: function (data) {
										target_tr.fadeOut(500, function(){ $(this).remove(); });
										swal({
											title:'Deleted!',
											type: 'success',
											timer: 1000,
											showConfirmButton: false
										});
									}
								});
							});
						});
					</script>