<?php
if(defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] == 'POST'){
	$row = array();
	$return_arr = array();
	$row_array = array();
	$ret = array();
	$AuthTerms = " AND zid in ('".$_SESSION['zid']."','1') ";
	$AuthTerm = " AND zid = '".$_SESSION['zid']."' ";
	if(!$action){
		$action =new database();
	}
	if(isset($_POST[field_num]) && ($_POST[field_num]=='item_cat' || $_POST[field_num]=='item_cat[]')){
		if((isset($_POST[field_val])) || (isset($_POST[ini_trn_type]))){
			if(isset($_POST[field_val])){
				$getVar = @mysql_real_escape_string($_POST[field_val]);
				$whereClause =  " LOWER(pram_name) LIKE LOWER('%" . $getVar ."%') ";
			}elseif(isset($_POST[ini_trn_type])){
				$getVar = @mysql_real_escape_string($_POST[ini_trn_type]);
				$whereClause =  " pram_name = '" . $getVar ."' ";
			}
			$limit = intval($_POST[page_limit]);
			$sql = "SELECT slno,pram_name FROM item_pram WHERE pram_type='cat' ".$AuthTerms." and ($whereClause) ORDER BY pram_name ASC";
			$result = @mysql_query($sql);
			if(@mysql_num_rows($result)>0){
				while($row =@mysql_fetch_array($result)){
					$row_array[id] = $row[slno];
					$row_array[text] = utf8_encode($row[pram_name]);
					array_push($return_arr,$row_array);
				}
			}
			//else if($_POST[new_in]!='no'){
			//	$row_array[id] = $getVar;
			//	$row_array[text] = utf8_encode($getVar);
			//	array_push($return_arr,$row_array);
			//}
			if(isset($_POST[ini_trn_type])){
				$ret = $row_array;
			}else{
				$ret[results] = $return_arr;
			}
		}
	}else if(isset($_POST[field_num]) && ($_POST[field_num]=='item_store' || $_POST[field_num]=='item_store[]')){
		if((isset($_POST[field_val])) || (isset($_POST[ini_trn_type]))){
			if(isset($_POST[field_val])){
				$getVar = @mysql_real_escape_string($_POST[field_val]);
				$whereClause =  " LOWER(pram_name) LIKE LOWER('%" . $getVar ."%') ";
			}elseif(isset($_POST[ini_trn_type])){
				$getVar = @mysql_real_escape_string($_POST[ini_trn_type]);
				$whereClause =  " pram_name = '" . $getVar ."' ";
			}
			$limit = intval($_POST[page_limit]);
			$sql = "SELECT slno,pram_name FROM item_pram WHERE pram_type='store' ".$AuthTerms." and ($whereClause) ORDER BY pram_name ASC";
			$result = @mysql_query($sql);
			if(@mysql_num_rows($result)>0){
				while($row =@mysql_fetch_array($result)){
					$row_array[id] = $row[slno];
					$row_array[text] = utf8_encode($row[pram_name]);
					array_push($return_arr,$row_array);
				}
			}
			//else if($_POST[new_in]!='no'){
			//	$row_array[id] = $getVar;
			//	$row_array[text] = utf8_encode($getVar);
			//	array_push($return_arr,$row_array);
			//}
			if(isset($_POST[ini_trn_type])){
				$ret = $row_array;
			}else{
				$ret[results] = $return_arr;
			}
		}
	}else if(isset($_POST[field_num]) && ($_POST[field_num]=='item_type' || $_POST[field_num]=='item_type[]')){
		if((isset($_POST[field_val])) || (isset($_POST[ini_trn_type]))){
			if(isset($_POST[field_val])){
				$getVar = @mysql_real_escape_string($_POST[field_val]);
				$whereClause =  " LOWER(pram_name) LIKE LOWER('%" . $getVar ."%') ";
			}elseif(isset($_POST[ini_trn_type])){
				$getVar = @mysql_real_escape_string($_POST[ini_trn_type]);
				$whereClause =  " pram_name = '" . $getVar ."' ";
			}
			$limit = intval($_POST[page_limit]);
			$sql = "SELECT slno,pram_name FROM item_pram WHERE pram_type='type' ".$AuthTerms." and ($whereClause) ORDER BY pram_name ASC";
			$result = @mysql_query($sql);
			if(@mysql_num_rows($result)>0){
				while($row =@mysql_fetch_array($result)){
					$row_array[id] = $row[slno];
					$row_array[text] = utf8_encode($row[pram_name]);
					array_push($return_arr,$row_array);
				}
			}
			//else if($_POST[new_in]!='no'){
			//	$row_array[id] = $getVar;
			//	$row_array[text] = utf8_encode($getVar);
			//	array_push($return_arr,$row_array);
			//}
			if(isset($_POST[ini_trn_type])){
				$ret = $row_array;
			}else{
				$ret[results] = $return_arr;
			}
		}
	}else if(isset($_POST[field_num]) && ($_POST[field_num]=='item_brand' || $_POST[field_num]=='item_brand[]')){
		if((isset($_POST[field_val])) || (isset($_POST[ini_trn_type]))){
			if(isset($_POST[field_val])){
				$getVar = @mysql_real_escape_string($_POST[field_val]);
				$whereClause =  " LOWER(pram_name) LIKE LOWER('%" . $getVar ."%') ";
			}elseif(isset($_POST[ini_trn_type])){
				$getVar = @mysql_real_escape_string($_POST[ini_trn_type]);
				$whereClause =  " pram_name = '" . $getVar ."' ";
			}
			$limit = intval($_POST[page_limit]);
			$sql = "SELECT slno,pram_name FROM item_pram WHERE pram_type='brand' ".$AuthTerms." and ($whereClause) ORDER BY pram_name ASC";
			$result = @mysql_query($sql);
			if(@mysql_num_rows($result)>0){
				while($row =@mysql_fetch_array($result)){
					$row_array[id] = $row[slno];
					$row_array[text] = utf8_encode($row[pram_name]);
					array_push($return_arr,$row_array);
				}
			}
			//else if($_POST[new_in]!='no'){
			//	$row_array[id] = $getVar;
			//	$row_array[text] = utf8_encode($getVar);
			//	array_push($return_arr,$row_array);
			//}
			if(isset($_POST[ini_trn_type])){
				$ret = $row_array;
			}else{
				$ret[results] = $return_arr;
			}
		}
	}else if(isset($_POST[field_num]) && ($_POST[field_num]=='item_color' || $_POST[field_num]=='item_color[]')){
		if((isset($_POST[field_val])) || (isset($_POST[ini_trn_type]))){
			if(isset($_POST[field_val])){
				$getVar = @mysql_real_escape_string($_POST[field_val]);
				$whereClause =  " LOWER(pram_name) LIKE LOWER('%" . $getVar ."%') ";
			}elseif(isset($_POST[ini_trn_type])){
				$getVar = @mysql_real_escape_string($_POST[ini_trn_type]);
				$whereClause =  " pram_name = '" . $getVar ."' ";
			}
			$limit = intval($_POST[page_limit]);
			$sql = "SELECT slno,pram_name FROM item_pram WHERE pram_type='color' ".$AuthTerms." and ($whereClause) ORDER BY pram_name ASC";
			$result = @mysql_query($sql);
			if(@mysql_num_rows($result)>0){
				while($row =@mysql_fetch_array($result)){
					$row_array[id] = $row[slno];
					$row_array[text] = utf8_encode($row[pram_name]);
					array_push($return_arr,$row_array);
				}
			}
			//else if($_POST[new_in]!='no'){
			//	$row_array[id] = $getVar;
			//	$row_array[text] = utf8_encode($getVar);
			//	array_push($return_arr,$row_array);
			//}
			if(isset($_POST[ini_trn_type])){
				$ret = $row_array;
			}else{
				$ret[results] = $return_arr;
			}
		}
	}else if(isset($_POST[field_num]) && ($_POST[field_num]=='item_size' || $_POST[field_num]=='item_size[]')){
		if((isset($_POST[field_val])) || (isset($_POST[ini_trn_type]))){
			if(isset($_POST[field_val])){
				$getVar = @mysql_real_escape_string($_POST[field_val]);
				$whereClause =  " LOWER(pram_name) LIKE LOWER('%" . $getVar ."%') ";
			}elseif(isset($_POST[ini_trn_type])){
				$getVar = @mysql_real_escape_string($_POST[ini_trn_type]);
				$whereClause =  " pram_name = '" . $getVar ."' ";
			}
			$limit = intval($_POST[page_limit]);
			$sql = "SELECT slno,pram_name FROM item_pram WHERE pram_type='size' ".$AuthTerms." and ($whereClause) ORDER BY pram_name ASC";
			$result = @mysql_query($sql);
			if(@mysql_num_rows($result)>0){
				while($row =@mysql_fetch_array($result)){
					$row_array[id] = $row[slno];
					$row_array[text] = utf8_encode($row[pram_name]);
					array_push($return_arr,$row_array);
				}
			}
			//else if($_POST[new_in]!='no'){
			//	$row_array[id] = $getVar;
			//	$row_array[text] = utf8_encode($getVar);
			//	array_push($return_arr,$row_array);
			//}
			if(isset($_POST[ini_trn_type])){
				$ret = $row_array;
			}else{
				$ret[results] = $return_arr;
			}
		}
	}else if(isset($_POST[field_num]) && ($_POST[field_num]=='item_unit' || $_POST[field_num]=='item_unit[]')){
		if((isset($_POST[field_val])) || (isset($_POST[ini_trn_type]))){
			if(isset($_POST[field_val])){
				$getVar = @mysql_real_escape_string($_POST[field_val]);
				$whereClause =  " LOWER(pram_name) LIKE LOWER('%" . $getVar ."%') ";
			}elseif(isset($_POST[ini_trn_type])){
				$getVar = @mysql_real_escape_string($_POST[ini_trn_type]);
				$whereClause =  " pram_name = '" . $getVar ."' ";
			}
			$limit = intval($_POST[page_limit]);
			$sql = "SELECT slno,pram_name FROM item_pram WHERE pram_type='unit' ".$AuthTerms." and ($whereClause) ORDER BY pram_name ASC";
			$result = @mysql_query($sql);
			if(@mysql_num_rows($result)>0){
				while($row =@mysql_fetch_array($result)){
					$row_array[id] = $row[slno];
					$row_array[text] = utf8_encode($row[pram_name]);
					array_push($return_arr,$row_array);
				}
			}
			//else if($_POST[new_in]!='no'){
			//	$row_array[id] = $getVar;
			//	$row_array[text] = utf8_encode($getVar);
			//	array_push($return_arr,$row_array);
			//}
			if(isset($_POST[ini_trn_type])){
				$ret = $row_array;
			}else{
				$ret[results] = $return_arr;
			}
		}
	}else if(isset($_POST['field_num']) && $_POST['field_num']=='parent_slno'){
		if((isset($_POST['field_val'])) || (isset($_POST['ini_trn_type']))){
			if(isset($_POST['field_val'])){
				$getVar = @mysql_real_escape_string($_POST['field_val']);
				$whereClause =  " LOWER(module_name) LIKE LOWER('%" . $getVar ."%') ";
			}elseif(isset($_POST['ini_trn_type'])){
				$getVar = @mysql_real_escape_string($_POST['ini_trn_type']);
				$whereClause =  " module_name = '" . $getVar ."' ";
			}
			$limit = intval($_POST['page_limit']);
			$sql = "SELECT slno,module_name FROM usystem_module WHERE sts='1' and user_id='USER-000001' and $whereClause ORDER BY module_name ASC";
			$result = @mysql_query($sql);
			if(@mysql_num_rows($result)>0){
				while($row =@mysql_fetch_array($result)){
					$row_array['id'] = $row['slno'];
					$row_array['text'] = utf8_encode($row['module_name']);
					array_push($return_arr,$row_array);
				}
			}
			if(isset($_POST['ini_trn_type'])){
				$ret = $row_array;
			}else{
				$ret['results'] = $return_arr;
			}
		}
	}else if(isset($_POST['field_num']) && $_POST['field_num']=='dcmpny_cod'){
		if((isset($_POST['field_val'])) || (isset($_POST['ini_trn_type']))){
			if(isset($_POST['field_val'])){
				$getVar = @mysql_real_escape_string($_POST['field_val']);
				$whereClause =  " LOWER(dcmpny_num) LIKE LOWER('%" . $getVar ."%') ";
			}elseif(isset($_POST['ini_trn_type'])){
				$getVar = @mysql_real_escape_string($_POST['ini_trn_type']);
				$whereClause =  " dcmpny_num = '" . $getVar ."' ";
			}
			$limit = intval($_POST['page_limit']);
			$sql = "SELECT slno,dcmpny_num FROM dcmpny_info WHERE sts='1' and '".$_SESSION['user_id']."'='USER-000001' and $whereClause ORDER BY dcmpny_num ASC";
			$result = @mysql_query($sql);
			if(@mysql_num_rows($result)>0){
				while($row =@mysql_fetch_array($result)){
					$row_array['id'] = $row['slno'];
					$row_array['text'] = utf8_encode($row['dcmpny_num']);
					array_push($return_arr,$row_array);
				}
			}
			if(isset($_POST['ini_trn_type'])){
				$ret = $row_array;
			}else{
				$ret['results'] = $return_arr;
			}
		}
	}else if(isset($_POST['field_num']) && ($_POST['field_num']=='item_code' || $_POST['field_num']=='item_code[]'|| $_POST['field_num']=='targt_item'|| $_POST['field_num']=='targt_item[]')){
		if((isset($_POST['field_val'])) || (isset($_POST['ini_trn_type']))){
			if(isset($_POST['field_val'])){
				$getVar = @mysql_real_escape_string($_POST['field_val']);
				$whereClause =  " (LOWER(item_name) LIKE LOWER('%" . $getVar ."%') OR LOWER(bar_cod) LIKE LOWER('%" . $getVar ."%')) ";
			}elseif(isset($_POST['ini_trn_type'])){
				$getVar = @mysql_real_escape_string($_POST['ini_trn_type']);
				$whereClause =  " (item_name = '" . $getVar ."') ";
			}
			$limit = intval($_POST['page_limit']);
			$sql = "SELECT item_code,item_name FROM item_info 
			WHERE sts='1' ".$AuthTerm." AND $whereClause ORDER BY item_name ASC";
			$result = @mysql_query($sql);
			if(@mysql_num_rows($result)>0){
				while($row =@mysql_fetch_array($result)){
					$row_array['id'] = $row['item_code'];
					$row_array['text'] = utf8_encode($row['item_name']);
					array_push($return_arr,$row_array);
				}
			}
			if(isset($_POST['ini_trn_type'])){
				$ret = $row_array;
			}else{
				$ret['results'] = $return_arr;
			}
		}
	}else if(isset($_POST['field_num']) && $_POST['field_num']=='dsup_cod'){
		if((isset($_POST['field_val'])) || (isset($_POST['ini_trn_type']))){
			if(isset($_POST['field_val'])){
				$getVar = @mysql_real_escape_string($_POST['field_val']);
				$whereClause =  " LOWER(dsup_num) LIKE LOWER('%" . $getVar ."%') 
				OR dsup_cod LIKE '%" . $getVar ."%' ";
			}elseif(isset($_POST['ini_trn_type'])){
				$getVar = @mysql_real_escape_string($_POST['ini_trn_type']);
				$whereClause =  " dsup_num = '" . $getVar ."' ";
			}
			$limit = intval($_POST['page_limit']);
			$sql = "SELECT dsup_cod,dsup_num FROM dsup_info 
			WHERE sts='1' ".$AuthTerm." AND (".$whereClause.") ORDER BY dsup_num ASC";
			$result = @mysql_query($sql);
			if(@mysql_num_rows($result)>0){
				while($row =@mysql_fetch_array($result)){
					$row_array['id'] = $row['dsup_cod'];
					$row_array['text'] = utf8_encode($row['dsup_cod'].'-'.$row['dsup_num']);
					array_push($return_arr,$row_array);
				}
			}
			if(isset($_POST['ini_trn_type'])){
				$ret = $row_array;
			}else{
				$ret['results'] = $return_arr;
			}
		}
	}else if(isset($_POST['field_num']) && $_POST['field_num']=='dcus_cod'){
		if((isset($_POST['field_val'])) || (isset($_POST['ini_trn_type']))){
			if(isset($_POST['field_val'])){
				$getVar = @mysql_real_escape_string($_POST['field_val']);
				$whereClause =  " LOWER(dcus_num) LIKE LOWER('%" . $getVar ."%')
				OR LOWER(dcus_mobno) LIKE LOWER('%" . $getVar ."%')
				OR dcus_cod LIKE '%" . $getVar ."%' ";
			}elseif(isset($_POST['ini_trn_type'])){
				$getVar = @mysql_real_escape_string($_POST['ini_trn_type']);
				$whereClause =  " dcus_num = '" . $getVar ."' ";
			}
			$limit = intval($_POST['page_limit']);
			$sql = "SELECT dcus_cod,dcus_num FROM dcus_info 
			WHERE sts='1' ".$AuthTerm." AND (".$whereClause.") ORDER BY dcus_num ASC";
			$result = @mysql_query($sql);
			if(@mysql_num_rows($result)>0){
				while($row =@mysql_fetch_array($result)){
					$row_array['id'] = $row['dcus_cod'];
					$row_array['text'] = utf8_encode($row['dcus_cod'].'-'.$row['dcus_num']);
					array_push($return_arr,$row_array);
				}
			}
			if(isset($_POST['ini_trn_type'])){
				$ret = $row_array;
			}else{
				$ret['results'] = $return_arr;
			}
		}
	}else if(isset($_POST['field_num']) && $_POST['field_num']=='prfx_name'){
		if((isset($_POST['field_val'])) || (isset($_POST['ini_trn_type']))){
			if(isset($_POST['field_val'])){
				$getVar = @mysql_real_escape_string($_POST['field_val']);
				$whereClause =  " LOWER(prfx_name) LIKE LOWER('%" . $getVar ."%') or LOWER(prfx_desc) LIKE LOWER('%" . $getVar ."%') ";
			}elseif(isset($_POST['ini_trn_type'])){
				$getVar = @mysql_real_escape_string($_POST['ini_trn_type']);
				$whereClause =  " prfx_name = '" . $getVar ."' ";
			}
			$limit = intval($_POST['page_limit']);
			$sql = "SELECT prfx_name,prfx_desc FROM acct_vou_prfx WHERE sts='1' ".$AuthTerms." and $whereClause ORDER BY prfx_name ASC";
			$result = @mysql_query($sql);
			if(@mysql_num_rows($result)>0){
				while($row =@mysql_fetch_array($result)){
					$row_array['id'] = $row['prfx_name'];
					$row_array['text'] = utf8_encode($row['prfx_name']." 	".$row['prfx_desc']);
					array_push($return_arr,$row_array);
				}
			}
			if(isset($_POST['ini_trn_type'])){
				$ret = $row_array;
			}else{
				$ret['results'] = $return_arr;
			}
		}
	}else if(isset($_POST['field_num']) && $_POST['field_num']=='acct_code'){
		if((isset($_POST['field_val'])) || (isset($_POST['ini_trn_type']))){
			if(isset($_POST['field_val'])){
				$getVar = @mysql_real_escape_string($_POST['field_val']);
				$whereClause =  " LOWER(acct_code) LIKE LOWER('%" . $getVar ."%') or LOWER(acct_name) LIKE LOWER('%" . $getVar ."%') ";
			}elseif(isset($_POST['ini_trn_type'])){
				$getVar = @mysql_real_escape_string($_POST['ini_trn_type']);
				$whereClause =  " acct_code = '" . $getVar ."' ";
			}
			$limit = intval($_POST['page_limit']);
			$sql = "SELECT acct_code,acct_name FROM acc_chart_of_account WHERE sts='1' ".$AuthTerms." and ($whereClause) ORDER BY acct_code ASC";
			$result = @mysql_query($sql);
			if(@mysql_num_rows($result)>0){
				while($row =@mysql_fetch_array($result)){
					$row_array['id'] = $row['acct_code'];
					$row_array['text'] = utf8_encode($row['acct_code'].'--'.$row['acct_name']);
					array_push($return_arr,$row_array);
				}
			}
			if(isset($_POST['ini_trn_type'])){
				$ret = $row_array;
			}else{
				$ret['results'] = $return_arr;
			}
		}
	}else if(isset($_POST['field_num']) && $_POST['field_num']=='acct_code_rcv'){
		if((isset($_POST['field_val'])) || (isset($_POST['ini_trn_type']))){
			if(isset($_POST['field_val'])){
				$getVar = @mysql_real_escape_string($_POST['field_val']);
				$whereClause =  " LOWER(acct_code) LIKE LOWER('%" . $getVar ."%') or LOWER(acct_name) LIKE LOWER('%" . $getVar ."%') ";
			}elseif(isset($_POST['ini_trn_type'])){
				$getVar = @mysql_real_escape_string($_POST['ini_trn_type']);
				$whereClause =  " acct_code = '" . $getVar ."' ";
			}
			$limit = intval($_POST['page_limit']);
			$sql = "SELECT acct_code,acct_name FROM acc_chart_of_account WHERE sts='1' ".$AuthTerms." and acct_type='1' and ($whereClause) ORDER BY acct_code ASC";
			$result = @mysql_query($sql);
			if(@mysql_num_rows($result)>0){
				while($row =@mysql_fetch_array($result)){
					$row_array['id'] = $row['acct_code'];
					$row_array['text'] = utf8_encode($row['acct_code'].'--'.$row['acct_name']);
					array_push($return_arr,$row_array);
				}
			}
			if(isset($_POST['ini_trn_type'])){
				$ret = $row_array;
			}else{
				$ret['results'] = $return_arr;
			}
		}
	}else if(isset($_POST['field_num']) && $_POST['field_num']=='acct_code_sub'){
		if((isset($_POST['field_val'])) || (isset($_POST['ini_trn_type']))){
			if(isset($_POST['field_val'])){
				$getVar = @mysql_real_escape_string($_POST['field_val']);
				$whereClause =  " LOWER(acct_code) LIKE LOWER('%" . $getVar ."%') or LOWER(acct_name) LIKE LOWER('%" . $getVar ."%') ";
			}elseif(isset($_POST['ini_trn_type'])){
				$getVar = @mysql_real_escape_string($_POST['ini_trn_type']);
				$whereClause =  " acct_code = '" . $getVar ."' ";
			}
			$limit = intval($_POST['page_limit']);
			$sql = "SELECT acct_code,acct_name FROM acct_cmn_account 
			WHERE 1 ".$AuthTerms." AND (".$whereClause.") ORDER BY acct_code ASC";
			$result = @mysql_query($sql);
			if(@mysql_num_rows($result)>0){
				while($row =@mysql_fetch_array($result)){
					$row_array['id'] = $row['acct_code'];
					$row_array['text'] = utf8_encode($row['acct_code'].'--'.$row['acct_name']);
					array_push($return_arr,$row_array);
				}
			}
			if(isset($_POST['ini_trn_type'])){
				$ret = $row_array;
			}else{
				$ret['results'] = $return_arr;
			}
		}
	}
	else if(isset($_POST['field_num']) && ($_POST['field_num']=='acct_parent_slno' || $_POST['field_num']=='parrent_code')){
		if((isset($_POST['field_val'])) || (isset($_POST['ini_trn_type']))){
			if(isset($_POST['field_val'])){
				$getVar = @mysql_real_escape_string($_POST['field_val']);
				$whereClause =  " LOWER(acct_level_name) LIKE LOWER('%" . $getVar ."%') OR LOWER(acct_type) LIKE LOWER('%" . $getVar ."%') ";
			}elseif(isset($_POST['ini_trn_type'])){
				$getVar = @mysql_real_escape_string($_POST['ini_trn_type']);
				$whereClause =  " acct_level_name = '" . $getVar ."' ";
			}
			$limit = intval($_POST['page_limit']);
			$sql = "SELECT slno,acct_level_name,acct_level_no, acct_type FROM acc_calevel WHERE sts='1' ".$AuthTerms." and $whereClause ORDER BY acct_level_name ASC";
			$result = @mysql_query($sql);
			if(@mysql_num_rows($result)>0){
				while($row =@mysql_fetch_array($result)){
					$row_array['id'] = $row['slno'];
					$row_array['text'] = utf8_encode($row['acct_level_name']."--".$row['acct_type']."--".$row['acct_level_no']);
					array_push($return_arr,$row_array);
				}
			}
			if(isset($_POST['ini_trn_type'])){
				$ret = $row_array;
			}else{
				$ret['results'] = $return_arr;
			}
		}
	}
	echo json_encode($ret);
}
?>