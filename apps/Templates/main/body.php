<?php
if(defined('BASEPATH')){
	if (isset($_GET[pg]) && $_GET[pg]!=NULL){
		$pg=str_replace('/','/_d',$_GET[pg]);
		$viw_path = APP_PATH.VIEWS.FILE_PRFX.$pg.EXT;
		if(is_file($viw_path)){
			include $viw_path;
		}else{
			include APP_PATH.VIEWS.FILE_PRFX.'error.php';
		}
	}
	else if(isset($_GET[pgr]) && $_GET[pgr]!=NULL){
		$pg=$_GET[pgr];
		$viw_path = REPORT_PATH.VIEWS.FILE_PRFX.$pg.'.php';
		if(is_file($viw_path)){
			include $viw_path;
		}else{
			include APP_PATH.VIEWS.FILE_PRFX.'error.php';
		}
	}
	else{
		$viw_path = APP_PATH.VIEWS.FILE_PRFX.'home.php';
		if(is_file($viw_path)){
			include $viw_path;
		}else{
			include APP_PATH.VIEWS.FILE_PRFX.'error.php';
		}
	}
}else{
	echo "Directory access is forbidden";
	exit;
}