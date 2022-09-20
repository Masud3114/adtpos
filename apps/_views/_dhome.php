			<link href="./assets/plugins/morrisjs/morris.css" rel="stylesheet" />
			<div class="row">
				<div class="col-md-12">
					<div class="block-header">
						<h2>DASHBOARD</h2>
					</div>
					<!-- Widgets -->
					<div class="row clearfix">
						<a href="/?pg=pos_list">
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="info-box bg-pink hover-expand-effect pointer">
									<div class="icon">
										<i class="material-icons">playlist_add_check</i>
									</div>
									<div class="content">
										<div class="text">SALES</div>
										<div class="number count-to" >POS</div>
									</div>
								</div>
							</div>
						</a>
						<a href="/?pg=sales_list">
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="info-box bg-cyan hover-expand-effect pointer">
									<div class="icon">
										<i class="material-icons">add_shopping_cart</i>
									</div>
									<div class="content">
										<div class="text">SALES</div>
										<div class="number count-to" >GENERAL</div>
									</div>
								</div>
							</div>
						</a>
						<a href="/?pg=quotation_list">
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="info-box bg-light-green hover-expand-effect pointer">
									<div class="icon">
										<i class="material-icons">settings_input_component</i>
									</div>
									<div class="content">
										<div class="text">LIST</div>
										<div class="number count-to">QUOTATION</div>
									</div>
								</div>
							</div>
						</a>
						<a href="/?pg=cus_info">
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="info-box bg-orange hover-expand-effect pointer">
									<div class="icon">
										<i class="material-icons">person_add</i>
									</div>
									<div class="content">
										<div class="text">NEW</div>
										<div class="number count-to">CUSTOMER</div>
									</div>
								</div>
							</div>
						</a>
					</div>
					<!-- #END# Widgets -->
					<div class="row clearfix">
						<!-- Task Info -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="card">
								<div class="header">
									<h2>RECENT SALES</h2>
								</div>
								<div class="body">
									<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover dataTable" sort="2" sort_type="desc"  data="sales_list_all">
											<thead>
												<tr>
													<th>Invoice#</th>
													<th>Customer</th>
													<th>Date</th>
													<th>Sale Amnt.</th>
													<th>Disc. Amnt.</th>
													<th>VAT Amnt.</th>
													<th>Net Amnt.</th>
													<th>Pay-Mode</th>
													<th>Pay Amnt.</th>
													<th style="width:80px;">Action</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>Invoice#</th>
													<th>Customer</th>
													<th>Date</th>
													<th>Sale Amnt.</th>
													<th>Disc. Amnt.</th>
													<th>VAT Amnt.</th>
													<th>Net Amnt.</th>
													<th>Pay-Mode</th>
													<th>Pay Amnt.</th>
													<th>Action</th>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- #END# Task Info -->
						<!-- Browser Usage -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="card">
								<div class="header">
									<h2>MONTHLY SALES GRAPH</h2>
								</div>
								<div class="body">
									<div id="area_chart" class="graph"></div>
								</div>
							</div>
						</div>
						<!-- #END# Browser Usage -->
					</div>
				</div>
			</div>
			<script src="./assets/plugins/raphael/raphael.min.js"></script>
			<script src="./assets/plugins/morrisjs/morris.min.js"></script>
			<script src="./assets/js/pages/charts/morris.js"></script>