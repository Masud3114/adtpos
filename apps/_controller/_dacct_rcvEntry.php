<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
	&& !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
	&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		if(isset($_POST['acctCode'])){
			$chk_sql="SELECT * FROM acc_chart_of_account WHERE acc_chart_of_account.acct_code='".$_POST['acctCode']."'";
			$rtn_qry=$action->execute_query($chk_sql);
			if(@mysql_num_rows($rtn_qry)>0){
				$data=@mysql_fetch_assoc($rtn_qry);
				if($data['acct_source']==1){
					$rtn_data=array(
						"sts"			=>1,
						"fieldName"		=>"dcus_cod"
					);
				}else if($data['acct_source']==5){
					$rtn_data=array(
						"sts"			=>1,
						"fieldName"		=>"dsup_cod"
					);
				}else{
					$rtn_data=array(
						"sts"			=>0,
						"fieldName"		=>"dsup_cod"
					);
				}
			}
			echo json_encode($rtn_data);
			exit;
		}
	}else if(isset($_POST['glheader_ad'])){
		//insert header data here//
		$data=array();
		$data=$_POST;
		$data['slno'] 		= $action->getslno('acct_glheader');
		$data['dent_id'] 	= $_SESSION['user_id'];
		$data['prfx_name'] = "RE-";
		
		$data['xvoucher']=$cmncls->gen_xvoucher($data['prfx_name'],$_POST['xdate']);
		$skip_valus=array('glheader_ad','ppg');
		$adsts=$action->insert_data('acct_glheader',$data,$skip_valus);
		if ($adsts == 1){
			$msg = "Successfully Add!";
			$clor = green;
		}else{
			$msg = $adsts;
			$clor = red;
		}
		$sxcode = $data['slno'];
	}else if(isset($_POST['glheader_updt'])){
		//Update Start from here.....//
		$skip_valus=array('glheader_updt','xvoucher','slno','ppg');
		$_POST['dupdt_id']=$_SESSION['user_id'];
		$updsts=$action->update_data('acct_glheader',$_POST,$skip_valus,'slno',$_POST['slno']);
		if ($updsts == true){
			$msg = "Successfully Update";
			$clor = green;
		}else{
			$msg = "Can't Update! Please Check your all submitted value! ";
			$clor = red;
		}
		$sxcode = $_POST['slno'];
	}else if(isset($_POST['glheader_dlt'])){
		if ($_SESSION['user_id'] === 'USER-000001'){
			$whr_cod = "where slno = '".$_POST['slno']."' and sts ='1'";
			$dlt_sts = $action->delete('acct_glheader','','',$whr_cod);
			if ($dlt_sts==1){
				$msg = "Successfully Delete!";
				$clor = green;
			}else {
				$msg = $dlt_sts;
				$clor = red;
			}
			$sxcode = $_POST['slno'];
		}
	}else if(isset($_POST['gldetails_ad'])){
		//insert details data here//
		$data=array();
		$data=$_POST;
		if(isset($data['dcus_cod']) || isset($data['dsup_cod'])){
			$data['acct_code_sub']=$data['dcus_cod']!=null?$data['dcus_cod']:$data['dsup_cod'];
			unset($data['dcus_cod']);
			unset($data['dsup_cod']);
		}
		$data['slno'] 		= $action->getslno('acct_gldetail');
		$data['dent_id'] 	= $_SESSION['user_id'];
		
		$skip_valus=array('gldetails_ad','ppg');
		$adsts=$action->insert_data('acct_gldetail',$data,$skip_valus);
		if ($adsts == 1){
			$msg = "Successfully Add!";
			$clor = green;
		}else{
			$msg = $adsts;
			$clor = red;
		}
		$sxcode = $data['hslno'];
		$sx_cods = $data['slno'];
	}else if(isset($_POST['gldetails_updt'])){
		//Update Start from here.....//
		if(isset($_POST['dcus_cod']) || isset($_POST['dsup_cod'])){
			$_POST['acct_code_sub']=$_POST['dcus_cod']!=null?$_POST['dcus_cod']:$_POST['dsup_cod'];
			unset($_POST['dcus_cod']);
			unset($_POST['dsup_cod']);
		}
		$skip_valus=array('gldetails_updt','slno','ppg');
		$_POST['dupdt_id']=$_SESSION['user_id'];
		$updsts=$action->update_data('acct_gldetail',$_POST,$skip_valus,'slno',$_POST['slno']);
		if ($updsts == true){
			$msg = "Successfully Update";
			$clor = green;
		}else{
			$msg = "Can't Update! Please Check your all submitted value! ";
			$clor = red;
		}
		$sxcode = $_POST['hslno'];
		$sx_cods = $_POST['slno'];
	}else if(isset($_POST['gldetails_dlt'])){
		if ($_SESSION['user_id'] === 'USER-000001'){
			$whr_cod = "where slno = '".$_POST['slno']."' and sts ='1'";
			$dlt_sts = $action->delete('acct_gldetail','','',$whr_cod);
			if ($dlt_sts==1){
				$msg = "Successfully Delete!";
				$clor = green;
			}else {
				$msg = $dlt_sts;
				$clor = red;
			}
		}
		$sxcode = $_POST['hslno'];
		$sx_cods = $_POST['slno'];
	}
	$_SESSION['clor'] = $clor;
	$_SESSION['msg'] = $msg;
	header("location:index.php?pg=".$_POST['ppg']."&&sx_code=".$sxcode.(isset($sx_cods)?'&&sx_cods='.$sx_cods:''));
}else{
	die('Direct access forbidden');
}
?>