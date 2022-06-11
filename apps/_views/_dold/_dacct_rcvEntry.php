					<?php
					$sx_code=$action->escap_string($_GET['sx_code']);
					
					$header_sql="SELECT acct_glheader.slno, acct_glheader.xvoucher, 
					acct_glheader.prfx_name,
					acct_glheader.xdate, acct_glheader.xref, 
					acct_glheader.xnarration,
					(SELECT CONCAT(acc_vca_list.acct_code,',',acc_vca_list.acct_name) FROM acc_vca_list WHERE acc_vca_list.acct_code=(SELECT max(acct_gldetail.acct_code) AS acct_code FROM acct_gldetail WHERE acct_gldetail.hslno= acct_glheader.slno AND acct_gldetail.xdebit>0)) AS rcv_in_name,
					(SELECT CONCAT(acct_cmn_account.acct_code,',',acct_cmn_account.acct_name) FROM acct_cmn_account WHERE acct_cmn_account.acct_code =(SELECT max(acct_gldetail.acct_code_sub) AS acct_code_sub FROM acct_gldetail WHERE acct_gldetail.hslno= acct_glheader.slno AND acct_gldetail.xcredit>0)) AS rcv_from_name,
					(SELECT sum(acct_gldetail.xdebit) AS xdebit FROM acct_gldetail WHERE acct_gldetail.hslno= acct_glheader.slno AND acct_gldetail.xdebit>0) AS xamount,
					acct_glheader.dent_id, 
					acct_glheader.dupdt_id, 
					acct_glheader.dent_dt,
					acct_glheader.dupdt_dt,
					acct_glheader.sts 
					FROM acct_glheader
					WHERE acct_glheader.slno='".$sx_code."'";
					$pickval = $cmncls->newpikval('','','',$header_sql);
					
					if($pickval['rcv_in_name']!=NULL){
						list($pickval['acct_code'],$pickval['acct_name'])=explode(',',$pickval['rcv_in_name']);
					}
					if($pickval['rcv_from_name']!=NULL){
						list($pickval['acct_code_sub'],$pickval['acct_name_sub'])=explode(',',$pickval['rcv_from_name']);
					}
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="row card">
								<div class="header">
									<center><h3>Receive Voucher Entry</h3></center>
								</div>
								<div class="body">
									<ul class="nav nav-tabs myTab" role="tablist">
										<li role="presentation" class="active">
											<a class="waves-effect" href="#acct_glheader" data-toggle="tab">
												<i class="material-icons">text_format</i> Voucher Head
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
															<label  class="form-label">Date</label>
															<div class="form-line">
																<input type="text"  name="xdate" id="xdate" required class="form-control datepicker" value="<? echo $pickval['xdate']; ?>">
															</div>
														</div>
														<div class="input-group" style="margin-bottom:10px;" >
															<label  class="form-label">Receive From</label>
															<select name="dcus_cod" required style="width:100%;" class="form-control select2auto" ppg="s2search">
															<?php echo $pickval['acct_code_sub']? ' <option value="'.$pickval['acct_code_sub'].'" selected="selected">'.$pickval['acct_code_sub'].'-'.$pickval['acct_name_sub'].'</option>': ''; ?>
															</select>
														</div>
														<div class="input-group" style="margin-bottom:10px;" >
															<label  class="form-label">Receive In</label>
															<select name="acct_code_rcv" style="width:100%;" required class="form-control select2auto" ppg="s2search">
															<?php echo $pickval['acct_code']? ' <option value="'.$pickval['acct_code'].'" selected="selected">'.$pickval['acct_code'].'-'.$pickval['acct_name'].'</option>': ''; ?>
															</select>
														</div>
														<div class="form-group form-float">
															<div class="form-line">
																<input type="text" class="form-control" required name="xamount" id="xamount" required value="<? echo $pickval['xamount']; ?>">
																<label  class="form-label">Amount</label>
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
														<table class="table table-striped table-hover dataTable" data="acct_receivegl">
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
									</div>
								</div>
							</div>
						</div>
					</div>
					<script type="text/javascript">
							jQuery(document).ready(function($) {
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