					
					<div class="row clearfix">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="row card">
								<div class="header" style="padding:20px">
									<h2 >
										Quotation List
									</h2>
									<div class="header-dropdown m-r--5">
										<a href="?pg=quotation_entry" class="btn bg-blue waves-effect">
											<i class="material-icons">queue</i>
											<span>New</span>
										</a>
									</div>
								</div>
								<div class="body table-responsive">
									<table class="table table-bordered table-striped table-hover dataTable" sort="2" sort_type="desc"  data="<?=$_GET['pg']?>">
										<thead>
											<tr>
												<th>#</th>
												<th>Customer</th>
												<th>RM</th>
												<th>Date</th>
												<th>Amount</th>
												<th>Discount</th>
												<th>VAT</th>
												<th>Net_Amount.</th>
												<th>Pay_Mode</th>
												<th>REF#</th>
												<th style="width:80px;">Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>Customer</th>
												<th>RM</th>
												<th>Date</th>
												<th>Amount</th>
												<th>Discount</th>
												<th>VAT</th>
												<th>Net_Amount.</th>
												<th>Pay_Mode</th>
												<th>REF#</th>
												<th style="width:80px;">Action</th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>