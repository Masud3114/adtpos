<?php
if($_SERVER['REQUEST_METHOD']==='POST' && defined('BASEPATH')){
	$where_code=null;
	if(isset($_POST['item_cat'])){
		$where_code.=" item_info.item_cat IN (".$cmncls->m_implode($_POST['item_cat']).")!!";
	}
	if(isset($_POST['item_type'])){
		$where_code.=" item_info.item_type IN(".$cmncls->m_implode($_POST['item_type']).")!!";
	}
	if(isset($_POST['item_brand'])){
		$where_code.=" item_info.item_brand IN (".$cmncls->m_implode($_POST['item_brand']).")!!";
	}
	if(isset($_POST['item_code'])){
		$where_code.=" item_info.item_code IN (".$cmncls->m_implode($_POST['item_code']).")!!";
	}
	if($where_code!=NULL){
		$where_code=substr($where_code, 0, -2);
		$where_code=str_replace("!!"," AND ",$where_code);
	}else{
		$where_code="1";
	}
	//echo $where_code;
	//exit;
	$report_name="stock_report";
	$exporter=new jasper_manager($report_name,"jasper");
	$prams=array(
		"root_path"			=>	ROOT_PATH,
		"dev_auth"			=>	SERVICE_PROVIDER,
		"where_code"		=>	$where_code,
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
}
?>