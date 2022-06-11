					<?php
					$sx_code=$action->escap_string($_GET['sx_code']);
					$sx_cods=$action->escap_string($_GET['sx_cods']);
					$sub_sql="SELECT acc_chart_of_account.acct_name,
					acct_cmn_account.acct_name AS acct_name_sum,
					acct_gldetail.* 
					FROM acct_gldetail
					LEFT JOIN acc_chart_of_account ON acct_gldetail.acct_code=acc_chart_of_account.acct_code
					LEFT JOIN acct_cmn_account ON acct_gldetail.acct_code_sub=acct_cmn_account.acct_code
					WHERE acct_gldetail.slno='".$sx_cods."'";
					
					$pickvals = $cmncls->newpikval('','','',$sub_sql); 
					if(isset($pickvals['hslno']) && $pickvals['hslno']!=null && $pickvals['hslno']!=''){
						$sx_code=$pickvals['hslno'];
					}
					$header_sql="SELECT acct_glheader.slno, acct_glheader.xvoucher, acct_glheader.prfx_name,acct_vou_prfx.prfx_desc,
					acct_glheader.xdate, acct_glheader.xref, acct_glheader.xnarration,
					acct_glheader.dent_id, acct_glheader.dupdt_id, acct_glheader.dent_dt, acct_glheader.dupdt_dt, acct_glheader.sts 
					FROM acct_glheader 
					LEFT JOIN acct_vou_prfx ON acct_glheader.prfx_name=acct_vou_prfx.prfx_name
					WHERE acct_glheader.slno='".$sx_code."'";
					$pickval = $cmncls->newpikval('','','',$header_sql); 
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="row card">
								<div class="header">
									<center><h3>Journal Entry</h3></center>
								</div>
								<div class="body">
									<ul class="nav nav-tabs myTab" role="tablist">
										<li role="presentation" class="active">
											<a class="waves-effect" href="#acct_glheader" data-toggle="tab">
												<i class="material-icons">text_format</i> Journal Head
											</a>
										</li>
										<li role="presentation">
											<a class="waves-effect" href="#acct_gldetails" data-toggle="tab">
												<i class="material-icons">attach_file</i> Journal Details
											</a>
										</li>
										<?php
										if(isset($pickval['slno'])
										&& $pickval['slno']!=NUll){
											?>
											<li>
												<a id="print_invoice" data="<?php echo $pickval['slno']; ?>" class="waves-effect">
													 <i class="material-icons">print</i>Print
												</a>
											</li>
											<?php
										}
										?>
									</ul>
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="acct_glheader">
											<div class="col-md-4 card">
												<div class="body">
													<form name="form_glheader" method="post">
														<div class="form-group form-float">
															<div class="form-line disabled">
																<input type="hidden" id="slno" name="slno" value="<?php echo $pickval['slno']; ?>" />
																<input type="text" disabled class="form-control" name="xvoucher" id="xvoucher" value="<? echo $pickval['xvoucher']; ?>">
																<label  class="form-label">Voucher NO.</label>
															</div>
														</div>
														<div class="form-group form-float">
															<div class="input-group" style="margin-bottom:10px;" >
																<label  class="form-label">Prefix</label>
																<select name="prfx_name" <?php if(!isset($pickval['xvoucher'])){ echo "required"; } ?> class="form-control select2auto" ppg="s2search">
																	<?php echo $pickval['prfx_name']? ' <option value="'.$pickval['prfx_name'].'" selected="selected">'.$pickval['prfx_name'].$pickval['prfx_desc'].'</option>': ''; ?>
																</select>
															</div>
														</div>
														<div class="form-group form-float">
															<label  class="form-label">Date</label>
															<div class="form-line">
																<input type="text"  name="xdate" id="xdate" required class="form-control datepicker" value="<? echo $pickval['xdate']; ?>">
															</div>
														</div>
														<div class="form-group form-float">
															<div class="form-line">
																<input type="text" class="form-control" name="xref" id="xref" value="<? echo $pickval['xref']; ?>">
																<label  class="form-label">Reference</label>
															</div>
														</div>
														<div class="form-group form-float">
															<label  class="form-label">Narration</label>
															<div class="form-line">
																<textarea name="xnarration" required placeholder="Type narration here......." class="form-control txtedt" id="xnarration" cols="45"  rows="3"><? echo $pickval['xnarration']; ?></textarea>
																<input type="hidden" name="ppg" value="<?php echo $_GET['pg']; ?>" />
															</div>
														</div>
														<div class="form-group form-float">
															<div class="row card" style="min-height:10px; margin-bottom:10px;">
																<div class="body" align="center" style="padding:10px;" >
																	<input class="btn btn-warning" name="glheader_ad"  type="submit" id="glheader_ad" value="Add" />
																	<input class="btn btn-warning" name="glheader_updt" type="submit" id="glheader_updt" value="Update" />
																	<input class="btn btn-warning" name="glheader_dlt" type="submit" id="glheader_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');"/>
																	<input class="btn btn-warning" name="glheader_clr" type="button" id="glheader_clr" onclick="parent.location='index.php?pg=<?php echo $_GET['pg']; ?>'" value="Clear" />
																</div>
															</div>
														</div>
														<?php 
														if($pickval['dent_dt']!=NULL || $pickval['dent_id']!=NULL){ ?>
														<div class="form-group">
															<label  class="col-lg-4 control-label">Entered By :</label>
															<div class="col-lg-8">
																<?php
																$user_info = $cmncls->eventer_info($pickval['dent_id']);
																echo $user_info['name_']."<br />Date & Time-".date('h:i:sA, d-M-Y',strtotime($pickval['dent_dt'])); 
																?>
															</div>
														</div>
														<?php
														}
														if($pickval['dupdt_id']!=NULL || $pickval['dupdt_id']!=NULL){
														?> 
														<div class="form-group">
															<label  class="col-lg-4 control-label">Updated By :</label>
															<div class="col-lg-8">
																<?php
																$user_info = $cmncls->eventer_info($pickval['dupdt_id']);
																echo $user_info['name_']."<br />Date & Time-".date('h:i:sA, d-M-Y',strtotime($pickval['dupdt_dt'])); 
																?> 
															</div>
														</div>
														<?php
														}
														?>
													</form>
												</div>
											</div>
											<div class="col-md-8">
												<div class="card">
													<div class="body table-responsive">
														<table class="table table-striped table-hover dataTable" data="acct_glheader">
															<thead>
																<tr>
																	<th ><strong>Voucher</strong></th>
																	<th ><strong>Date</strong></th>
																	<th ><strong>Reference</strong></th>
																	<th ><strong>Narration</strong></th>
																	<th style="width:20%;"><strong>#</strong></th>
																</tr>
															</thead>
															<tfoot>
																<tr>
																	<th ><strong>Voucher</strong></th>
																	<th ><strong>Date</strong></th>
																	<th ><strong>Reference</strong></th>
																	<th ><strong>Narration</strong></th>
																	<th ><strong>#</strong></th>
																</tr>
															</thead>
														</table>
													</div>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane fade in" id="acct_gldetails">
											<div class="col-md-4 card">
												<div class="body">
													<form name="form_gldetails" method="post">
														<div class="form-group form-float">
															<span><h5>Voucher No-<? echo $pickval['xvoucher']; ?></h5></span>
															<div class="input-group" style="margin-bottom:10px;" >
																<input type="hidden" id="hslno" name="hslno" required value="<?php echo $pickval['slno']; ?>" />
																<input type="hidden" id="slno" name="slno" value="<?php echo $pickvals['slno']; ?>" />
																<label  class="form-label">Account</label>
																<select name="acct_code" id="acct_code" style="width:100%;" required class="form-control select2auto" ppg="s2search">
																<?php echo $pickvals['acct_code']? ' <option value="'.$pickvals['acct_code'].'" selected="selected">'.$pickvals['acct_code'].$pickvals['acct_name'].'</option>': ''; ?>
																</select>
															</div>
															<div class="input-group" id="subAccountPart" style="margin-bottom:10px;" >
																<label  class="form-label">Sub-Account</label>
																<select name="dcus_cod" id="subAccount" style="width:100%;" class="form-control select2auto" ppg="s2search">
																<?php echo $pickvals['acct_code_sub']? ' <option value="'.$pickvals['acct_code_sub'].'" selected="selected">'.$pickvals['acct_code_sub'].$pickvals['acct_name_sum'].'</option>': ''; ?>
																</select>
															</div>
														</div>
														<div class="form-group form-float">
															<div class="form-line">
																<input type="text" class="form-control" name="xChequeNo" id="xChequeNo" value="<? echo $pickvals['xChequeNo']; ?>">
																<label  class="form-label">Cheque No</label>
															</div>
														</div>
														<div class="form-group form-float">
															<label  class="form-label">Cheque Date</label>
															<div class="form-line">
																<input type="text" class="form-control datepicker" name="xChequeDate" id="xChequeDate" value="<? echo $pickvals['xChequeDate']; ?>">
															</div>
														</div>
														<div class="form-group form-float">
															<div class="form-line">
																<input type="text" class="form-control" name="xChequeBank" id="xChequeBank" value="<? echo $pickvals['xChequeBank']; ?>">
																<label  class="form-label">Bank Name</label>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="xdebit" id="xdebit" required value="<? echo $pickvals['xdebit']; ?>">
																		<label  class="form-label">Debit</label>
																	</div>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="xcredit" id="xcredit" required value="<? echo $pickvals['xcredit']; ?>">
																		<label  class="form-label">Credit</label>
																	</div>
																</div>
															</div>
														</div>
														<div class="form-group form-float">
															<label  class="form-label">Note</label>
															<div class="form-line">
																<textarea name="xnote" id="xnote" placeholder="Type note here......." class="form-control txtedt" cols="45"  rows="3"><? echo $pickvals['xnote']; ?></textarea>
																<input type="hidden" name="ppg" value="<?php echo $_GET['pg']; ?>" />
															</div>
														</div>
														<?php
														if(isset($pickval['slno']) && $pickval['slno']!=null){
														?>
															<div class="row card" style="min-height:10px; margin-bottom:10px;">
																<div class="body" align="center" style="padding:10px;" >
																	<input class="btn btn-warning" name="gldetails_ad"  type="submit" id="gldetails_ad" value="Add" />
																	<input class="btn btn-warning" name="gldetails_updt" type="submit" id="gldetails_updt" value="Update" />
																	<input class="btn btn-warning" name="gldetails_dlt" type="submit" id="gldetails_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');"/>
																	<input class="btn btn-warning" name="gldetails_clr" type="button" id="gldetails_clr" onclick="parent.location='index.php?pg=<?php echo $_GET['pg'].(isset($sx_code) && $sx_code!=null?'&&sx_code='.$sx_code:''); ?>'" value="Clear" />
																</div>
															</div>
															
														<?php
														}
														?>
													</form>
														<?php 
														if($pickvals['dent_dt']!=NULL || $pickvals['dent_id']!=NULL){ ?>
														<div class="form-group">
															<label  class="col-lg-4 control-label">Entered By :</label>
															<div class="col-lg-8">
																<?php
																$user_info = $cmncls->eventer_info($pickvals['dent_id']);
																echo $user_info['name_']."<br />Date & Time-".date('h:i:sA, d-M-Y',strtotime($pickval['dent_dt'])); 
																?>
															</div>
														</div>
														<?php
														}
														if($pickvals['dupdt_id']!=NULL || $pickvals['dupdt_id']!=NULL){
														?> 
														<div class="form-group">
															<label  class="col-lg-4 control-label">Updated By :</label>
															<div class="col-lg-8">
																<?php
																$user_info = $cmncls->eventer_info($pickvals['dupdt_id']);
																echo $user_info['name_']."<br />Date & Time-".date('h:i:sA, d-M-Y',strtotime($pickval['dupdt_dt'])); 
																?> 
															</div>
														</div>
														<?php
														}
														?>

												</div>
											</div>
											<div class="col-md-8">
												<div class="card">
													<div class="body table-responsive">
														<table class="table table-striped table-hover dataTableSub" style="width:100%;" prams="<?php echo $pickval['slno']; ?>" data="acct_gldetails">
															<thead>
																<tr>
																	<th ><strong>Account</strong></th>
																	<th ><strong>Account Name</strong></th>
																	<th ><strong>Sub-Account</strong></th>
																	<th ><strong>Sub-Account Name</strong></th>
																	<th ><strong>Debit</strong></th>
																	<th ><strong>Credit</strong></th>
																	<th ><strong>#</strong></th>
																</tr>
															</thead>
															<tfoot>
																<tr>
																	<th ><strong>Account</strong></th>
																	<th ><strong>Account Name</strong></th>
																	<th ><strong>Sub-Account</strong></th>
																	<th ><strong>Sub_Account Name</strong></th>
																	<th ><strong>Debit</strong></th>
																	<th ><strong>Credit</strong></th>
																	<th ><strong>#</strong></th>
																</tr>
															</thead>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<script type="text/javascript">
							jQuery(document).ready(function($) {
								var activeSubacct='<?php echo $pickvals['acct_code_sub']; ?>';
								if(activeSubacct){
									$('#subAccountPart').show();
								}else{
									$('#subAccountPart').hide();
								}
								$( "#acct_code").change(function() {
									var selectVal=$(this).val();
									$.ajax({
										type: 'POST',
										url: 'index.php',
										data: {post_method:'ajax', 
												ppg:<?php echo "'".$_GET['pg']."'"; ?>,
												acctCode:selectVal
										},
										dataType: 'json',
										beforeSend:function() {
											$('#subAccountPart').hide();
										},
										success: function (data) {
											if(data.sts==1){
												$('#subAccount').attr('name',data.fieldName);
												$('#subAccount').attr('disabled',false);
												$('#subAccount').attr('required',true);
												$('#subAccountPart').show();
											}else{
												$('#subAccount').attr('required',false);
												$('#subAccount').attr('disabled',true);
											}
										}
									});
								});
								$( "#print_invoice").click(function(e) {
									var sid=$(this).attr('data');
									window.open('index.php?rpt=acct_voucher&&svid='+sid,'POPUPW','width=1000,height=800');
								});
								$('table').delegate('.print_voucher','click',function(e){
									e.preventDefault();
									var sid=$(this).attr('data');
									window.open('index.php?rpt=acct_voucher&&svid='+sid,'POPUPW','width=1000,height=800');
								});
							});
					</script>