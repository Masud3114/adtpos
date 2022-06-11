<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])//check AJAX Request//
&& !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
}else if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['dcmpny_ad'])){
		$_POST['slno'] = $action->getslno('dcmpny_info');
		$_POST['dcmpny_cod'] = "COMP-" . sprintf("%04s", $_POST['slno']);
		$skip_valus=array('dcmpny_ad','ppg');
		
		//image code start//
		if($_FILES['dcmpny_logo']['name'] !=NULL){
			$_POST['dcmpny_logo'] = $cmncls->img_uplod('dcmpny_logo','ap_img/cmp_logo/',4096*1024,'-'.$_POST['dcmpny_cod'].'-'.sprintf("%03s", $prv_imglnk[slno]));
		}
		if($_FILES['dcmpny_logoi']['name'] !=NULL){
			$_POST['dcmpny_logoi'] = $cmncls->img_uplod('dcmpny_logoi','ap_img/cmp_logo/',4096*1024,'-'.$_POST['dcmpny_cod'].'-i-'.sprintf("%03s", $prv_imglnk[slno]));
		}
		$_POST['dent_id']=$_SESSION['user_id'];
		//end image code start//
		$adsts=$action->insert_data('dcmpny_info',$_POST,$skip_valus);
		if ($adsts == 1){
			$msg = "Successfully Add!";
			$clor = green;
		}else{
			unlink($_POST['dcus_logo']);
			$msg = $adsts;
			$clor = red;
		}
		$sxcode = $_POST['dcmpny_cod'];
		$_SESSION[msg] = $msg;
		$_SESSION[clor] = $clor;
	}else if (isset($_POST[dcmpny_updt])){
		if($_POST['dcmpny_cod']!=NULL){
			$prv_imglnk = $cmncls->newpikval(dcmpny_info,dcmpny_cod,$_POST['dcmpny_cod']);
			if($_FILES['dcmpny_logo']['name'] !=NULL){
				$new_dcmpny_logo = $cmncls->img_uplod('dcmpny_logo','ap_img/cmp_logo/',4096*1024,'-'.$_POST['dcmpny_cod'].'-'.sprintf("%03s", $prv_imglnk[slno]));
				$prv_img =$prv_imglnk[dcmpny_logo]; 
			}else {
				$new_dcmpny_logo = $prv_imglnk[dcmpny_logo];
			}
			if($_FILES['dcmpny_logoi']['name'] !=NULL){
				$new_dcmpny_logoi = $cmncls->img_uplod('dcmpny_logoi','ap_img/cmp_logo/',4096*1024,'-'.$_POST['dcmpny_cod'].'-i'.sprintf("%03s", $prv_imglnk[slno]));
				$prv_imgi =$prv_imglnk[dcmpny_logoi]; 
			}else {
				$new_dcmpny_logoi = $prv_imglnk[dcmpny_logoi];
			}
			
			$skip_valus=array('dcmpny_updt','dcmpny_cod','ppg');
			$_POST['dcmpny_logo']=$new_dcmpny_logo;
			$_POST['dcmpny_logoi']=$new_dcmpny_logoi;
			$_POST['dupdt_id']=$_SESSION['user_id'];
			$updsts=$action->update_data('dcmpny_info',$_POST,$skip_valus,'dcmpny_cod',$_POST['dcmpny_cod']);
			if ($updsts == true){
				if(is_file($prv_img)){
					unlink($prv_img);
				}if(is_file($prv_imgi)){
					unlink($prv_imgi);
				}
				$msg = "Successfully Update";
				$clor = green;
			}else{
				if($_FILES['dcmpny_logo']['name'] !=NULL){
					if(is_file($new_dcmpny_logo)){
						unlink($new_dcmpny_logoi);
					}
				}
				$msg = "Can't Update! Please Check your all submitted value";
				$clor = red;
			}
		}else {
			$msg = "Can't Update! Please Select an Information...";
			$clor = red;
		}
		$sxcode = $_POST['dcmpny_cod'];
		$_SESSION[msg] = $msg;
		$_SESSION[clor] = $clor;
	}
	else if(isset($_POST[dcmpny_dlt])){
		$chksts = $action->chkdepnd(demp_info,dcmpny_cod,$_POST['dcmpny_cod']);
		if ($chksts==false){
			$dcmpny_logo = $cmncls->newpikval(dcmpny_info,dcmpny_cod,$_POST['dcmpny_cod']);
			$dcmpny_logo =$dcmpny_logo[dcmpny_logo]; 
			$action->select('dcmpny_info');
			$dlt_sts = $action->delete('dcmpny_info',dcmpny_cod,$_POST['dcmpny_cod']);
			if ($dlt_sts==true){
				if(is_file($dcmpny_logo)){
					unlink($dcmpny_logo);
				}
				$msg = "Successfully Delete!";
				$clor = green;
			}
		}else{
			$msg = "Can't Delete, This Company is locked by Employee Information!";
			$clor = red;
		}
		$sxcode = $_POST['dcmpny_cod'];
		$_SESSION[msg] = $msg;
		$_SESSION[clor] = $clor;
	}
	header("location:index.php?pg=".$_POST[ppg]."&&sx_code=".$sxcode);
}
?>
