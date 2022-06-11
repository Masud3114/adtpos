					<?php
					unset($_SESSION['item_code']);
					unset($_SESSION['purchase_slno']);
					if(isset($_GET['sx_code'])){
						$sx_sql="SELECT t1.slno, t1.trn_from, dsup_info.dsup_num,
						t1.trn_ref,t1.trn_desc, t1.trn_disc,t1.trn_date, 
						t1.trn_vat, t1.trn_netamount, t1.trn_ptype, t1.trn_rcvamount 
						FROM inop_header t1 
						LEFT JOIN dsup_info ON t1.trn_from=dsup_info.dsup_cod 
						WHERE t1.trn_cat=4 AND t1.slno='".@mysql_real_escape_string($_GET['sx_code'])."'";
						$header_data=$cmncls->newpikval(null,null,null,$sx_sql);
						$_SESSION['purchase_slno']=$header_data['slno'];
					}
					?>
					<script src="assets/plugins/jQuery-Scanner-Detection-master/jquery.scannerdetection.js"></script>
					<div class="row">
						<div class="col-md-12">
							<form name="dcompny_info" method="post" enctype="multipart/form-data">
								<div class="row card">
									<div class="header">
										<center><h3>Purchase Entry</h3></center>
									</div>
									<div class="body">
										<div class="col-md-4">
											<div class="form-group form-float">
												<div class="input-group">
													<label class="form-label">Receive From</label>
													<input type="hidden" placeholder="Code (Auto Generate)" class="form-control" readonly="readonly" name="receive_code" id="receive_code" value="<? echo $pickval['receive_code']; ?>" />
													<select style="width:100%;" required class="form-control select2auto" ppg="s2search" name="dsup_cod">
														<?php
														if(isset($header_data['trn_from'])){
															echo '<option value="'.$header_data['trn_from'].'" selected="selected">'.$header_data['trn_from']."-".$header_data['dsup_num'].'</option>';
														}
														?>
													</select>
												</div>
											</div>
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control datepicker" name="trn_date" id="trn_date" required="required" value="<?php echo isset($header_data['trn_date'])?$header_data['trn_date']:date('Y-m-d'); ?>">
													<label  class="form-label">Receive Date</label>
												</div>
											</div>
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" name="trn_ref" id="trn_ref" value="<?php echo isset($header_data['trn_ref'])?$header_data['trn_ref']:''; ?>">
													<label  class="form-label">Ref. Note</label>
												</div>
											</div>
											<div class="form-group form-float">
												<div class="form-line">
													<input type="hidden" name="ppg" value="<? echo $_GET[pg]; ?>" />
													<textarea name="trn_description" class="form-control" id="trn_description" rows="2"><?php echo isset($header_data['trn_desc'])?$header_data['trn_desc']:''; ?></textarea>
													<label  class="form-label">Description</label>
												</div>
											</div>
											<div class="form-group form-float">
												<button type="submit" id="add_trn" name="add_trn" class="btn btn-success waves-effect">
													<i class="material-icons">save</i> Save
												</button>
												<button type="button" id="new_sale" name="new_sale" onclick="parent.location='index.php?pg=<?php echo $_GET['pg']; ?>'" class="btn btn-default waves-effect">
													<i class="material-icons">autorenew</i> New
												</button>
												<a href="?pg=purchase_list" title="Back" class="btn bg-blue waves-effect">
													<i class="material-icons">arrow_back</i> Back
												</a>
											</div>
										</div>
										<div class="col-md-8">
											<h5>
												Add Products
											</h5>
											<div>
												<div class="col-sm-5">
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
												<div class="col-sm-2">
													<div class="form-group form-float">
														<div class="form-line">
															<input type="text" class="form-control" id="item_brate"/>
															<label class="form-label">Buy Price</label>
														</div>
													</div>
												</div>
												<div class="col-sm-2">
													<div class="form-group form-float">
														<div class="form-line">
															<input type="text" class="form-control" id="item_srate"/>
															<label class="form-label">Sales Price</label>
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
											<div class="table table-responsive pos_product_div">
												<table class="table table-striped" id="product_table">
													<thead>
														<tr>
															<th>Product Name</th>
															<th>Quantity</th>
															<th>Unit</th>
															<th>Buy Rate</th>
															<th>Sales Rate</th>
															<th>Action</th>
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
								</div>
							</form>	
						</div>
					</div>
					<div id="rsp_div"></div>
					<script type="text/javascript">
						jQuery(document).ready(function($) {
							let searchParams = new URLSearchParams(window.location.search)
							$( window ).load(function() {
								if(searchParams.has('sx_code')){
									let param = searchParams.get('sx_code');
									$.ajax({
										type: 'POST',
										url: './',
										data: {
											ppg:searchParams.get('pg'),
											sx_code:param,
											ac_method:'rtrive'
										},
										dataType: 'json',
										success: function (data) {
											if(data.rtndata){
												$( "#product_table tbody").append(data.rtndata);
											}
										}
									});
								}
							});
							
							$(window).scannerDetection();
							$(window).bind('scannerDetectionComplete',function(e,data){
								var item_code=data.string;
								$.ajax({
									type: 'POST',
									url: 'index.php',
									data: {
										ppg:searchParams.get('pg'),
										ac_method:'addFromScan',
										item_code:item_code
									},
									dataType: 'json',
									success: function (data) {
										$( "#item_qty" ).val('');
										$( "#item_brate" ).val('');
										$( "#item_srate" ).val('');
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
								var item_srate=$( "#item_srate" ).val();
								if(item_code && $.isNumeric(item_qty)){
									$.ajax({
										type: 'POST',
										url: 'index.php',
										data: {
												ppg:searchParams.get('pg'),
												ac_method:$(this).attr('data'),
												item_code:item_code,
												item_qty:item_qty,
												item_brate:item_brate,
												item_srate:item_srate
										},
										dataType: 'json',
										success: function (data) {
											$( "#item_qty" ).val('');
											$( "#item_brate" ).val('');
											$( "#item_srate" ).val('');
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