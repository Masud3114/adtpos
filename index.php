<?php
ob_start();
ini_set('max_execution_time',0); 
DEFINE('ROOT_PATH', dirname(__FILE__)."/");
DEFINE('EXT', '.php');
DEFINE('BASEPATH', ROOT_PATH."/".str_replace("\\", "/", 'systems'));
require_once ROOT_PATH.'/vendor/autoload.php';
require_once BASEPATH.'/route'.EXT;
?>