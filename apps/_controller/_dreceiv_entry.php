<?php
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' //Check Request Method is POST//
	&& isset($_SERVER['HTTP_X_REQUESTED_WITH'])//check AJAX Request//
	&& !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
	&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		if(isset($_POST['ac_method']) && $_POST['ac_method']=='addFromScan'){
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
		}else
		if(isset($_POST['ac_method']) && $_POST['ac_method']=='add_data'){
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
		}else
		if(isset($_POST['ac_method']) && $_POST['ac_method']=='delete_item'){
			$item_info=$cmncls->newpikval('item_info','item_code',$_POST['item_code']);
			$prokey = array_search($item_info['bar_cod'],$_SESSION['item_code']);
			if($prokey!==NULL){
				unset($_SESSION['item_code'][$prokey]);
				$_SESSION['item_code'] = array_values($_SESSION['item_code']);
			}
		}else
		if(isset($_POST['ac_method']) && $_POST['ac_method']=='rtrive'){
			if(!isset($_SESSION['recv_slno'])){
				$_SESSION['recv_slno']=$_POST['sx_code'];
			}
			$prdct_sql="SELECT inop_details.item_code,item_info.bar_cod,item_info.item_name,
			inop_details.item_qty,viunit_info.pram_name as xitem_unit,
			inop_details.buy_rate,item_info.item_vatrate
			FROM inop_details 
			LEFT JOIN item_info ON inop_details.item_code=item_info.item_code
			left join viunit_info on item_info.item_unit=viunit_info.slno
			WHERE hslno='".$_POST['sx_code']."' AND zid='".$_SESSION['zid']."' ";
			//echo $prdct_sql;
			//exit;
			$prdct_qry=$cmncls->sqlqry($prdct_sql);

			if(@mysql_num_rows($prdct_qry)>0){
				$_SESSION['item_code']=array();
				$data=NULL;
				WHILE($item_info=@mysql_fetch_array($prdct_qry)){
					array_push($_SESSION['item_code'],$item_info['bar_cod']);
					$data.= 
						'<tr>'.
							'<td>'
								.$item_info['item_name'].
								'<input type="hidden" class="item_code" name="item_code[]" value="'.$item_info['item_code'].'" />
								<input type="hidden" name="item_vatrate[]" value="'.$item_info['item_vatrate'].'" />
							</td>'.
							'<td>
								<input type="number" step="any" value="'.$item_info['item_qty'].'" class="form-control" id="item_qty" name="item_qty[]" >
							</td>'.
							'<td>
								'.$item_info['xitem_unit'].'
							<td>
							<td>
								<input type="number" required value="'.$item_info['buy_rate'].'" class="form-control" id="item_brate" name="item_brate[]" >
							</td>'.
							'<td><button type="button"  data="delete_item" class="btn btn-danger waves-effect delete_row">'.
									'<i class="material-icons">delete</i>'.
								'</button>'.
							'</td>'.
						'</tr>';
				}
			}
			$rtn_data=array(
				"rtndata"		=> $data,
				"sts"			=> 1
			);
		}
		echo json_encode($rtn_data);
	} else{
		if(isset($_POST['add_trn'])){
			if(!isset($_SESSION['recv_slno'])){
				$hslno = $action->getslno('inop_header');
				$rcvh_sql="INSERT INTO inop_header(slno, zid, trn_type, trn_cat, trn_from, trn_date, trn_ref, trn_desc, ent_id) 
				VALUES ('".$hslno."','".$_SESSION['zid']."','1','2','".$_POST['dsup_cod']."','".$_POST['trn_date']."','".$_POST['trn_ref']."','".$_POST['trn_description']."','".$_SESSION['user_id']."')";
				$cmncls->sqlqry($rcvh_sql);
				//echo $rcvh_sql;
			}else{
				$hslno = $_SESSION['recv_slno'];
				$rcvupdt_data=array(
					'trn_from'		=> $_POST['dsup_cod'],
					'trn_date'		=> $_POST['trn_date'],
					'trn_ref'		=> $_POST['trn_ref'],
					'trn_desc'		=> $_POST['trn_description'],
					'updt_id'		=> $_SESSION['user_id']
				);
				$chng_sts=$action->update_data('inop_header',$rcvupdt_data,null,'slno',$hslno);
				if ($chng_sts == true){
					$action->delete('inop_details','hslno',$_SESSION['recv_slno']);
				}
			}
			$rcv_sql="INSERT INTO inop_details(slno,zid, hslno, item_code, item_qty, buy_rate, vat_rate, ent_id) VALUES ";
			$i=0;
			$slno = $action->getslno_max('inop_details');
			foreach($_POST['item_code'] as $item_code){
				$goods_amount+=round(($_POST['item_qty'][$i]*$_POST['item_brate'][$i]),2);
				$rcv_sqli.="('".$slno."','".$_SESSION['zid']."','".$hslno."','".$item_code."','".$_POST['item_qty'][$i]."','".$_POST['item_brate'][$i]."','".$_POST['item_vatrate'][$i]."','".$_SESSION['user_id']."'),";
				$i++;
				$slno++;
			}
			if($rcv_sqli!=NULL){
				$rcv_sql .= substr($rcv_sqli, 0, -1);
				//echo $rcv_sql;
				//exit;
				if($cmncls->sqlqry($rcv_sql)){
					$data=array(
						'slno'					=> $hslno,
						'trn_date'				=> $_POST['trn_date'],
						'receive_from'			=> $_POST['dsup_cod'],
						'goods_amount'			=> $goods_amount,
					);
					$Acc_sts=$accounts->InopReceiveToAccounts($data,'add');
					if($Acc_sts===true){
						$msg="Successfully Saved!";
						$clor=green;
					}else{
						$msg="Successfully Saved Without Accounts Voucher!";
						$clor=red;
					}
				}else{
					$msg="Error in submitted data!";
					$clor=red;
				}
			}else{
				$msg="Empty Product!";
				$clor=red;
			}
		}
		$sxcode=$hslno;
		$_SESSION['msg'] = $msg;
		$_SESSION['clor'] = $clor;
		header("location:index.php?pg=".$_POST[ppg]."&&sx_code=".$sxcode);
	}
?>
