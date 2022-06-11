				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="float:none; margin: 0 auto;">
						<form method="post" target="POPUPW" onsubmit="POPUPW = window.open('about:blank','POPUPW','width=1000,height=800');">
							<div class="row card">
								<div class="header">
									<center><h3>Sales Report</h3></center>
								</div>
								<div class="body">
									<div class="row clearfix">
										<div class="col-sm-6">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" required class="form-control datepicker" name="from_date" id="from_date" value="<?php echo date('Y-m-d'); ?>">
													<label  class="form-label">From Date</label>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" required class="form-control datepicker" name="to_date" id="to_date" value="<?php echo date('Y-m-d'); ?>">
													<label  class="form-label">To Date</label>
												</div>
											</div>
										</div>
									</div>
									<!--<div class="row clearfix">
										<div class="col-sm-6">
											<div class="form-group form-float">
												<div class="input-group">
													<label class="form-label">Product</label>
													<select style="width:100%;" class="form-control select2auto" multiple="multiple" ppg="s2search" name="item_code[]">
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group form-float">
												<div class="input-group">
													<label class="form-label">Product Category</label>
													<select style="width:100%;" class="form-control select2auto" multiple="multiple" ppg="s2search" name="item_cat[]">
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-sm-6">
											<div class="form-group form-float">
												<div class="input-group">
													<label class="form-label">Product Type</label>
													<select style="width:100%;" class="form-control select2auto" multiple="multiple" ppg="s2search" name="item_type[]">
														
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group form-float">
												<div class="input-group">
													<label class="form-label">Brand</label>
													<select style="width:100%;" class="form-control select2auto" multiple="multiple" ppg="s2search" name="item_brand[]">
														
													</select>
												</div>
											</div>
										</div>
									</div>-->
									<div class="row clearfix">
										<div class="col-sm-6">
											<div class="form-group form-float">
												<div class="input-group">
													<label class="form-label">Customer</label>
													<select style="width:100%;" class="form-control select2auto" ppg="s2search" name="dcus_cod">
														
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group form-float">
												<div class="input-group">
													<label class="form-label">Sales Type</label>
													<select name="sales_type" id="sales_type" class="form-control show-tick">
														<option value="">--Select--</option>
														<option value="pos">POS</option>
														<option value="gls">General Sales</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="body" align="center" style="padding:10px;" >
									<input class="btn btn-warning view_report" name="view_report"  type="submit" value="View" />
									<input class="btn btn-warning view_report" name="export_excel" type="submit" value="Excel" />
									<input class="btn btn-warning view_report" name="export_word" type="submit" value="Word" />
								</div>
							</div>
						</form>	
					</div>
				</div>