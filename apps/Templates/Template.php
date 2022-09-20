<?php
namespace Adt\apps\Templates;
use Adt\systems\DB_Class\Database;
Class Template extends Database{
	public function Auth($component){
		require_once APP_PATH.'/Templates/auth/header.php';
		require_once  APP_PATH.VIEWS.$component.EXT;
		require_once APP_PATH.'/Templates/auth/footer.php';
	}
	public function App(){
		require_once APP_PATH.'/Templates/main/header'.EXT;
		require_once APP_PATH.'/Templates/main/sidebar'.EXT;
		$this->AppBody();
		require_once APP_PATH.'/Templates/main/footer'.EXT;
	}
	Public function AppBody(){
		if (isset($_GET[pg]) && $_GET[pg]!=NULL){
			$pg=str_replace('/','/_d',$_GET[pg]);
			$viw_path = APP_PATH.VIEWS.FILE_PRFX.$pg.EXT;
			if(is_file($viw_path)){
				require_once $viw_path;
			}else{
				require_once APP_PATH.VIEWS.FILE_PRFX.'error'.EXT;;
			}
		}
		else if(isset($_GET[pgr]) && $_GET[pgr]!=NULL){
			$pg=$_GET[pgr];
			$viw_path = REPORT_PATH.VIEWS.FILE_PRFX.$pg.EXT;;
			if(is_file($viw_path)){
				require_once $viw_path;
			}else{
				require_once APP_PATH.VIEWS.FILE_PRFX.'error'.EXT;;
			}
		}
		else{
			$viw_path = APP_PATH.VIEWS.FILE_PRFX.'home'.EXT;;
			if(is_file($viw_path)){
				require_once $viw_path;
			}else{
				require_once APP_PATH.VIEWS.FILE_PRFX.'error'.EXT;;
			}
		}
	}
	public function Error404(){
		require_once BASEPATH.'/common/header'.EXT;
		require_once BASEPATH.'/common/sidebar'.EXT;
		include APP_PATH.VIEWS.FILE_PRFX.'error'.EXT;
		require_once BASEPATH.'/common/footer'.EXT;
	}
}

?>