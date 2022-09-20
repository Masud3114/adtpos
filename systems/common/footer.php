			<? if ($_SESSION['msg']){?>
				<div class="row ac_massage">
					<div class="alert alert-<? if($_SESSION['clor']=='red'){?>danger<? } else{?>success<? }?>">  
						<? 
						echo $_SESSION['msg']; 
						$_SESSION['msg'] = NULL;
						$_SESSION['clor'] = NULL;
						?>   
					</div>
				</div>
			<? }?>
			</div>
		</section>
		<script src="assets/AdminBSBMaterialDesign-master/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/AdminBSBMaterialDesign-master/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
		<script src="assets/AdminBSBMaterialDesign-master/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
		<script src="assets/AdminBSBMaterialDesign-master/plugins/momentjs/moment.js"></script>
		<script src="assets/AdminBSBMaterialDesign-master/plugins/sweetalert/sweetalert.min.js"></script>
		<script src="assets/plugins/select2/js/select2.min.js"></script>
		<script src="assets/AdminBSBMaterialDesign-master/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
		<script src="assets/AdminBSBMaterialDesign-master/plugins/node-waves/waves.min.js"></script>
		<script src="assets/AdminBSBMaterialDesign-master/plugins/jquery-datatable/jquery.dataTables.min.js"></script>
		<script src="assets/AdminBSBMaterialDesign-master/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.min.js"></script>
		<script src="assets/AdminBSBMaterialDesign-master/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
		<script src="assets/plugins/flatpickr/flatpickr.min.js"></script>
		<script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
		<script src="assets/js/datatable.js"></script>
		<script src="assets/js/admin.js"></script>
		<script src="assets/js/script.js"></script>
	</body>
</html>