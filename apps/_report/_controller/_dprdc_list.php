<?php
if($_SERVER['REQUEST_METHOD']==='POST' && defined('BASEPATH')){
	$report_name="product_list";
	$where_code= " 1 ";
	if(isset($_POST['item_cat'])){
		$where_code.=" AND vicat_info.slno IN (".$cmncls->m_implode($_POST['item_cat']).")";
	}
	if(isset($_POST['item_type'])){
		$where_code.=" AND vitype_info.slno IN(".$cmncls->m_implode($_POST['item_type']).")";
	}
	if(isset($_POST['item_brand'])){
		$where_code.=" AND vibrand_info.slno IN (".$cmncls->m_implode($_POST['item_brand']).")";
	}
	if(isset($_POST['item_color'])){
		$where_code.=" AND vicolor_info.slno IN (".$cmncls->m_implode($_POST['item_color']).")";
	}
	if(isset($_POST['item_code'])){
		$where_code.=" AND i.item_code IN (".$cmncls->m_implode($_POST['item_code']).")";
	}
	if(isset($_POST['bar_code'])){
		$where_code.=" AND (i.bar_cod is not null AND i.bar_cod !='')";
		$report_name="product_barcode";
		if(isset($_POST['bar_code_qty'])){
			$barcode_qty=$_POST['bar_code_qty'];
		}else{
			$barcode_qty=1;
		}
		$prams=array(
			"root_path"			=>	ROOT_PATH,
			"where_code"		=>	$where_code,
			"barcode_qty"		=>	$barcode_qty,
		);
	}else{
		$prams=array(
			"root_path"			=>	ROOT_PATH,
			"where_code"		=>	$where_code,
		);
	}
	$exporter=new jasper_manager($report_name,"jasper");
		
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
}
?>