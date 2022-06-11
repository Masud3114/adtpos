<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])//check AJAX Request//
&& !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
}else if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST[dtype_ad])){
		$_POST['slno'] = $action->getslno('item_pram');
		$_POST['pram_type'] = 'type';
		$skip_valus=array('dtype_ad','ppg');
		$_POST['dent_id']=$_SESSION['user_id'];
		$adsts=$action->insert_data('item_pram',$_POST,$skip_valus);
		if ($adsts == 1){
			$msg = "Successfully Add!";
			$clor = green;
		}else{
			$msg = $adsts;
			$clor = red;
		}
		$sxcode = $_POST['slno'];
		$_SESSION['msg'] = $msg;
		$_SESSION['clor'] = $clor;
	}
	else if (isset($_POST['dtype_updt'])){
		if($_POST['slno']!=NULL){
			$skip_valus=array('dtype_updt','slno','ppg');
			$_POST['dupdt_id']=$_SESSION['user_id'];
			$updsts=$action->update_data('item_pram',$_POST,$skip_valus,'slno',$_POST['slno']);
			if ($updsts == true){
				$msg = "Successfully Update";
				$clor = green;
			}else{ 
				$msg = "Can't Update! Please Check your all submitted value! ";//.$updsts;
				$clor = red;
			}
		}else {
			$msg = "Can't Update! Please Select an Information...";
			$clor = red;
		}
		$sxcode = $_POST['slno'];
		$_SESSION['msg'] = $msg;
		$_SESSION['clor'] = $clor;
	}else if(isset($_POST['dtype_dlt'])){
		$news_banner = $cmncls->newpikval('item_pram','slno',$_POST['slno']);
		$dlt_sts = $action->delete('item_pram','slno',$_POST['slno']);
		if ($dlt_sts==true){
			$msg = "Successfully Delete!";
			$clor = green;
		}
		$sxcode = $_POST['slno'];
		$_SESSION['msg'] = $msg;
		$_SESSION['clor'] = $clor;
	}
	header("location:index.php?pg=".$_POST['ppg']."&&sx_cod=".$sxcode);
}
?>
