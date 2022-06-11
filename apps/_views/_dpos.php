					<?php
					unset($_SESSION['item_code']);
					unset($_SESSION['item_row']);
					unset($_SESSION['pos_slno']);
					if(isset($_GET['sx_code'])){
						$sx_sql="SELECT t1.slno, t1.trn_to, dcus_info.dcus_num, 
						t1.trn_mobile_no,t1.trn_amount, t1.trn_disc,t1.trn_date,
						t1.trn_vat, t1.trn_netamount, t1.trn_ptype, 
						t1.trn_rcvamount
						FROM 
						inop_header t1
						LEFT JOIN dcus_info ON t1.trn_to=dcus_info.dcus_cod
						WHERE t1.trn_cat=0 AND t1.slno='".@mysql_real_escape_string($_GET['sx_code'])."'";
						$header_data=$cmncls->newpikval(null,null,null,$sx_sql);
						$_SESSION['pos_slno']=$header_data['slno'];
					}
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="row card">
								<div class="header">
									<center><h3>POS TERMINAL</h3></center>
								</div>
								<div class="body">
									<form name="pos_form" method="post" dataTo="<?php echo $_GET['pg']; ?>" enctype="multipart/form-data">
										<div class="col-md-4">
											<div class="col-sm-6">
												<div class="form-group form-float">
													<div class="input-group" style="margin-bottom:10px;" >
														<input type="hidden" name="ppg" value="<? echo $_GET[pg]; ?>" />
														<input type="hidden" placeholder="Code (Auto Generate)" class="form-control" readonly="readonly" name="receive_code" id="receive_code" value="<? echo $pickval['receive_code']; ?>" />
														<select style="width:100%;" required class="form-control select2auto" ppg="s2search" name="dcus_cod">
															<?php
															if(isset($header_data['trn_to'])){
																echo '<option value="'.$header_data['trn_to'].'" selected="selected">'.$header_data['dcus_num'].'</option>';
															}else{
																echo '<option value="CUS-00000001" selected="selected">WALKING CUSTOMER</option>';
															}
															?>
														</select>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="trn_mobile_no" id="trn_mobile_no" value="<?php echo isset($header_data['trn_mobile_no'])?$header_data['trn_mobile_no']:''; ?>">
														<label  class="form-label">Mobile No. / Note</label>
													</div>
												</div>
												<div class="form-group form-float">
													<label  class="form-label">Date</label>
													<div class="form-line">
														<input type="text" class="form-control datepicker" name="trn_date" id="trn_date" value="<?php echo isset($header_data['trn_date'])?$header_data['trn_date']:date('Y-m-d'); ?>">
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
														<select required class="form-control show-tick" id="trn_ptype" name="trn_ptype">
															<option <?php echo isset($header_data['trn_ptype'])&& $header_data['trn_ptype']=='cash'?'selected':''; ?> value="cash">Cash</option>
															<option <?php echo isset($header_data['trn_ptype'])&& $header_data['trn_ptype']=='card'?'selected':''; ?> value="card">Card</option>
															<option <?php echo isset($header_data['trn_ptype'])&& $header_data['trn_ptype']=='mbank'?'selected':''; ?> value="mbank">Mobile Banking</option>
														</select>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" required class="form-control" name="trn_cash" id="trn_cash_amnt" value="<?php echo isset($header_data['trn_rcvamount'])?$header_data['trn_rcvamount']:''; ?>">
														<label  class="form-label">Cash Receive</label>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" readonly name="trn_change" id="trn_change_amnt" value="<?php echo isset($header_data['trn_rcvamount'])?$header_data['trn_rcvamount']-$header_data['trn_netamount']:''; ?>">
														<label  class="form-label">Change</label>
													</div>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group form-float">
													<button type="button" id="add_pos_trn" title="Save" name="add_pos_trn" class="btn btn-success waves-effect">
														<i class="material-icons">save</i>
													</button>
													<button type="button" id="pause_pos_trn" title="Pause" name="pause_pos_trn" class="btn btn-success waves-effect">
														<i class="material-icons">pause</i>
													</button>
													<button type="button" title="Print" <?php echo isset($header_data['slno'])?'data="'.$header_data['slno'].'"':'disabled'; ?> id="print_invoice" name="print_invoice" class="btn btn-warning waves-effect">
														<i class="material-icons">print</i>
													</button>
													<button type="button" id="new_sale" title="New" name="new_sale" class="btn btn-default waves-effect">
														<i class="material-icons">autorenew</i>
													</button>
													<a href="?pg=pos_list" title="Back" class="btn bg-blue waves-effect">
														<i class="material-icons">arrow_back</i>
													</a>
												</div>
												<div class="table table-responsive pos_product_div">
													<span>Pause List</span>
													<table class="table table-bordered" id="puase_table">
														<thead>
															<tr>
																<th>Mobile / Marking Title</th>
																<th>Total Product</th>
																<th style="min-width:120px;">#</th>
															</tr>
														</thead>
														<tbody>
														<?php
														if(isset($_SESSION['pause_pos'])){
															foreach($_SESSION['pause_pos'] as $key=>$row){
																echo '
																<tr>
																	<td>'.$row['ref_text'].'</td>
																	<td>'.count($row['item_code']).'</td>
																	<td>
																		<button title="Restore" name="puaseToactive" type="button" data="'.$key.'" class="btn btn-info waves-effect puaseToactive">
																			<i class="material-icons">restore</i>
																		</button>
																		<button title="Remove" name="puaseTodelete" type="button" data="'.$key.'" class="btn btn-danger waves-effect puaseTodelete">
																			<i class="material-icons">delete</i>
																		</button>
																	</td>
																</tr>';
															}
														}
														?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</form>
									<div class="col-md-8">
										<div class="form-group">
											<div class="input-group">
												<label class="form-label">Search / Select / Add Products</label>
												<select style="width:100%;" data="add_data" class="form-control select2auto" ppg="s2search" id="item_code" name="item_code"></select>
											</div>
										</div>
										<div class="table table-responsive pos_product_div">
											<table class="table table-bordered" id="product_table">
												<thead>
													<tr>
														<th>Product</th>
														<th>Stock</th>
														<th style="min-width:120px;">Qty</th>
														<th>Unit</th>
														<th>Rate</th>
														<th>Amnt.</th>
														<th>Disc.</th>
														<th>Net.</th>
														<th>#</th>
													</tr>
												</thead>
												<tbody>
													
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="rsp_div"></div>
					<script src="assets/plugins/jQuery-Scanner-Detection-master/jquery.scannerdetection.js"></script>
					<script type="text/javascript">
						jQuery(document).ready(function($) {
							$( window ).load(function() {
								let searchParams = new URLSearchParams(window.location.search)
								if(searchParams.has('sx_code')){
									let param = searchParams.get('sx_code');
									$.ajax({
										type: 'POST',
										url: 'index.php',
										data: {
											ppg:<?php echo "'".$_GET['pg']."'"; ?>,
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
									url: 'index.php',
									data: {
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
								$(location).attr('href', '?pg=pos');
							});
							$( "#print_invoice").click(function(e) {
								var sid=$(this).attr('data');
								window.open('index.php?rpt=ca_sales_invoice&&spid='+sid,'POPUPW','width=1000,height=800');
							});
							$( "#add_pos_trn").click(function(e) {
								tr_form=$(this).parents("form:first");
								//Validation Check//
								if (!tr_form.valid()) {
									return;
								}
								target_to=tr_form.attr("dataTo");
								var post_data=tr_form.serialize()+'&ppg='+target_to+'&ac_method='+$(this).attr("name");
								$.ajax({
									type: 'POST',
									url: 'index.php',
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
							$( "#pause_pos_trn").click(function(e) {
								var markedText=$(this).parents("form:first").find('#trn_mobile_no').val();
								$(this).parents("form:first").find('#trn_mobile_no').val(null).parent().removeClass("focused error");
								if(markedText){
									$.ajax({
										type: 'POST',
										url: 'index.php',
										data: {
											ppg:<?php echo "'".$_GET['pg']."'"; ?>,
											markedText: markedText,
											ac_method:$(this).attr("name")
										},
										dataType: 'json',
										success: function (data) {
											if(data.sts==1){
												total_calculate();
												$( "#puase_table tbody").append(data.rtndata);
												$( "#product_table tbody").empty();
											}else{
												swal({
													title:data.title,
													text: data.text,
													type: data.type,
													timer: 20000,
													showConfirmButton: true
												});
											}
										}
									});
								}else{
									$(this).parents("form:first").find('#trn_mobile_no').focus().parents('div:first').addClass('error');
								}
							});
							$('#puase_table').delegate('.puaseToactive','click',function(){
								var target_tr=$(this).parent().parent();
								var row_data=$(this).attr('data');
								$.ajax({
									type: 'POST',
									url: 'index.php',
									data: {
										ppg:<?php echo "'".$_GET['pg']."'"; ?>,
										row:row_data,
										ac_method:$(this).attr("name")
									},
									dataType: 'json',
									beforeSend: function() {
										$( "#product_table tbody").empty();
									},
									success: function (data) {
										if(data.sts==1){
											total_calculate();
											$( "#product_table tbody").append(data.rtndata);
											target_tr.fadeOut(500, function() { $(this).remove(); });
										}
									}
								});
							});
							$('#puase_table').delegate('.puaseTodelete','click',function(){
								var target_tr=$(this).parent().parent();
								var row_data=$(this).attr('data');
								$.ajax({
									type: 'POST',
									url: 'index.php',
									data: {
										ppg:<?php echo "'".$_GET['pg']."'"; ?>,
										row:row_data,
										ac_method:$(this).attr("name")
									},
									dataType: 'json',
									success: function (data) {
										target_tr.fadeOut(500, function() { $(this).remove(); });
									}
								});
								
							});
							$( "#item_code").change(function() {
								var item_code=$(this).val();
								$.ajax({
									type: 'POST',
									url: 'index.php',
									data: {
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
							$('#product_table').delegate('.delete_row','click',function(){
								var target_tr=$(this).parent().parent();
								var item_code=target_tr.find(".item_code").val();
								$.ajax({
									type: 'POST',
									url: 'index.php',
									data: {
										ppg:<?php echo "'".$_GET[pg]."'"; ?>,
										ac_method:'delete_item',
										tr_item:item_code
									},
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
									url: 'index.php',
									data: {
										ppg:<?php echo "'".$_GET[pg]."'"; ?>,
										ac_method:'qty_change',
										tr_item:item_code,
										tr_qty:ch_qty
									},
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
									url: 'index.php',
									data: {
										ppg:<?php echo "'".$_GET[pg]."'"; ?>,
										ac_method:'total_calculate'
									},
									dataType: 'json',
									success: function (data) {
										if(data.net_pay){
											$("#trn_sub_total").val(data.sub_total).parent().addClass("focused");
											$("#trn_discount").val(data.discount).parent().addClass("focused");
											$("#trn_vat_amnt").val(data.vat_amount).parent().addClass("focused");
											$("#trn_net_pay").val(data.net_pay).parent().addClass("focused");
											$("#trn_cash_amnt").val(null).parent().removeClass("focused");
											$("#trn_change_amnt").val(null).parent().removeClass("focused");
										}else{
											$("#trn_sub_total").val(null).parent().removeClass("focused");
											$("#trn_discount").val(null).parent().removeClass("focused");
											$("#trn_vat_amnt").val(null).parent().removeClass("focused");
											$("#trn_net_pay").val(null).parent().removeClass("focused");
											$("#trn_cash_amnt").val(null).parent().removeClass("focused");
											$("#trn_change_amnt").val(null).parent().removeClass("focused");
										}
									}
								});
							}
						});
					</script>