<?php
if($_SERVER['REQUEST_METHOD']==='POST' && defined('BASEPATH')){
	$where_code=" 1 ";
	
	if(isset($_POST['acct_type']) && $_POST['acct_type']!=NULL){
		$where_code.=" AND acc_chart_of_account.acct_type='".$_POST['acct_type']."'";
	}
	if(isset($_POST['acct_usages']) && $_POST['acct_usages']!=NULL){
		$where_code.=" AND acc_chart_of_account.acct_usages='".$_POST['acct_usages']."'";
	}
	if(isset($_POST['acct_source']) && $_POST['acct_source']!=NULL){
		$where_code.=" AND acc_chart_of_account.acct_source='".$_POST['acct_source']."'";
	}
	
	$report_name="coa_accounts_list";
	$exporter=new jasper_manager($report_name,"jasper");
	$prams=array(
		"root_path"			=>	ROOT_PATH,
		"dev_auth"			=>	SERVICE_PROVIDER,
		"where_code"		=>	$where_code,
	);
	//echo "<pre>";
	//print_r($prams);
	//echo "<pre>";
	//exit;
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
	echo "Direct access forbidden!";
}
?>