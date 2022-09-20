<?php 
DEFINE('APP_NAME','EAZY-POS');
DEFINE('VERSION','2.0.1');
DEFINE('APP_PATH',ROOT_PATH.'apps/');
DEFINE('ASSET_PATH','assets/');
DEFINE('VIEWS','_views/');
DEFINE('CONTROLLER','_controller/');
DEFINE('REPORT','_report/');
DEFINE('REPORT_PATH',APP_PATH.REPORT);
DEFINE('FILE_PRFX',"_d");
//Jasper ENV//
DEFINE("REPORT_BASE",str_replace("\\", "/", ROOT_PATH));
DEFINE("REPORT_EXTENSION",".jasper");
DEFINE("REPORT_SERVER","http://localhost:8080/JavaBridge/java/Java.inc");
DEFINE("JASPER_PATH",REPORT_PATH.CONTROLLER."/jasper/");
DEFINE("JASPER_OUTPUT",ROOT_PATH."public/");
DEFINE("SERVICE_PROVIDER","Design & Developed By: AUB DEV Team 57th Batch (CSE).||Hotline: +88-01714-693114");
?>
