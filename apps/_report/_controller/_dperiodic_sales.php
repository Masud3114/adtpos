<?php
if($_SERVER['REQUEST_METHOD']==='POST' && defined('BASEPATH')){
	if(isset($_POST['from_date']) 
		&& isset($_POST['to_date'])
		&& strtotime($_POST['to_date'])>=strtotime($_POST['from_date'])){
		$where_code=" inop_header.trn_cat IN ('0','1') ";
		$where_code_sub=null;
		$sales_type=array(
			'pos'		=>0,
			'gls'		=>1,
		);
		
		if(strtotime($_POST['to_date'])>strtotime($_POST['from_date'])){
			$where_code.=" AND (inop_header.trn_date between '".$_POST['from_date']."' AND '".$_POST['to_date']."') ";
			$heder_cap="(From ".date('d-m-Y',strtotime($_POST['from_date']))." to ".date('d-m-Y',strtotime($_POST['to_date'])).")";
		}else{
			$where_code.=" AND inop_header.trn_date = '".$_POST['from_date']."' ";
			$heder_cap="(".date('d-m-Y',strtotime($_POST['from_date'])).")";
		}
		if(isset($_POST['dcus_cod'])){
			$where_code.=" AND inop_header.trn_to='".$_POST['dcus_cod']."'";
		}
		if(isset($_POST['sales_type']) && $_POST['sales_type']!=NULL){
			$where_code.=" AND inop_header.trn_cat='".$sales_type[$_POST['sales_type']]."'";
		}
		
		$report_name="prdc_sales";
		$exporter=new jasper_manager($report_name,"jasper");
		$prams=array(
			"root_path"			=>	ROOT_PATH,
			"dev_auth"			=>	SERVICE_PROVIDER,
			"heder_cap"			=>	$heder_cap,
			"where_code"		=>	$where_code,
			"where_code_sub"	=>	$where_code_sub,
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
		echo "Direct access forbidden!";
	}
}else{
	echo "Direct access forbidden!";
}
?>