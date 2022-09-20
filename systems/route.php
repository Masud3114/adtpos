<?php
if(defined('BASEPATH')){
	session_start();
	session_regenerate_id();
	ini_set('html_errors','off');
	require_once BASEPATH.'/env'.EXT;
	require_once BASEPATH.'/DB_Class/db_ config'.EXT;
	require_once BASEPATH.'/asset_class/_dcomn_db'.EXT;
	require_once BASEPATH.'/asset_class/_dcomn_cls'.EXT;
	require_once BASEPATH.'/asset_class/_log_in'.EXT;
	require_once BASEPATH.'/asset_class/_dmodule_manage'.EXT;
	require_once BASEPATH.'/asset_class/_dacctTran'.EXT;
	require_once BASEPATH.'/asset_class/_dfood_delivery'.EXT;
	$action 	= new database();
	$cmncls 	= new comncls();
	$login		= new log_in();
	if($login->chk_login()===true){
		
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post'){
			if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])//check AJAX Request//
			&& !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
			&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
				if(isset($_POST['dt_table']) && $_POST['dt_table']!=NULL){
					require_once BASEPATH.'/asset_class/ssp.class'.EXT;
					$post_path = APP_PATH."/_table/".FILE_PRFX.$_POST['dt_table'].EXT;
					if(is_file($post_path)){
						include $post_path;
					}else{
						return null;
					}
				}else if(isset($_POST['pgr']) && $_POST['pgr']!=NULL){
					require_once BASEPATH.'/jasper/jaspermanager'.EXT;
					$pg=$_POST['pgr'];
					$post_path = REPORT_PATH.CONTROLLER.FILE_PRFX.$pg.EXT;
					if(is_file($post_path)){
						include $post_path;
					}else{
						return null;
					}
				}else{
					$pg=$_POST['ppg'];
					$post_path = APP_PATH.CONTROLLER.FILE_PRFX.$pg.EXT;
					if(is_file($post_path)){
						include $post_path;
					}else{
						return null;
					}
				}
			}else{
				if ($_POST[ppg]!=NULL){
					$pg=str_replace('/','/_d',$_POST[ppg]);
					$post_path = APP_PATH.CONTROLLER.FILE_PRFX.$pg.EXT;
					if(is_file($post_path)){
						include $post_path;
					}else{
						require_once APP_PATH.'/Templates/main/header'.EXT;
						require_once APP_PATH.'/Templates/main/sidebar'.EXT;
						require_once APP_PATH.VIEWS.FILE_PRFX.'error'.EXT;
						require_once APP_PATH.'/Templates/main/footer'.EXT;
					}
				}
				if ($_GET['pgr']!=NULL){
					require_once BASEPATH.'/jasper/jaspermanager'.EXT;
					$pg=$_GET['pgr'];
					$post_path = REPORT_PATH.CONTROLLER.FILE_PRFX.$pg.EXT;
					if(is_file($post_path)){
						include $post_path;
					}
					else{
						require_once APP_PATH.'/Templates/main/header'.EXT;
						require_once APP_PATH.'/Templates/main/sidebar'.EXT;
						require_once APP_PATH.VIEWS.FILE_PRFX.'error'.EXT;
						require_once APP_PATH.'/Templates/main/footer'.EXT;
					}
				}
			}
		}else{
			if($_GET[sts]=='logout'){
				$login->logout();
				header("location:index".EXT);
			}else if(isset($_GET[rpt]) && $_GET[rpt]!=NULL){
				require_once BASEPATH.'/jasper/jaspermanager'.EXT;
				$pg=$_GET[rpt];
				$load_path = REPORT_PATH.CONTROLLER.FILE_PRFX.$pg.'.php';
				if(is_file($load_path)){
					include $load_path;
				}
			}else{
				require_once APP_PATH.'/Templates/main/header'.EXT;
				require_once APP_PATH.'/Templates/main/sidebar'.EXT;
				require_once APP_PATH.'/Templates/main/body'.EXT;
				require_once APP_PATH.'/Templates/main/footer'.EXT;
			}
		}
	}else{
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post'){
			if (isset($_POST['login'])){
				$login->create_login();
				header("location:index".EXT);
			}else if(isset($_POST['register'])){
				$login->create_user();
				header("location:index".EXT);
			}
			else{
				include APP_PATH.VIEWS.FILE_PRFX.'error'.EXT;
			}
		}else{
			if(isset($_GET['pg']) && $_GET['pg']==="NewUser"){
				require_once APP_PATH.'/Templates/auth/header.php';
				require_once APP_PATH.VIEWS.'register'.EXT;
				require_once APP_PATH.'/Templates/auth/footer.php';
			}else{
				require_once APP_PATH.'/Templates/auth/header.php';
				require_once APP_PATH.VIEWS.'log_in'.EXT;
				require_once APP_PATH.'/Templates/auth/footer.php';
			}
		}
	}
}else{
	echo "Directory access is forbidden";
	exit;
}
?>