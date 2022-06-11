<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])//check AJAX Request//
&& !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
}else if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST[dteam_ad])){
		$_POST['slno'] = $action->getslno('team_info');
		//image code start 
		if($_FILES['member_photo']['name'] !=NULL){
			$_POST['member_photo'] = $cmncls->img_uplod('member_photo','ap_img/emp_img/',4096*1024,'-'.date('YmdHis').'-'.sprintf("%03s", $_POST['slno']));
		}
		else{
			$_POST['member_photo'] ="";
		}
		//image code end 
		$skip_valus=array('dteam_ad','ppg');
		$_POST['dent_id']=$_SESSION['user_id'];
		$adsts=$action->insert_data('team_info',$_POST,$skip_valus);
		if ($adsts == 1){
			$msg = "Successfully Add!";
			$clor = green;
		}else{ 
			if(is_file($_POST['member_photo'])){
				unlink($_POST['member_photo']);
			}
			$msg = $adsts;
			$clor = red;
		}
		$sxcode = $_POST['slno'];
		$_SESSION['msg'] = $msg;
		$_SESSION['clor'] = $clor;
	}
	else if (isset($_POST['dteam_updt'])){
		if($_POST['slno']!=NULL){
			$prv_imglnk = $cmncls->newpikval('team_info','slno',$_POST['slno']);
			if($_FILES['member_photo']['name'] !=NULL){
				$new_member_photo = $cmncls->img_uplod('member_photo','ap_img/emp_img/',4096*1024,'-l'.date('YmdHis').'-'.sprintf("%03s", $_POST['slno']));
				$prv_img =$prv_imglnk['member_photo']; 
			}else{
				$new_member_photo = $prv_imglnk['member_photo'];
			}
			$skip_valus=array('dteam_updt','slno','ppg');
			$_POST['member_photo']=$new_member_photo;
			$_POST['dupdt_id']=$_SESSION['user_id'];
			$updsts=$action->update_data('team_info',$_POST,$skip_valus,'slno',$_POST['slno']);
			if ($updsts == true){
				if(is_file($prv_img)){
					unlink($prv_img);
				}
				$msg = "Successfully Update";
				$clor = green;
			}else{ 
				if($_FILES['member_photo']['name'] !=NULL){
					if(is_file($new_member_photo)){
						unlink($new_member_photo);
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
	}else if(isset($_POST['dteam_dlt'])){
		$team_info = $cmncls->newpikval('team_info','slno',$_POST['slno']);
		$member_photo =$team_info['member_photo'];
		$dlt_sts = $action->delete('team_info','slno',$_POST['slno']);
		if ($dlt_sts==true){
			if(is_file($member_photo)){
				unlink($member_photo);
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
