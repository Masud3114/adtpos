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
		<script src="assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
		<script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
		<script src="assets/plugins/momentjs/moment.js"></script>
		<script src="assets/plugins/sweetalert/sweetalert.min.js"></script>
		<script src="assets/plugins/select2/js/select2.min.js"></script>
		<script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>
		<script src="assets/plugins/node-waves/waves.js"></script>
		<script src="assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
		<script src="assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
		<script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
		<script src="assets/plugins/flatpickr/flatpickr.min.js"></script>
		<script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
		<script src="assets/js/datatable.js"></script>
		<script src="assets/js/admin.js"></script>
		<script src="assets/js/script.js"></script>
	</body>
</html>