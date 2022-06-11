				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="float:none; margin: 0 auto;">
						<form method="post" target="POPUPW" onsubmit="POPUPW = window.open('about:blank','POPUPW','width=1000,height=800');">
							<div class="row card">
								<div class="header">
									<center><h3>General Ledger</h3></center>
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
									<div class="input-group" style="margin-bottom:10px;" >
										<label  class="form-label">Account</label>
										<select name="acct_code" id="acct_code" style="width:100%;" class="form-control select2auto" ppg="s2search">
										</select>
									</div>
									<div class="input-group" id="subAccountPart" style="margin-bottom:10px;" >
										<label  class="form-label">Sub-Account</label>
										<select name="acct_code_sub" id="acct_code_sub" style="width:100%;" class="form-control select2auto" ppg="s2search">
										</select>
									</div>
									<div class="form-group form-float" align="left">
										<div class="form-line">
											<select name="acct_type" class="form-control show-tick">
												<option value="">Account Type</option>
												<option value="1">Asset</option>
												<option value="2">Liability</option>
												<option value="3">Owner's Equity</option>
												<option value="4">Revenue/Income</option>
												<option value="5">Expenditure</option>
											</select>
										</div>
									</div>
									<div class="form-group form-float" align="left">
										<div class="form-line">
											<select name="acct_usages" class="form-control show-tick">
												<option value="">Account Usages</option>
												<option value="1">Accounts Payable</option>
												<option value="2">Accounts Receivable</option>
												<option value="3">BANK</option>
												<option value="4">CASH</option>
												<option value="5">LEDGER</option>
											</select>
										</div>
									</div>
									<div class="form-group form-float" align="left">
										<div class="form-line">
											<select name="acct_source" class="form-control show-tick">
												<option value="">Account Source</option>
												<option value="1">Customer</option>
												<option value="2">Employee</option>
												<option value="3">None</option>
												<option value="4">Sub-account</option>
												<option value="5">Supplier</option>
											</select>
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