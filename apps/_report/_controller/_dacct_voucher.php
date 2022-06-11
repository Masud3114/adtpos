<?php
if($_SERVER['REQUEST_METHOD']==='GET' && defined('BASEPATH')){
	$exporter=new jasper_manager('acct_jv',"jasper");
	$prams=array(
		"root_path"			=>ROOT_PATH,
		"dev_auth"			=>SERVICE_PROVIDER,
		"svid"				=>$_GET['svid']
	);
	$exporter->render_report("pdf",$prams);
}
?>