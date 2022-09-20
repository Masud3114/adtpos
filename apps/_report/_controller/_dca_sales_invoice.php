<?php
if($_SERVER['REQUEST_METHOD']==='GET' && defined('BASEPATH')){
	if(isset($_GET['sid']) && $_GET['sid']!=NULL){
		$report_name="cs_invoice";
		$inv_id=$_GET['sid'];
	}else if(isset($_GET['spid']) && $_GET['spid']!=NULL){
		$report_name="pos_invoice";
		$inv_id=$_GET['spid'];
	}
	$exporter=new jasper_manager($report_name,"jasper");
	$prams=array(
		"root_path"			=>ROOT_PATH,
		"sales_id"			=>$inv_id,
		"zid"				=>$_SESSION['zid'],
		"SUBREPORT_DIR"		=>JASPER_PATH
	);
	$exporter->render_report("pdf",$prams);
}
?>