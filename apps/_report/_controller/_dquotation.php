<?php
if($_SERVER['REQUEST_METHOD']==='GET' && defined('BASEPATH')){
	$report_name="quotation";
	$inv_id=$_GET['qid'];
	
	$exporter=new jasper_manager($report_name,"jasper");
	$prams=array(
		"root_path"			=>ROOT_PATH,
		"sales_id"			=>$inv_id,
		"SUBREPORT_DIR"		=>JASPER_PATH
	);
	$exporter->render_report("pdf",$prams);
}
?>