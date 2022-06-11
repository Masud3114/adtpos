<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])//check AJAX Request//
&& !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
}else if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST[dcmpinfo_ad])){
		$_POST['slno'] = $action->getslno('company_info');
		//image code start 
		if($_FILES['info_banner']['name'] !=NULL){
			$_POST['info_banner'] = $cmncls->img_uplod('info_banner','ap_img/cmp_banner/',4096*1024,'-'.date('YmdHis').'-'.sprintf("%03s", $_POST['slno']));
		}
		else{
			$_POST['info_banner'] ="";
		}
		$skip_valus=array('dcmpinfo_ad','ppg');
		$_POST['dent_id']=$_SESSION['user_id'];
		$adsts=$action->insert_data('company_info',$_POST,$skip_valus);
		if ($adsts == 1){
			$msg = "Successfully Add!";
			$clor = green;
		}else{ 
			if(is_file($_POST['info_banner'])){
				unlink($_POST['info_banner']);
			}
			$msg = $adsts;
			$clor = red;
		}
		$sxcode = $_POST['slno'];
		$_SESSION['msg'] = $msg;
		$_SESSION['clor'] = $clor;
	}
	else if (isset($_POST['dcmpinfo_updt'])){
		if($_POST['slno']!=NULL){
			$prv_imglnk = $cmncls->newpikval('company_info','slno',$_POST['slno']);
			if($_FILES['info_banner']['name'] !=NULL){
				$new_info_banner = $cmncls->img_uplod('info_banner','ap_img/cmp_banner/',4096*1024,'-'.date('YmdHis').'-'.sprintf("%03s", $_POST['slno']));
				$prv_img =$prv_imglnk['info_banner']; 
			}else{
				$new_info_banner = $prv_imglnk['info_banner'];
			}
			$skip_valus=array('dcmpinfo_updt','slno','ppg');
			$_POST['info_banner']=$new_info_banner;
			$_POST['dupdt_id']=$_SESSION['user_id'];
			$updsts=$action->update_data('company_info',$_POST,$skip_valus,'slno',$_POST['slno']);
			if ($updsts == true){
				if(is_file($prv_img)){
					unlink($prv_img);
				}
				$msg = "Successfully Update";
				$clor = green;
			}else{ 
				if($_FILES['info_banner']['name'] !=NULL){
					if(is_file($new_info_banner)){
						unlink($new_info_banner);
					}
				}
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
	}else if(isset($_POST['dcmpinfo_dlt'])){
		$info_banner = $cmncls->newpikval('company_info','slno',$_POST['slno']);
		$info_banner =$info_banner['info_banner'];
		$dlt_sts = $action->delete('company_info','slno',$_POST['slno']);
		if ($dlt_sts==true){
			if(is_file($info_banner)){
				unlink($info_banner);
			}
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
