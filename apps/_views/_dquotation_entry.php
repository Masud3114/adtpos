					<?php
					unset($_SESSION['item_code']);
					unset($_SESSION['item_row']);
					unset($_SESSION['qout_slno']);
					if(isset($_GET['sx_code'])){
						$sx_sql="SELECT quotation_header.*,
						dcus_info.dcus_cod, dcus_info.dcus_num
						FROM 
						quotation_header 
						LEFT JOIN dcus_info ON quotation_header.dcus_cod=dcus_info.dcus_cod
						WHERE quotation_header.zid='".$_SESSION['zid']."' AND quotation_header.slno='".@mysql_real_escape_string($_GET['sx_code'])."'";
						$header_data=$cmncls->newpikval(null,null,null,$sx_sql);
						//$cmncls->dd($sx_sql);
						$_SESSION['qout_slno']=$header_data['slno'];
					}
					?>
					<script src="assets/plugins/jQuery-Scanner-Detection-master/jquery.scannerdetection.js"></script>
					<div class="row">
						<div class="col-md-12">
							<div class="row card">
								<div class="header">
									<center><h3>QUOTATION ENTRY</h3></center>
								</div>
								<div class="body">
									<form name="pos_form" method="post" dataTo="<?php echo $_GET['pg']; ?>" enctype="multipart/form-data">
										<div class="col-md-4">
											<div class="col-sm-12">
												<div class="form-group form-float">
													<label  class="form-label">Customer:</label>
													<div class="input-group" style="margin-bottom:10px;" >
														<input type="hidden" name="ppg" value="<? echo $_GET[pg]; ?>" />
														<input type="hidden" placeholder="Code (Auto Generate)" class="form-control" name="slno" id="slno" value="<? echo $pickval['slno']; ?>" />
														<select style="width:100%;" required class="form-control select2auto" ppg="s2search" name="dcus_cod">
														<?php
														if(isset($header_data['dcus_cod'])){
															echo '<option value="'.$header_data['dcus_cod'].'" selected="selected">'.$header_data['dcus_num'].'</option>';
														}
														?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group form-float">
													<label  class="form-label">Date</label>
													<div class="form-line">
														<input type="text" required class="form-control datepicker" name="quot_date" id="quot_date" value="<?php echo isset($header_data['quot_date'])?$header_data['quot_date']:date('Y-m-d'); ?>">
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" readonly name="quot_amount" id="quot_amount" value="<?php echo isset($header_data['quot_amount'])?$header_data['quot_amount']:''; ?>">
														<label  class="form-label">Sub Total</label>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="quot_discount" id="quot_discount" value="<?php echo isset($header_data['quot_discount'])?$header_data['quot_discount']:''; ?>">
														<label  class="form-label">Discount</label>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" readonly name="quot_vat" id="quot_vat" value="<?php echo isset($header_data['quot_vat'])?$header_data['quot_vat']:''; ?>">
														<label  class="form-label">VAT </label>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" readonly name="quot_netamount" id="quot_netamount" value="<?php echo isset($header_data['quot_netamount'])?$header_data['quot_netamount']:''; ?>">
														<label  class="form-label">Net Payable</label>
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group form-float">
													<div class="form-line">
														<select class="form-control show-tick" id="quot_pay_method" name="quot_pay_method">
															<option <?php echo isset($header_data['quot_pay_method'])&& $header_data['quot_pay_method']=='cash'?'selected':''; ?> value="cash">Cash</option>
															<option <?php echo isset($header_data['quot_pay_method'])&& $header_data['quot_pay_method']=='card'?'selected':''; ?> value="card">Card</option>
															<option <?php echo isset($header_data['quot_pay_method'])&& $header_data['quot_pay_method']=='mbank'?'selected':''; ?> value="mbank">Mobile Banking</option>
															<option <?php echo isset($header_data['quot_pay_method'])&& $header_data['quot_pay_method']=='credit'?'selected':''; ?> value="credit">Credit</option>
														</select>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="quot_advance_rate" id="quot_advance_rate" value="<?php echo isset($header_data['quot_advance_rate'])?$header_data['quot_advance_rate']:''; ?>">
														<label  class="form-label">Advance Rate(%)</label>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="quot_ref" id="quot_ref" value="<?php echo isset($header_data['quot_ref'])?$header_data['quot_ref']:''; ?>">
														<label  class="form-label">Reference</label>
													</div>
												</div>
												<div class="form-group form-float" align="left">
													<div class="form-line">
														<label class="form-label">Note</label>
														<textarea name="quot_desc" rows="5" id = "quot_desc" class="form-control"/><?php echo $header_data[quot_desc]; ?></textarea>
													</div>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group form-float">
													<button Title="Save" type="button" id="add_quotation_trn" name="add_quotation_trn" class="btn btn-success waves-effect">
														<i class="material-icons">save</i>
													</button>
													<button  Title="Print" type="button" <?php echo isset($header_data['slno'])?'data="'.$header_data['slno'].'"':'disabled'; ?> id="print_quotation" name="print_quotation" class="btn btn-warning waves-effect">
														<i class="material-icons">print</i>
													</button>
													<button  Title="New" type="button" id="new_quoat" name="new_quoat" class="btn btn-default waves-effect">
														<i class="material-icons">autorenew</i>
													</button>
													<a href="?pg=quotation_list"  Title="Back" class="btn bg-blue waves-effect">
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
							//Add product//
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
											$( "#product_table tbody").append(data.rtndata);
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
							//Add product by scanner//
							$(window).scannerDetection();
							$(window).bind('scannerDetectionComplete',function(e,data){
								var item_code=data.string;
								$.ajax({
									type: 'POST',
									url: './',
									data: {
										post_method:'ajax', 
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
											$( "#product_table tbody").append(data.rtndata);
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
							//End Add product//
							$( "#new_quoat").click(function(e) {
								$(location).attr('href', '?pg=quotation_entry');
							});
							$( "#print_quotation").click(function(e) {
								var sid=$(this).attr('data');
								window.open('./?rpt=quotation&&qid='+sid,'POPUPW','width=1000,height=800');
							});
							$( "#add_quotation_trn").click(function(e) {
								tr_form=$(this).parents("form:first");
								//Validation Check//
								if (!tr_form.valid()) {
									return;
								}
								var tran_type=$("#quot_pay_method").val();
								target_to=tr_form.attr("dataTo");
								var post_data=tr_form.serialize()+'&post_method=ajax'+'&ac_method='+$(this).attr("name");
								$.ajax({
									type: 'POST',
									url: './',
									data: post_data,
									dataType: 'json',
									success: function (data) {
										$("#print_quotation").prop( "disabled", false );
										$("#print_quotation").attr('data',data.rtndata);
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
							//$( "#quot_pay_method").change(function() {
							//	if($(this).val()!='cash'){
							//		$('#quot_advance_rate_amnt').attr('required',false);
							//	}else{
							//		$('#quot_advance_rate_amnt').attr('required',true);
							//	}
							//});
							$( "#quot_discount").change(function() {
								total_calculate();
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
							//$("#quot_advance_rate_amnt").keyup(function(){
							//	var due_amnt=$("#quot_netamount").val();
							//	var paid = $(this).val();
							//	var change_amnt=(paid-due_amnt).toFixed(2);
							//	if(paid>0){
							//		$("#quot_ref").val(change_amnt).parent().addClass("focused");
							//	}else{
							//		$("#quot_ref").val('');
							//	}
							//});
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
												//qty.val(data.avail_qty);
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
										$("#quot_amount").val(data.sub_total).parent().addClass("focused");
										$("#quot_discount").val(data.discount).parent().addClass("focused");
										$("#quot_vat").val(data.vat_amount).parent().addClass("focused");
										$("#quot_netamount").val(data.net_pay).parent().addClass("focused");
										//$("#quot_advance_rate_amnt").val('').parent().removeClass("focused");
									}
								});
							}
						});
					</script>