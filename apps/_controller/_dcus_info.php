<?php
if(isset($_POST[dcus_ad])){
	$chksts = $action->chkdepnd(dcus_info,dcus_num,$_POST['dcus_num']);
	if ($chksts==false){
		$_POST['slno'] = $action->getslno('dcus_info');
		$_POST['dcus_cod'] = "CUS-" . sprintf("%08s", $_POST['slno']);
		$skip_valus=array('dcus_ad','ppg');
		
		//image code start//
		if($_FILES['dcus_logo']['name'] !=NULL){
			$_POST['dcus_logo'] = $cmncls->img_uplod('dcus_logo','ap_img/cus_logo/',4096*1024,'-'.$_POST['dcmpny_cod'].'-'.sprintf("%03s", $prv_imglnk[slno]));
		}
		$_POST['dent_id']=$_SESSION['user_id'];
		//end image code start//
		$adsts=$action->insert_data('dcus_info',$_POST,$skip_valus);
		if ($adsts == 1){
			$msg = "Successfully Add!";
			$clor = green;
		}else{
			unlink($_POST['dcus_logo']);
			$msg = $adsts;
			$clor = red;
		}
	}else{
		$msg = "Already added!";
		$clor = red;
	}
	$sxcode = $_POST['dcus_cod'];
	$_SESSION[msg] = $msg;
	$_SESSION[clor] = $clor;
}else if (isset($_POST[dcus_updt])){
	if($_POST['dcus_cod']!=NULL){
		$prv_imglnk = $cmncls->newpikval('dcus_info','dcus_cod',$_POST['dcus_cod']);
		if($_FILES['dcus_logo']['name'] !=NULL){
			$new_dcus_logo = $cmncls->img_uplod('dcus_logo','ap_img/cus_logo/',4096*1024,'-'.$_POST['dcus_cod'].'-'.sprintf("%03s", $prv_imglnk[slno]));
			$prv_img =$prv_imglnk['dcus_logo']; 
		}
		$skip_valus=array('dcus_updt','dcus_cod','ppg');
		$_POST['dcus_logo']=$new_dcus_logo;
		$_POST['dupdt_id']=$_SESSION['user_id'];
		$updsts=$action->update_data('dcus_info',$_POST,$skip_valus,'dcus_cod',$_POST['dcus_cod']);
		if ($updsts == true){
			if(is_file($prv_img)){
				unlink($prv_img);
			}
			$msg = "Successfully Update";
			$clor = green;
		}else{
			if($_FILES['dcmpny_logo']['name'] !=NULL){
				if(is_file($new_dcus_logo)){
					unlink($new_dcus_logo);
				}
			}
			$msg = "Can't Update! Please Check your all submitted value";
			$clor = red;
		}
	}else {
		$msg = "Can't Update! Please Select an Information...";
		$clor = red;
	}
	$sxcode = $_POST['dcus_cod'];
	$_SESSION[msg] = $msg;
	$_SESSION[clor] = $clor;
}else if(isset($_POST[dcus_dlt])){
	$dcus_logo = $cmncls->newpikval(dcus_info,dcus_cod,$_POST['dcus_cod']);
	$dcus_logo =$dcus_logo[dcus_logo];
	$dlt_sts = $action->delete('dcus_info',dcus_cod,$_POST['dcus_cod']);
	if ($dlt_sts==true){
		if(is_file($dcus_logo)){
			unlink($dcus_logo);
		}
		$msg = "Successfully Delete!";
		$clor = green;
	}
	$sxcode = $_POST['dcus_cod'];
	$_SESSION[msg] = $msg;
	$_SESSION[clor] = $clor;
}
else if(isset($_POST[upload_attach])){
	if(isset($_POST[dcus_cod]) && $_POST[dcus_cod]!=NULL){
		$valid_formats = array("jpg", "png", "gif", "zip", "bmp", "pdf", "doc", "xls", "docx", "xlsx");
		$max_file_size = 1024*1024*10; //100 kb
		$path = "ap_img/cus_attach/"; // Upload directory
		$count = 0;
		foreach ($_FILES['attach_file']['name'] as $f => $name){
			$file_cap=$name;
			if ($_FILES['attach_file']['error'][$f] == 4){
				continue; // Skip file if any error found
			}
			if ($_FILES['attach_file']['error'][$f] == 0){
				if ($_FILES['attach_file']['size'][$f] > $max_file_size){
					$message.=$name." is too large!<br/>";
					$clor=red;
					continue; // Skip large files
				}elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
					$message.="$name is not a valid format<br/>";
					$clor=red;
					continue; // Skip invalid file formats
				}else{ // No error found! Move uploaded files 
					$ext=pathinfo($name, PATHINFO_EXTENSION);
					$new_name=date('HYmIdis').".".$ext;
					$name=$path.$f.$new_name;
					if(move_uploaded_file($_FILES["attach_file"]["tmp_name"][$f],$name)){
						$query = "INSERT INTO dcus_attach(dcus_cod, file_cap, file_path, dent_id,zid) VALUES 
						('".$_POST['dcus_cod']."', '".$file_cap."', '".$name."', '".$_SESSION['user_id']."', '".$_SESSION['zid']."')";
						$cmncls->sqlqry($query);
						$count++; // Number of successfully uploaded files
					}
				}
			}
		}
		if($count>0){
			$message.="Successfully Upload ".$count." Files";
			$clor=green;
		}
	}else{
		$message.="Please select a query";
		$clor=red;
	}
	$sxcode = $_POST['dcus_cod'];
	$_SESSION[msg] = $message;
	$_SESSION[clor] = $clor;
}
if(isset($_POST[axaj_action_form])){
	if($_POST[axaj_action_form]=='delete_attachfile'){
		$pickval = $cmncls->newpikval(dcus_attach,slno,$_POST[selector_id]);
		$del_sql="delete from dcus_attach where slno='".$_POST[selector_id]."' AND zid='".$_SESSION['zid']."'";
		$cmncls->sqlqry($del_sql);
		if(@mysql_affected_rows()>0 && !@mysql_errno()){
			if(is_file($pickval[file_path])){
				unlink($pickval[file_path]);
			}
			$rtn_msg = 'Deleted!';
		}else{
			$rtn_msg = @mysql_errno() . '- Error' . @mysql_error();
		}
	}
	$status = array(
		'txtmsg' => $rtn_msg
	);
	echo json_encode($status);
}else{
	header("location:index.php?pg=".$_POST[ppg]."&&sx_code=".$sxcode);
}
?>
