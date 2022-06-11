<?php
	if(isset($_POST[post_method])&&$_POST[post_method]=='ajax'){
		if(isset($_POST[ac_method]) && $_POST[ac_method]=='addFromScan'){
			if(!isset($_SESSION['item_code'])){
				$_SESSION['item_code']=array();
			}
			if(!in_array($_POST['item_code'],$_SESSION['item_code'])){
				$item_sql="select item_info.*,viunit_info.pram_name as xitem_unit
				from item_info 
				left join viunit_info on item_info.item_unit=viunit_info.slno
				where item_info.bar_cod ='".$_POST['item_code']."'";
				$item_qry=$cmncls->sqlqry($item_sql);
				if(@mysql_num_rows($item_qry)>0){
					array_push($_SESSION['item_code'],$_POST['item_code']);
					$item_info=@mysql_fetch_assoc($item_qry);
					if($item_info['item_brate']==0){
						$item_info['item_brate']=NULL;
					}
					//echo $item_info['item_code'];
					$data= '<tr>'.
							'<td>'
								.$item_info['item_name'].
								'<input type="hidden" class="item_code" name="item_code[]" value="'.$item_info['item_code'].'" />
								<input type="hidden" name="item_vatrate[]" value="'.$item_info['item_vatrate'].'" />
							</td>'.
							'<td>
								<input type="number" value="1" step="any" class="form-control" id="item_qty" name="item_qty[]" >
							</td>'.
							'<td>
								'.$item_info['xitem_unit'].'
							<td>
							<td>
								<input type="number" required value="'.$item_info['item_brate'].'" class="form-control" id="item_brate" name="item_brate[]" >
							</td>'.
							'<td><button type="button" data="delete_item" class="btn btn-danger waves-effect delete_row">'.
									'<i class="material-icons">delete</i>'.
								'</button>'.
							'</td>'.
						'</tr>';
					$msg=1;
				}
				
			}
			$rtn_data=array(
				"rtndata"		=> $data,
				//"rtndata"		=> $item_sql,
				"sts"			=> $msg
			);
			echo json_encode($rtn_data);
		}else
		if(isset($_POST[ac_method]) && $_POST[ac_method]=='add_data'){
			if(!isset($_SESSION['item_code'])){
				$_SESSION['item_code']=array();
			}
			$citem_info=$cmncls->newpikval('item_info','item_code',$_POST['item_code']);
			if(!in_array($citem_info['bar_cod'],$_SESSION['item_code'])){
				$item_sql="select item_info.*,viunit_info.pram_name as xitem_unit
				from item_info 
				left join viunit_info on item_info.item_unit=viunit_info.slno
				where item_info.item_code ='".$_POST['item_code']."'";
				$item_qry=$cmncls->sqlqry($item_sql);
				if(@mysql_num_rows($item_qry)>0){
					array_push($_SESSION['item_code'],$citem_info['bar_cod']);
					$item_info=@mysql_fetch_assoc($item_qry);
					if($item_info['item_brate']==0){
						$item_info['item_brate']=NULL;
					}
					if($_POST['item_brate']==NULL){
						$item_brate=$item_info['item_brate'];
					}else{
						$item_brate=$_POST['item_brate'];
					}
					//echo $item_info['item_code'];
					$data= '<tr>'.
							'<td>'
								.$item_info['item_name'].
								'<input type="hidden" class="item_code" name="item_code[]" value="'.$item_info['item_code'].'" />
								<input type="hidden" name="item_vatrate[]" value="'.$item_info['item_vatrate'].'" />
							</td>'.
							'<td>
								<input type="number" step="any" value="'.$_POST['item_qty'].'" class="form-control" id="item_qty" name="item_qty[]" >
							</td>'.
							'<td>
								'.$item_info['xitem_unit'].'
							<td>
							<td>
								<input type="number" required value="'.$item_brate.'" class="form-control" id="item_brate" name="item_brate[]" >
							</td>'.
							'<td><button type="button"  data="delete_item" class="btn btn-danger waves-effect delete_row">'.
									'<i class="material-icons">delete</i>'.
								'</button>'.
							'</td>'.
						'</tr>';
					$msg=1;
				}
			}
			$rtn_data=array(
				"rtndata"		=> $data,
				"sts"			=> $msg
			);
			echo json_encode($rtn_data);
		}else
		if(isset($_POST[ac_method]) && $_POST[ac_method]=='delete_item'){
			$item_info=$cmncls->newpikval('item_info','item_code',$_POST['item_code']);
			$prokey = array_search($item_info['bar_cod'],$_SESSION['item_code']);
			if($prokey!==NULL){
				unset($_SESSION['item_code'][$prokey]);
				$_SESSION['item_code'] = array_values($_SESSION['item_code']);
			}
			echo json_encode($rtn_data);
		}
		exit;
	} else{
		if(isset($_POST['add_trn'])){
			$hslno = $action->getslno('inop_header');
			$slno=$action->getslno_max('inop_details');
			$i=0;
			$trn_amount=0;
			foreach($_POST['item_code'] as $item_code){
				$rcv_sqli.="('".$slno."','".$hslno."','".$item_code."','".$_POST['item_qty'][$i]."','".$_POST['item_brate'][$i]."','".$_POST['item_vatrate'][$i]."','".$_SESSION['user_id']."'),";
				$trn_amount+=round((($_POST['item_qty'][$i])*($_POST['item_brate'][$i])),2);
				$i++;
				$slno++;
			}
			$rcvh_sql="INSERT INTO inop_header(slno, trn_type, trn_cat, targt_item, targt_qty, recv_qty, trn_date, trn_amount, trn_ref, trn_desc, ent_id) 
			VALUES ('".$hslno."','2','5','".$_POST['targt_item']."','".$_POST['targt_qty']."','".$_POST['targt_qty']."','".$_POST['trn_date']."','".$trn_amount."','".$_POST['trn_ref']."','".$_POST['trn_description']."','".$_SESSION['user_id']."')";
			$cmncls->sqlqry($rcvh_sql);
			if($rcv_sqli!=NULL && !@mysql_errno()){
				$rcv_sql="INSERT INTO inop_details(slno, hslno, item_code, item_qty, buy_rate, vat_rate, ent_id) VALUES ";
				$rcv_sql .= substr($rcv_sqli, 0, -1);
				$cmncls->sqlqry($rcv_sql);
				if(!@mysql_errno()){
					$msg="Plan Saved!";
					$clor="green";
				}else{
					$msg="Error- Check required filed values!(S)";
					$clor="red";
				}
			}else{
				$msg="Error- Check required filed values!(H)";
				$clor="red";
			}
			$sxcode=$hslno;
			//exit;
		}
		$_SESSION[msg] = $msg;
		$_SESSION[clor] = $clor;
	}
	header("location:index.php?pg=".$_POST[ppg]."&&sx_code=".$sxcode);
?>
