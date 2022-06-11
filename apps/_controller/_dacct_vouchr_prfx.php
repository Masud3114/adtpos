<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['dacct_trn_prfx_ad'])){
		$_POST['slno'] 		= $action->getslno('acct_vou_prfx');
		$_POST['dent_id'] 	= $_SESSION['user_id'];
		
		$skip_valus=array('dacct_trn_prfx_ad','ppg');
		$adsts=$action->insert_data('acct_vou_prfx',$_POST,$skip_valus);
		if ($adsts == 1){
			$msg = "Successfully Add!";
			$clor = green;
		}else{
			$msg = $adsts;
			$clor = red;
		}
		$sxcode = $_POST['slno'];
	}else if (isset($_POST['dacct_trn_prfx_updt'])){
		$skip_valus=array('dacct_trn_prfx_updt','slno','ppg');
		$_POST['dupdt_id']=$_SESSION['user_id'];
		$updsts=$action->update_data('acct_vou_prfx',$_POST,$skip_valus,'slno',$_POST['slno']);
		if ($updsts == true){
			$msg = "Successfully Update";
			$clor = green;
		}else{
			$msg = "Can't Update! Please Check your all submitted value! ";
			$clor = red;
		}
		$sxcode = $_POST['slno'];
	}else if(isset($_POST['dacct_trn_prfx_dlt'])){
		if ($_SESSION['user_id'] === 'USER-000001'){
			$whr_cod = "where slno = '".$_POST['slno']."' and sts ='1'";
			$dlt_sts = $action->delete('acct_vou_prfx','','',$whr_cod);
			if ($dlt_sts==1){
				$msg = "Successfully Delete!";
				$clor = green;
			}else {
				$msg = $dlt_sts;
				$clor = red;
			}
			$sxcode = $_POST['slno'];
		}
	}
	$_SESSION['clor'] = $clor;
	$_SESSION['msg'] = $msg;
	header("location:index.php?pg=".$_POST['ppg']."&&sx_code=".$sxcode);
}else{
	die('Direct access forbidden');
}