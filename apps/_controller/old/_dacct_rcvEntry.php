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
		$data['prfx_name']="RE-";
		$data['slno'] 		= $action->getslno('acct_glheader');
		$data['dent_id'] 	= $_SESSION['user_id'];
		$data['xvoucher']=$cmncls->gen_xvoucher($data['prfx_name'],$_POST['xdate']);
		$skip_valus=array('glheader_ad','dcus_cod','acct_code_rcv','xamount','ppg');
		$adsts=$action->insert_data('acct_glheader',$data,$skip_valus);
		if ($adsts == 1){
			$acc_details=array(array(
				'hslno'				=>$data['slno'],
				'acct_code'			=>'11-000004',					// Receivable Head //
				'acct_code_sub'		=>$_POST['dcus_cod'],			// Receivable Customer Head //
				'xdebit'			=>0,							// Total Sales Amount Excluding Discount & VAT//
				'xcredit'			=>$_POST['xamount'],
				'dent_id'			=>$_SESSION['user_id']
			),array(
				'hslno'				=>$data['slno'],
				'acct_code'			=>$_POST['acct_code_rcv'],		// Receivable Head //
				'xdebit'			=>$_POST['xamount'],			// Total Sales Amount Excluding Discount & VAT//
				'xcredit'			=>0,
				'dent_id'			=>$_SESSION['user_id']
			));
			foreach($acc_details as $acc_RowData){
				$adDetailSts=$action->insert_data('acct_gldetail',$acc_RowData);
			}
			$msg = "Successfully Add!";
			$clor = green;
		}else{
			$msg = $adsts;
			$clor = red;
		}
		$sxcode = $data['slno'];
	}else if(isset($_POST['glheader_updt'])){
		if ($_SESSION['access_code'] === 'admin'){
			//Update Start from here.....//
			$skip_valus=array('glheader_updt','xvoucher','slno','dcus_cod','acct_code_rcv','xamount','ppg');
			$_POST['dupdt_id']=$_SESSION['user_id'];
			$updsts=$action->update_data('acct_glheader',$_POST,$skip_valus,'slno',$_POST['slno']);
			if ($updsts == true){
				$whr_cod = "where hslno = '".$_POST['slno']."' and sts ='1'";
				$dlt_sts = $action->delete('acct_gldetail','','',$whr_cod);
				if ($dlt_sts==1){
					$acc_details=array(array(
						'hslno'				=>$_POST['slno'],
						'acct_code'			=>'11-000004',					// Receivable Head //
						'acct_code_sub'		=>$_POST['dcus_cod'],			// Receivable Customer Head //
						'xdebit'			=>0,							// Total Sales Amount Excluding Discount & VAT//
						'xcredit'			=>$_POST['xamount'],
						'dent_id'			=>$_SESSION['user_id']
					),array(
						'hslno'				=>$_POST['slno'],
						'acct_code'			=>$_POST['acct_code_rcv'],		// Receivable Head //
						'xdebit'			=>$_POST['xamount'],			// Total Sales Amount Excluding Discount & VAT//
						'xcredit'			=>0,
						'dent_id'			=>$_SESSION['user_id']
					));
					foreach($acc_details as $acc_RowData){
						$adDetailSts=$action->insert_data('acct_gldetail',$acc_RowData);
					}
					$msg = "Successfully Update";
					$clor = green;
				}else {
					$msg = $dlt_sts;
					$clor = red;
				}
			}else{
				$msg = "Can't Update! Please Check your all submitted value! ";
				$clor = red;
			}
		}else{
			$msg = "Sprry! You have not permission!";
			$clor = red;
		}
		$sxcode = $_POST['slno'];
	}else if(isset($_POST['glheader_dlt'])){
		if ($_SESSION['access_code'] === 'admin'){
			$whr_cod = "where hslno = '".$_POST['slno']."' and sts ='1'";
			$dlt_sts = $action->delete('acct_gldetail','','',$whr_cod);
			if ($dlt_sts==1){
				$whr_cod = "where slno = '".$_POST['slno']."' and sts ='1'";
				$dlt_sts = $action->delete('acct_glheader','','',$whr_cod);
				if ($dlt_sts==1){
					$msg = "Successfully Delete!";
					$clor = green;
				}else {
					$msg = $dlt_sts;
					$clor = red;
				}
			}else{
				$msg = "Somthing is wrong!";
				$clor = red;
			}
			$sxcode = $_POST['slno'];
		}else{
			$msg = "Sprry! You have not permission!";
			$clor = red;
		}
	}
	$_SESSION['clor'] = $clor;
	$_SESSION['msg'] = $msg;
	header("location:index.php?pg=".$_POST['ppg']."&&sx_code=".$sxcode);
}else{
	die('Direct access forbidden');
}
?>