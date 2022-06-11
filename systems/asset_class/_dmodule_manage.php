<?php
class module_manage extends comncls{
	private $menu_data=array();
	function get_menulist($by_user){
		$sql_cmd="SELECT slno, parent_slno, module_name, 
					module_description, link_caption, link_url,link_type,
					url_icon
					FROM usystem_module
					where sts = '1' and user_id='".$by_user."'
					ORDER BY parent_slno, index_slno";
		$sql_query=$this->sqlqry($sql_cmd);
		if(!@mysql_errno()){
			while($data=@mysql_fetch_array($sql_query)){
				$this->menu_data[]=$data;
			}
		}else{
			echo @mysql_error();
		}
		return $this->menu_data;
	}
	function findParent(&$array,$parentid=0,$childarray=[]){
		foreach($array as $i=>&$row){
			if($parentid){
				if($row['slno']==$parentid){
					$row['child'][]=$childarray;
				}elseif(isset($row['child'])){
					$this->findParent($row['child'],$parentid,$childarray);
				}
			}elseif($row['parent_slno']){
				unset($array[$i]);
				$this->findParent($array,$row['parent_slno'],$row);
			}
		}
		return $array;
	}
	function set_active_sts($data_array){
		return $data_array;
	}
	function create_menue($menu_list) {
		if(is_array($menu_list)){
			foreach($menu_list as $menu) {
				array_key_exists('child', $menu)?$link_sts='class="menu-toggle" href="#"':$link_sts='href="?'.$menu['link_type'].'='.$menu['link_url'].'"';
				echo "<li ".($_GET['pg']==$menu['link_url']||$_GET['pgr']==$menu['link_url']?'class="active"':'')."><a ".$link_sts." >".($menu['url_icon']!=null&&$menu['url_icon']!='na'?'<i class="material-icons">'.$menu['url_icon'].'</i>':'').'<span>'.$menu['link_caption']."</span></a>";
				if(is_array($menu) && array_key_exists('child', $menu)) {
					echo '<ul class="ml-menu">';
					$this->create_menue($menu['child']);
					echo '</ul>';
				}
				echo '</li>';
			}
		}
	}
	function genarate_menu($user_id){
		$get_list=$this->get_menulist($user_id);
		$arranged_list=$this->findParent($get_list);
		//$arranged_list=$this->set_active_sts($arranged_list);
		$this->create_menue($arranged_list);
		//echo '<pre>'; var_dump($arranged_list); echo '</pre>';
	}
}