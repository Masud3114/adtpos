					<?php
					unset($_SESSION['item_code']);
					unset($_SESSION['item_row']);
					unset($_SESSION['corp_slno']);
					if(isset($_GET['sx_code'])){
						$sx_sql="SELECT t1.slno, t1.trn_to, dcus_info.dcus_num, 
						t1.trn_mobile_no,t1.trn_amount, t1.trn_disc,t1.trn_date,
						t1.trn_vat, t1.trn_netamount, t1.trn_ptype, 
						t1.trn_rcvamount
						FROM 
						inop_header t1
						LEFT JOIN dcus_info ON t1.trn_to=dcus_info.dcus_cod
						WHERE t1.trn_cat=1 AND t1.slno='".@mysql_real_escape_string($_GET['sx_code'])."'";
						$header_data=$cmncls->newpikval(null,null,null,$sx_sql);
						$_SESSION['corp_slno']=$header_data['slno'];
					}
					?>
					<script src="assets/plugins/jQuery-Scanner-Detection-master/jquery.scannerdetection.js"></script>
					<div class="row">
						<div class="col-md-12">
							<div class="row card">
								<div class="header">
									<center><h3>GENERAL SALES</h3></center>
								</div>
								<div class="body">
									<form name="pos_form" method="post" dataTo="<?php echo $_GET['pg']; ?>" enctype="multipart/form-data">
										<div class="col-md-4">
											<div class="col-sm-12">
												<div class="form-group form-float">
													<label  class="form-label">Customer:</label>
													<div class="input-group" style="margin-bottom:10px;" >
														<input type="hidden" name="ppg" value="<? echo $_GET[pg]; ?>" />
														<input type="hidden" placeholder="Code (Auto Generate)" class="form-control" readonly="readonly" name="receive_code" id="receive_code" value="<? echo $pickval['receive_code']; ?>" />
														<select style="width:100%;" required class="form-control select2auto" ppg="s2search" name="dcus_cod">
														<?php
														if(isset($header_data['trn_to'])){
															echo '<option value="'.$header_data['trn_to'].'" selected="selected">'.$header_data['dcus_num'].'</option>';
														}
														?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="cus_mob" id="cus_mob" value="<?php echo isset($header_data['trn_mobile_no'])?$header_data['trn_mobile_no']:''; ?>">
														<label  class="form-label">Mobile NO.</label>
													</div>
												</div>
												<div class="form-group form-float">
													<label  class="form-label">Date</label>
													<div class="form-line">
														<input type="text" required class="form-control datepicker" name="trn_date" id="trn_date" value="<?php echo isset($header_data['trn_date'])?$header_data['trn_date']:date('Y-m-d'); ?>">
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" readonly name="trn_sub_total" id="trn_sub_total" value="<?php echo isset($header_data['trn_amount'])?$header_data['trn_amount']:''; ?>">
														<label  class="form-label">Sub Total</label>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" readonly name="trn_discount" id="trn_discount" value="<?php echo isset($header_data['trn_disc'])?$header_data['trn_disc']:''; ?>">
														<label  class="form-label">Discount </label>
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" readonly name="trn_vat_amnt" id="trn_vat_amnt" value="<?php echo isset($header_data['trn_vat'])?$header_data['trn_vat']:''; ?>">
														<label  class="form-label">VAT </label>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" readonly name="trn_net_pay" id="trn_net_pay" value="<?php echo isset($header_data['trn_netamount'])?$header_data['trn_netamount']:''; ?>">
														<label  class="form-label">Net Payable</label>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<select class="form-control show-tick" id="trn_ptype" name="trn_ptype">
															<option <?php echo isset($header_data['trn_ptype'])&& $header_data['trn_ptype']=='cash'?'selected':''; ?> value="cash">Cash</option>
															<option <?php echo isset($header_data['trn_ptype'])&& $header_data['trn_ptype']=='card'?'selected':''; ?> value="card">Card</option>
															<option <?php echo isset($header_data['trn_ptype'])&& $header_data['trn_ptype']=='mbank'?'selected':''; ?> value="mbank">Mobile Banking</option>
															<option <?php echo isset($header_data['trn_ptype'])&& $header_data['trn_ptype']=='credit'?'selected':''; ?> value="credit">Credit</option>
														</select>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" <?php echo isset($header_data['trn_ptype'])&& $header_data['trn_ptype']=='card'?'':'required'; ?> name="trn_cash" id="trn_cash_amnt" value="<?php echo isset($header_data['trn_rcvamount'])?$header_data['trn_rcvamount']:''; ?>">
														<label  class="form-label">Received Amount</label>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" readonly name="trn_change" id="trn_change_amnt" value="<?php //echo isset($header_data['trn_rcvamount'])?$header_data['trn_rcvamount']-$header_data['trn_netamount']:''; ?>">
														<label  class="form-label">Change</label>
													</div>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group form-float">
													<button Title="Save" type="button" id="add_pos_trn" name="add_pos_trn" class="btn btn-success waves-effect">
														<i class="material-icons">save</i>
													</button>
													<button  Title="Print" type="button" <?php echo isset($header_data['slno'])?'data="'.$header_data['slno'].'"':'disabled'; ?> id="print_invoice" name="print_invoice" class="btn btn-warning waves-effect">
														<i class="material-icons">print</i>
													</button>
													<button  Title="New" type="button" id="new_sale" name="new_sale" class="btn btn-default waves-effect">
														<i class="material-icons">autorenew</i>
													</button>
													<a href="?pg=sales_list"  Title="Back" class="btn bg-blue waves-effect">
														<i class="material-icons">arrow_back</i>
													</a>
												</div>
											</div>
										</div>
									</form>
									<div class="col-md-8">
										<div>
											<div class="col-sm-6" style="margin-bottom:5px;">
												<div class="form-group">
													<div class="input-group">
														<label class="form-label">Add Products</label>
														<select style="width:100%;" data="add_data" class="form-control select2auto" ppg="s2search" id="item_code" name="item_code"></select>
													</div>
												</div>
											</div>
										</div>
										<div class="table table-responsive pos_product_div">
											<table class="table table-bordered" id="product_table">
												<thead>
													<tr>
														<th>Product</th>
														<th>Stock</th>
														<th>Qty</th>
														<th>Unit</th>
														<th>Rate</th>
														<th>Amnt.</th>
														<th>Disc.</th>
														<th>Net.</th>
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
							</div>
						</div>
					</div>
					<div id="rsp_div"></div>
					<script type="text/javascript">
						jQuery(document).ready(function($) {
							$( window ).load(function() {
								let searchParams = new URLSearchParams(window.location.search)
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
											if(data.rnd_data){
												$( "#product_table tbody").append(data.rnd_data);
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
									url: './',
									data: {	post_method:'ajax', 
											ppg:<?php echo "'".$_GET['pg']."'"; ?>,
											ac_method:'addFromScan',
											item_code:item_code
									},
									dataType: 'json',
									success: function (data) {
										$( "#item_qty" ).val('');
										$( "#item_brate" ).val('');
										total_calculate();
										if(data.sts==1){
											$( "#product_table tbody").append(data.rtndata);
										}else if(data.sts==2){
											swal({
												title:data.text,
												type: data.type,
												timer: 1500,
												showConfirmButton: true
											});
										}
									}
								});
							});
							$( "#new_sale").click(function(e) {
								$(location).attr('href', '?pg=ca_sales');
							});
							$( "#print_invoice").click(function(e) {
								var sid=$(this).attr('data');
								window.open('./?rpt=ca_sales_invoice&&sid='+sid,'POPUPW','width=1000,height=800');
							});
							$( "#add_pos_trn").click(function(e) {
								tr_form=$(this).parents("form:first");
								//Validation Check//
								if (!tr_form.valid()) {
									return;
								}
								var tran_type=$("#trn_ptype").val();
								target_to=tr_form.attr("dataTo");
								var post_data=tr_form.serialize()+'&post_method=ajax'+'&ppg='+target_to+'&ac_method='+$(this).attr("name");
								$.ajax({
									type: 'POST',
									url: './',
									data: post_data,
									dataType: 'json',
									success: function (data) {
										$("#print_invoice").prop( "disabled", false );
										$("#print_invoice").attr('data',data.rtndata);
										swal({
											title:data.title,
											text: data.text,
											type: data.type,
											timer: 20000,
											showConfirmButton: true
										});
									}
								});
							});
							$( "#item_code").change(function() {
								var item_code=$(this).val();
								$.ajax({
									type: 'POST',
									url: './',
									data: {post_method:'ajax', 
											ppg:<?php echo "'".$_GET['pg']."'"; ?>,
											ac_method:$(this).attr("data"),
											item_code:item_code
									},
									dataType: 'json',
									success: function (data) {
										//$('#item_code').val(null).trigger('change').focus();
										total_calculate();
										if(data.sts==1){
											$( "#product_table tbody").append(data.rtndata);
										}else if(data.sts==2){
											swal({
												title:data.text,
												type: data.type,
												timer: 1500,
												showConfirmButton: true
											});
										}
									}
								});
							});
							$( "#trn_ptype").change(function() {
								if($(this).val()!='cash'){
									$('#trn_cash_amnt').attr('required',false);
								}else{
									$('#trn_cash_amnt').attr('required',true);
								}
							});
							$('#product_table').delegate('.delete_row','click',function(){
								var target_tr=$(this).parent().parent();
								var item_code=target_tr.find(".item_code").val();
								$.ajax({
									type: 'POST',
									url: './',
									data: {post_method:'ajax', ppg:<?php echo "'".$_GET[pg]."'"; ?>,ac_method:'delete_item',tr_item:item_code},
									dataType: 'json',
									success: function (data) {
										target_tr.fadeOut(500, function() { $(this).remove(); });
										total_calculate();
										swal({
											title:'Deleted!',
											type: 'success',
											timer: 1000,
											showConfirmButton: false
										});
									}
								});
							});
							$("#trn_cash_amnt").keyup(function(){
								var due_amnt=$("#trn_net_pay").val();
								var paid = $(this).val();
								var change_amnt=(paid-due_amnt).toFixed(2);
								if(paid>0){
									$("#trn_change_amnt").val(change_amnt).parent().addClass("focused");
								}else{
									$("#trn_change_amnt").val('');
								}
							});
							$('#product_table').delegate(".item_line_qty","keyup change",function(e){
								var qty = $(this);
								var ch_qty=qty.val();
								var tr = $(this).parent().parent();
									var item_code=tr.find(".item_code").val();
									$.ajax({
										type: 'POST',
										url: './',
										data: {post_method:'ajax', ppg:<?php echo "'".$_GET[pg]."'"; ?>,ac_method:'qty_change',tr_item:item_code,tr_qty:ch_qty},
										dataType: 'json',
										success: function (data) {
											if(data.sts==1){
												var item_code=tr.find(".item_amount").html(data.line_amount);
												var item_code=tr.find(".discount_amnt").html((data.line_discount).toFixed(2));
												var item_code=tr.find(".net_amount").html((data.line_net).toFixed(2));
												total_calculate();
											}else{
												swal({
													title:data.text,
													type: data.type,
													timer: 2000,
													showConfirmButton: true
												});
												qty.val(data.avail_qty);
											}
											if (document.activeElement) {
												var prkey= e.which || e.keyCode;
												console.log(prkey);
												if(prkey==13){
													document.activeElement.blur();
												}
											}
										}
									});
							});
							function total_calculate(){
								$.ajax({
									type: 'POST',
									url: './',
									data: {post_method:'ajax', ppg:<?php echo "'".$_GET[pg]."'"; ?>,ac_method:'total_calculate'},
									dataType: 'json',
									success: function (data) {
										$("#trn_sub_total").val(data.sub_total).parent().addClass("focused");
										$("#trn_discount").val(data.discount).parent().addClass("focused");
										$("#trn_vat_amnt").val(data.vat_amount).parent().addClass("focused");
										$("#trn_net_pay").val(data.net_pay).parent().addClass("focused");
										$("#trn_cash_amnt").val('').parent().removeClass("focused");
										$("#trn_change_amnt").val('').parent().removeClass("focused");
									}
								});
							}
						});
					</script>