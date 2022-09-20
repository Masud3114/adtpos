<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['dusr_ad'])){
		$ins_data=$_POST;
		$ins_data['dusr_pswd'] = $cmncls->encryptIt($_POST['dusr_pswd']);
		$ins_data['slno'] = $action->getslno('dusr_info');
		$dusr_id = "USER-".sprintf("%06s", $ins_data['slno']);
		//image code start 
		if($_FILES['dusr_img']['name'] !=NULL){
			$dusr_img = $cmncls->img_uplod('dusr_img','ap_img/user_img/',4096*1024,'-'.$dusr_id.'-'.sprintf("%04s", $ins_data['slno']));
		}
		else{
			$dusr_img =null;;
		}
		$ins_data['dusr_id'] 	= $dusr_id;
		$ins_data['dusr_img'] 	= $dusr_img;
		$ins_data['dent_id'] 	=$_SESSION['user_id'];
		$skip_valus=array('dusr_ad','ppg');
		$adsts=$action->insert_data('dusr_info',$ins_data,$skip_valus);
		if ($adsts == 1){
			$msg = "Successfully Add!";
			$clor = green;
		}else{
			if(is_file($dusr_img)){
				unlink($dusr_img);
			}
			$msg = $adsts;
			$clor = red;
		}
		$sxcode = $dusr_id;
	}else if (isset($_POST['dusr_updt'])){
		if ($_POST['dusr_id']!=NULL
		&& ($_POST['dusr_id'] === $_SESSION['user_id'] || $_SESSION['user_id']==='USER-000001')){
			$prv_imglnk = $cmncls->newpikval('dusr_info','dusr_id',$_POST['dusr_id']);
			if($_FILES['dusr_img']['name'] !=NULL){
				$new_dusr_img = $cmncls->img_uplod('dusr_img','ap_img/user_img/',4096*1024,'-'.$_POST['dusr_id'].'-'.sprintf("%03s", $prv_imglnk[slno]));
				$prv_img =$prv_imglnk[dusr_img]; 
			}else{
				$new_dusr_img = NULL;
			}
			$_POST['dusr_img']=$new_dusr_img;
			$skip_valus=array('dusr_updt','ppg','dusr_id');
			if($_POST['dusr_pswd']==''){
				$skip_valus[] = 'dusr_pswd';
			}else{
				$_POST['dusr_pswd'] = $cmncls->encryptIt($_POST['dusr_pswd']);
			}
			$_POST['dupdt_id']=$_SESSION['user_id'];
			$updsts=$action->update_data('dusr_info',$_POST,$skip_valus,'dusr_id',$_POST['dusr_id']);
			if ($updsts == true){
				if($new_dusr_img != NULL && is_file($prv_img)){
					unlink($prv_img);
				}
				$msg = "Successfully Update";
				$clor = green;
			}else{
				if(is_file($new_dusr_img)){
					unlink($prv_img);
				}
				$msg = "Can't Update! Please Check your all submitted value! ";//.$updsts;
				$clor = red;
			}
			$sxcode = $_POST['dusr_id'];
		}
	}else if(isset($_POST['dusr_dlt'])){
		if ($_POST['dusr_id'] === $_SESSION['user_id'] || $_SESSION['user_id']==='USER-000001'){
			$whr_cod = "where dusr_id = '".$_POST['dusr_id']."' and sts ='1'";
			$dusr_img = $cmncls->newpikval('dusr_info','dusr_id',$_POST['dusr_id']);
			$dusr_img =$dusr_img['dusr_img'];
			$dlt_sts = $action->delete('dusr_info','','',$whr_cod);
			if ($dlt_sts==1){
				$msg = "Successfully Delete!";
				$clor = green;
				if(is_file($dusr_img)){
					unlink($dusr_img);
				}
			}else {
				$msg = $dlt_sts;
				$clor = red;
			}
			$sxcode = $_POST['dusr_id'];
		}
	}
	$_SESSION['clor'] = $clor;
	$_SESSION['msg'] = $msg;
	header("location:index.php?pg=".$_POST[ppg]."&&sx_code=".$sxcode);
}else{
	die('Direct access forbidden');
}