			<div class="card">
				<div class="body">
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#cus_query_deatils" data-toggle="tab">
								<i class="material-icons">text_format</i> Details
							</a>
						</li>
						<li role="presentation">
							<a href="#cus_query_attachment" data-toggle="tab">
								<i class="material-icons">attach_file</i> Attachment
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="cus_query_deatils">
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<?php $pickval = $cmncls->newpikval(dcus_info,dcus_cod,$_GET[sx_code]); ?>
									<form name="dcompny_info" method="post" enctype="multipart/form-data">
										<div class="row card" style="min-height:10px; margin-bottom:10px;">
											<div class="body" align="center" style="padding:10px;" >
												<input class="btn btn-warning" name="dcus_ad"  type="submit" id="dcus_ad" value="Add" />
												<input class="btn btn-warning" name="dcus_updt" type="submit" id="dcus_updt" value="Update" />
												<input class="btn btn-warning" name="dcus_dlt" type="submit" id="dcus_dlt" value="Delete" onclick="return confirm('Are you sure you want to delete?');" />
												<input class="btn btn-warning" name="dcus_clr" type="button" id="dcus_clr" onclick="parent.location='index.php?pg=cus_info'" value="Clear" />
											</div>
										</div>
										<div class="row card">
											<div class="header">
												<center><h3>Customer Details Information</h3></center>
											</div>
											<div class="body">
												<div class="form-group">
													<div class="form-line">
														<input type="text" readonly="readonly"  placeholder="Code (Auto Generate)" class="form-control" id="dcus_cod" name="dcus_cod" value="<? echo $pickval[dcus_cod]; ?>" />
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" required="required"  id="dcus_num" name="dcus_num" value="<? echo $pickval[dcus_num]; ?>" />
														<label class="form-label">Name</label>
													</div>
												</div>
												<div class="form-group form-float" align="left">
													<div class="form-line">
														<select name="dcus_gender" class="form-control show-tick">
															<option value="">Gender</option>
															<option value="Male"<?php echo $pickval[dcus_gender]=='Male'? 'selected':''; ?>>Male</option>
															<option value="Female"<?php echo $pickval[dcus_gender]=='Female'? 'selected':''; ?>>Female</option>
															<option value="Other"<?php echo $pickval[dcus_gender]=='Other'? 'selected':''; ?>>Other</option>
														</select>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" id="dcus_moto" name="dcus_moto" value="<? echo $pickval[dcus_moto]; ?>" />
														<label class="form-label">Motto</label>
													</div>
												</div>
												<div class="file-field input-field form-group">
													<img style="max-height:100px; max-width:100px; " src="<? echo $pickval[dcus_logo];?>" id="ImageId"/>
													<div class="btn btn-warning">
														<span>Select Customer Photo</span>
														<input type="file" id="dcus_logo" name="dcus_logo" onchange='Test.UpdatePreview(this,ImageId)'/>
													</div>
													<div class="file-path-wrapper form-line"></div>
												</div>
												<div class="form-group form-float" align="left">
													<div class="form-line">
														<label class="form-label"> Address</label>
														<textarea name="dcus_adrs" id = "dcus_adrs" class="form-control"/><?php echo $pickval[dcus_adrs]; ?></textarea>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" id="dcus_cprsn" name="dcus_cprsn" value="<? echo $pickval[dcus_cprsn]; ?>"/>
														<label class="form-label">Contact Person</label>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" id="dcus_cprsnmob" name="dcus_cprsnmob" value="<? echo $pickval[dcus_cprsnmob]; ?>"/>
														<label class="form-label">Contact Person Mobile</label>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="email" class="form-control" id="dcus_cprsneml" name="dcus_cprsneml" value="<? echo $pickval[dcus_cprsneml]; ?>"/>
														<label class="form-label">Contact Person E-mail</label>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" id="dcus_telno" name="dcus_telno" value="<? echo $pickval[dcus_telno]; ?>"/>
														<label class="form-label">Telephone</label>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" id="dcus_mobno" name="dcus_mobno" value="<? echo $pickval[dcus_mobno]; ?>"/>
														<label class="form-label">Mobile</label>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" id="dcus_fxno" name="dcus_fxno" value="<? echo $pickval[dcus_fxno]; ?>"/>
														<label class="form-label">Fax</label>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="email" class="form-control" id="dcus_eml" name="dcus_eml" value="<? echo $pickval[dcus_eml]; ?>" />
														<label class="form-label">E-mail</label>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" id="dcus_web" name="dcus_web" value="<? echo $pickval[dcus_web]; ?>" />
														<input type="hidden" name="ppg" value="<? echo $_GET[pg]; ?>" />
														<label class="form-label">Web</label>
													</div>
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
								<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
									<div class="card">
										<div class="body table-responsive">
											<table class="table table-striped table-hover dataTable" data="cus_info">
												<thead>
													<tr>
														<th ><strong>Code</strong></th>
														<th ><strong>Name</strong></th>
														<th ><strong>Contact Person</strong></th>
														<th ><strong>Mobile</strong></th>
														<th ><strong>#</strong></th>
													</tr>
												</thead>
												<tfoot>
													<tr>
														<th ><strong>Code</strong></th>
														<th ><strong>Name</strong></th>
														<th ><strong>Contact Person</strong></th>
														<th ><strong>Mobile</strong></th>
														<th ><strong>#</strong></th>
													</tr>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade in" id="cus_query_attachment">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<form name="dcompny_info" method="post" enctype="multipart/form-data">
										<div class="row card">
											<div class="header">
												<h2>Attach Necessary File</h2>
											</div>
											<div class="body">
												<div class="file-field input-field form-group">
													<div class="btn btn-warning">
														<span>Select File</span>
														<input type="file" required id="attach_file" name="attach_file[]" multiple="multiple"/>
													</div>
													<div class="file-path-wrapper form-line"></div>
												</div>
												<div class="form-group">
													<input type="hidden" name="dcus_cod" value="<? echo $pickval[dcus_cod]; ?>"/>
													<input type="hidden" name="ppg" value="<? echo $_GET[pg]; ?>" />
													<input class="btn btn-warning" name="upload_attach"  type="submit" id="upload_attach" value="Upload" />
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="body table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th ><strong>#</strong></th>
													<th ><strong></strong></th>
													<th ><strong>File Name</strong></th>
													<th ><strong></strong></th>
												</tr>
											</thead>
											<tbody>
												<?php
												$sql_qry = "SELECT  slno, file_cap, file_path
															FROM dcus_attach
															where sts = '1' and dcus_cod='".$pickval[dcus_cod]."'";
												$sql_qry=$cmncls->sqlqry($sql_qry);
												if(@mysql_num_rows($sql_qry)>0){
													while($attach_info=@mysql_fetch_array($sql_qry)){
														$file_type=array(
															"jpg"	=> '<i class="fa fa-file-photo-o fa-lg">', 
															"png"	=> '<i class="fa fa-file-photo-o fa-lg">', 
															"gif"	=> '<i class="fa fa-file-photo-o fa-lg">', 
															"bmp"	=> '<i class="fa fa-file-photo-o fa-lg">', 
															"zip"	=> '<i class="fa fa-file-zip-o fa-lg">', 
															"pdf"	=> '<i class="fa fa-file-pdf-o fa-lg">', 
															"doc"	=> '<i class="fa fa-file-word-o fa-lg">', 
															"xls"	=> '<i class="fa fa-file-excel-o fa-lg">', 
															"docx"	=> '<i class="fa fa-file-word-o fa-lg">', 
															"xlsx"	=> '<i class="fa fa-file-excel-o fa-lg">'
														);
														list($name,$ext)=explode('.',$attach_info[file_path]);
														$slno++;
														?>
														<tr id="<?php echo "row_".$attach_info[slno]; ?>">
															<td><?php echo $slno; ?></td>
															<td><?php echo $file_type[$ext]; ?></td>
															<td><a target="_blank" href="<?php echo $attach_info[file_path]; ?>"><?php echo $attach_info[file_cap]; ?></a></td>
															<td><a href="#" title="Delete" onclick="delete_action('<?php echo $_GET[pg]; ?>','<?php echo $attach_info[slno]; ?>','<?php echo "row_".$attach_info[slno]; ?>','delete_attachfile')" data-original-title="Delete"><i class="material-icons">delete</i></a></td>
														</tr>
														<?php
													}
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
			</div>