				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="float:none; margin: 0 auto;">
						<form method="post" target="POPUPW" onsubmit="POPUPW = window.open('about:blank','POPUPW','width=1000,height=800');">
							<div class="row card">
								<div class="header">
									<center><h3>Product List</h3></center>
								</div>
								<div class="body">
									<div class="form-group form-float">
										<div class="input-group">
											<label class="form-label">Product Category</label>
											<select style="width:100%;" class="form-control select2auto" multiple="multiple" ppg="s2search" name="item_cat[]">
											</select>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="input-group">
											<label class="form-label">Product Type</label>
											<select style="width:100%;" class="form-control select2auto" multiple="multiple" ppg="s2search" name="item_type[]">
												
											</select>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="input-group">
											<label class="form-label">Brand</label>
											<select style="width:100%;" class="form-control select2auto" multiple="multiple" ppg="s2search" name="item_brand[]">
												
											</select>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="input-group">
											<label class="form-label">Color</label>
											<select style="width:100%;" class="form-control select2auto" multiple="multiple" ppg="s2search" name="item_color[]">
												
											</select>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="input-group">
											<label class="form-label">Product Name</label>
											<select style="width:100%;" class="form-control select2auto" multiple="multiple" ppg="s2search" name="item_code[]">
												
											</select>
										</div>
									</div>
									<div class="input-group input-group">
										<span class="input-group-addon">
											<input type="checkbox" id="bar_code" name="bar_code" class="form-control">
											<label for="bar_code">BAR-Code</label>
										</span>
										<div class="form-line">
											<input type="text" name="bar_code_qty" id="bar_code_qty" placeholder="Input Number of bar-code quantity" class="form-control">
											<script>
											jQuery(document).ready(function($) {
												$('#bar_code').change(function(e){
													cr_sts=$('#bar_code_qty').attr("required");
													if(cr_sts){
														$('#bar_code_qty').removeAttr('required');
													}else{
														$('#bar_code_qty').attr("required", "true");
													}
												});
											});
											</script>
										</div>
									</div>
									<div class="body" align="center" style="padding:10px;" >
										<input class="btn btn-warning view_report" name="view_report"  type="submit" value="View" />
										<input class="btn btn-warning view_report" name="export_excel" type="submit" value="Excel" />
										<input class="btn btn-warning view_report" name="export_word" type="submit" value="Word" />
									</div>
								</div>
							</div>
						</form>	
					</div>
				</div>