<?php
if($_SERVER['REQUEST_METHOD']==='GET' && defined('BASEPATH')){
	$report_name="prdc_plan";
	$exporter=new jasper_manager($report_name,"jasper");
	$prams=array(
		"root_path"			=>ROOT_PATH,
		"sales_id"			=>$_GET['plid'],
		"SUBREPORT_DIR"		=>JASPER_PATH
	);
	$exporter->render_report("pdf",$prams);
}
?>