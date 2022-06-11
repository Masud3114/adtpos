<?php
if($_SERVER['REQUEST_METHOD']==='POST' && defined('BASEPATH')){
	if($_POST['from_date'] <= $_POST['to_date']){
		$first_xdate=date('Y-m-',strtotime($_POST['from_date']))."1";
		$last_xdate=date('Y-m-t',strtotime($_POST['from_date']));
		$from_date=$_POST['from_date'];
		$to_date=$_POST['to_date'];
		if($_POST['from_date'] == $_POST['to_date']){
			$where_code = " acct_glheader.xdate='".$_POST['from_date']."'";
			$header_cap = "Daily (".date('d-M-Y',strtotime($_POST['from_date'])).")";
		}else{
			$where_code = " (acct_glheader.xdate BETWEEN '".$_POST['from_date']."' AND '".$_POST['to_date']."')";
			if(strtotime($first_xdate)==strtotime($_POST['from_date']) && 
			strtotime($last_xdate)==strtotime($_POST['to_date'])){
				$header_cap = "Monthly (".date('F-Y',strtotime($_POST['from_date'])).")";
			}else{
				$header_cap = "Period : (".date('d-M-Y',strtotime($_POST['from_date']))." TO ".date('d-M-Y',strtotime($_POST['from_date'])).")";
			}
		}
		if(isset($_POST['acct_code']) && $_POST['acct_code']!=NULL){
			$where_code.=" AND acct_gldetailv.acct_code='".$_POST['acct_code']."'";
		}
		if(isset($_POST['acct_code_sub']) && $_POST['acct_code_sub']!=NULL){
			$where_code.=" AND acct_gldetailv.acct_code_sub='".$_POST['acct_code_sub']."'";
		}
		
		if(isset($_POST['acct_type']) && $_POST['acct_type']!=NULL){
			$where_code.=" AND acct_gldetailv.acct_typec='".$_POST['acct_type']."'";
		}
		if(isset($_POST['acct_usages']) && $_POST['acct_usages']!=NULL){
			$where_code.=" AND acct_gldetailv.acct_usagesc='".$_POST['acct_usages']."'";
		}
		if(isset($_POST['acct_source']) && $_POST['acct_source']!=NULL){
			$where_code.=" AND acct_gldetailv.acct_sourcec='".$_POST['acct_source']."'";
		}
		
		$report_name="gl_ledger";
		$exporter=new jasper_manager($report_name,"jasper");
		$prams=array(
			"root_path"			=>	ROOT_PATH,
			"dev_auth"			=>	SERVICE_PROVIDER,
			"where_code"		=>	$where_code,
			"from_date"			=>	$from_date,
			"to_date"			=>	$to_date,
			"header_cap"		=>	$header_cap,
		);
		if(!isset($_POST['view_report'])){
			if(isset($_POST['export_excel'])){
				$outpout_path=$exporter->render_report("xls",$prams);
			}else if(isset($_POST['export_word'])){
				$outpout_path=$exporter->render_report("doc",$prams);
			}
			$outpout_path=str_replace("\\","/",$outpout_path);
			$exporter->DownloadFile($outpout_path);
		}else{
			$exporter->render_report("pdf",$prams);
		}
	}else{
		echo "Selected Date Invalid!";
	}
}else{
	echo "Direct access forbidden!";
}
?>