		<?php if ($_SESSION['msg']){?>
			<div class="row ac_massage">
				<div class="alert alert-<?php if($_SESSION['color']=='red'){?>danger<?php } else{?>success<?php }?>">  
					<?php 
					echo $_SESSION['msg']; 
					$_SESSION['msg'] = NULL;
					$_SESSION['color'] = NULL;
					?>
				</div>
			</div>
		<?php }?>
		</div>
		<script src="assets/plugins/jquery/jquery.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.js"></script>
		<script src="assets/plugins/node-waves/waves.js"></script>
		<script src="assets/plugins/jquery-validation/jquery.validate.js"></script>
		<script src="assets/js/admin.js"></script>
		<script src="assets/js/formValidation.js"></script>
		<script src="assets/js/Auth.js"></script>
	</body>
</html>