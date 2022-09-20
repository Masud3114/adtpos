<?php
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' //Check Request Method is POST//
	&& isset($_SERVER['HTTP_X_REQUESTED_WITH'])//check AJAX Request//
	&& !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
	&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		$_POST=$cmncls->escap_string($_POST);
		if(isset($_POST['ac_method'])){
			if($_POST['ac_method']=='addFromScan'){
				if(!isset($_SESSION['item_code'])){
					$_SESSION['item_code']=array();
					$_SESSION['item_row']=array();
				}
				if(!in_array($_POST['item_code'],$_SESSION['item_code'])){
					$item_sql="select item_info.*,inop_balance.balance as stock_balance,
					1 as item_qty,
					viunit_info.pram_name as xitem_unit,
					item_info.item_srate as sub_total_amnt,
					round(((item_info.item_discount/100)*item_info.item_srate),2) as discount_amnt,
					round((item_info.item_srate-round(((item_info.item_discount/100)*item_info.item_srate),2)),2) as net_amount,
					round(((item_info.item_vatrate/100)*round((item_info.item_srate-round(((item_info.item_discount/100)*item_info.item_srate),2)),2)),2) as vat_amount
					from item_info
					left join inop_balance on item_info.item_code=inop_balance.item_code
					left join viunit_info on item_info.item_unit=viunit_info.slno
					where bar_cod ='".$_POST['item_code']."'";
					$item_qry=$cmncls->sqlqry($item_sql);
					if(@mysql_num_rows($item_qry)>0){
						$item_info=@mysql_fetch_assoc($item_qry);
					}
					if($item_info['stock_balance']>=1){
						array_push($_SESSION['item_code'],$_POST['item_code']);
						array_push($_SESSION['item_row'],$item_info);
						if($item_info['item_srate']==0){
							$item_info['item_srate']=NULL;
						}
						$data= '<tr>
								<td  class="col-sm-3">'
									.$item_info['item_name'].
									'<input type="hidden" class="item_code" name="item_code[]" value="'.$item_info['item_code'].'" />
								</td>
								<td>
									<span class="stock_balance">'.$item_info['stock_balance'].'</span>
								</td>
								<td class="col-sm-2">
									<input type="number" value="'.$item_info['item_qty'].'" class="form-control item_line_qty" name="item_qty[]" >
								</td>
								<td>
									<span>'.$item_info['xitem_unit'].'</span>
								</td>
								<td>
									<span>'.$item_info['item_srate'].'</span>
								</td>
								<td>
									<span class="item_amount">'.$item_info['item_srate'].'</span>
								</td>
								<td>
									<span class="discount_amnt">'.$item_info['discount_amnt'].'</span>
								</td>
								<td>
									<span class="net_amount">'.$item_info['net_amount'].'</span>
								</td>
								<td>
									<button type="button" class="btn btn-danger waves-effect delete_row">
										<i class="material-icons">delete</i>
									</button>
								</td>
							</tr>';
						$msg=1;
					}else{
						$data=null;
						$msg=2;
						$text="Stock unavailable!";
						$type="warning";
					}
				}
				$rtn_data=array(
					"rtndata"		=> $data,
					"sts"			=> $msg,
					"text"			=> $text,
					"type"			=> $type
				);
				echo json_encode($rtn_data);
			}
			else if($_POST['ac_method']=='add_data'){
				if(!isset($_SESSION['item_code'])){
					$_SESSION['item_code']=array();
					$_SESSION['item_row']=array();
				}
				$citem_info=$cmncls->newpikval('item_info','item_code',$_POST['item_code']);
				if(!in_array($citem_info['bar_cod'],$_SESSION['item_code'])){
					$item_sql="select item_info.*,inop_balance.balance as stock_balance,
					1 as item_qty,
					viunit_info.pram_name as xitem_unit,
					item_info.item_srate as sub_total_amnt,
					round(((item_info.item_discount/100)*item_info.item_srate),2) as discount_amnt,
					round((item_info.item_srate-round(((item_info.item_discount/100)*item_info.item_srate),2)),2) as net_amount,
					round(((item_info.item_vatrate/100)*round((item_info.item_srate-round(((item_info.item_discount/100)*item_info.item_srate),2)),2)),2) as vat_amount
					from item_info 
					left join inop_balance on item_info.item_code=inop_balance.item_code
					left join viunit_info on item_info.item_unit=viunit_info.slno
					where item_info.item_code ='".$_POST['item_code']."'";
					$item_qry=$cmncls->sqlqry($item_sql);
					if(@mysql_num_rows($item_qry)>0){
						$item_info=@mysql_fetch_assoc($item_qry);
					}
					array_push($_SESSION['item_code'],$citem_info['bar_cod']);
					array_push($_SESSION['item_row'],$item_info);
					if($item_info['item_srate']==0){
						$item_info['item_srate']=NULL;
					}
					$data= '<tr>
							<td  class="col-sm-3">'
								.$item_info['item_name'].
								'<input type="hidden" class="item_code" name="item_code[]" value="'.$item_info['item_code'].'" />
							</td>
							<td>
								<span class="stock_balance">'.$item_info['stock_balance'].'</span>
							</td>
							<td class="col-sm-2">
								<input type="number" value="'.$item_info['item_qty'].'" class="form-control item_line_qty" name="item_qty[]" >
							</td>
							<td>
								<span>'.$item_info['xitem_unit'].'</span>
							</td>
							<td>
								<span>'.$item_info['item_srate'].'</span>
							</td>
							<td>
								<span class="item_amount">'.$item_info['item_srate'].'</span>
							</td>
							<td>
								<span class="discount_amnt">'.$item_info['discount_amnt'].'</span>
							</td>
							<td>
								<span class="net_amount">'.$item_info['net_amount'].'</span>
							</td>
							<td>
								<button type="button" class="btn btn-danger waves-effect delete_row">
									<i class="material-icons">delete</i>
								</button>
							</td>
						</tr>';
					if($item_info['stock_balance']>=1){
						$msg=1;
					}else{
						//$data=null;
						$msg=2;
						$text="Stock unavailable!";
						$type="warning";
					}
				}
				$rtn_data=array(
					"rtndata"		=> $data,
					"sts"			=> $msg,
					"text"			=> $text,
					"type"			=> $type
				);
				echo json_encode($rtn_data);
			}
			else if($_POST['ac_method']=='rtrive'){
				if(!isset($_SESSION['qout_slno'])){
					$_SESSION['qout_slno']=$_POST['sx_code'];
				}
				$item_sql="SELECT quotation_details.item_code,
				item_info.bar_cod, item_info.item_brate,
				item_info.item_name,item_info.item_type,
				quotation_details.item_qty,
				viunit_info.pram_name as xitem_unit,
				inop_balance.balance as stock_balance,
				quotation_details.buy_rate, quotation_details.sale_rate AS item_srate,
				round((quotation_details.sale_rate*quotation_details.item_qty),2) as sub_total_amnt,
				round(((quotation_details.disc_rate/100)*quotation_details.sale_rate)*quotation_details.item_qty,2) as discount_amnt,
				quotation_details.disc_rate AS item_discount, quotation_details.vat_rate AS item_vatrate
				FROM quotation_details
				LEFT JOIN item_info ON quotation_details.item_code=item_info.item_code
				LEFT JOIN inop_balance ON quotation_details.item_code=inop_balance.item_code
				LEFT JOIN viunit_info ON item_info.item_unit=viunit_info.slno
				WHERE quotation_details.hslno='".$_POST['sx_code']."' AND quotation_details.zid='".$_SESSION['zid']."' ";
				//echo $item_sql;
				$item_qry=$cmncls->sqlqry($item_sql);

				if(@mysql_num_rows($item_qry)>0){
					$_SESSION['item_code']=array();
					$_SESSION['item_row']=array();
					$data=NULL;
					WHILE($item_info=@mysql_fetch_array($item_qry)){
						$item_info['net_amount']	= $item_info['sub_total_amnt']-$item_info['discount_amnt'];
						$item_info['vat_amount']	= round((($item_info['item_vatrate']/100)*$item_info['net_amount']),2);
						$item_info['net_pay']		= $net_amount+$item_info['vat_amount'];
						
						$_SESSION['item_code'][]	=	$item_info['bar_cod'];
						$_SESSION['item_row'][]		=	$item_info;
						if($item_info['item_discount']==NULL){
							$item_info['item_discount']=0;
						}
						if($item_info['item_vatrate']==NULL){
							$item_info['item_vatrate']=0;
						}
						$data.= '<tr>
								<td  class="col-sm-3">'
									.$item_info['item_name'].
									'<input type="hidden" class="item_code" name="item_code[]" value="'.$item_info['item_code'].'" />
								</td>
								<td>
									<span class="stock_balance">'.$item_info['stock_balance'].'</span>
								</td>
								<td class="col-sm-2">
									<input type="number" value="'.$item_info['item_qty'].'" class="form-control item_line_qty" name="item_qty[]" >
								</td>
								<td>
									<span>'.$item_info['xitem_unit'].'</span>
								</td>
								<td>
									<span>'.$item_info['item_srate'].'</span>
								</td>
								<td>
									<span class="item_amount">'.round(($item_row['item_srate']*$item_row['item_qty']),2).'</span>
								</td>
								<td>
									<span class="discount_amnt">'.$item_info['discount_amnt'].'</span>
								</td>
								<td>
									<span class="net_amount">'.$item_info['net_amount'].'</span>
								</td>
								<td>
									<button type="button" class="btn btn-danger waves-effect delete_row">
										<i class="material-icons">delete</i>
									</button>
								</td>
							</tr>';
					}
				}
				$rtn_data=array(
					"rnd_data"		=> $data
				);
				echo json_encode($rtn_data);
			}
			else if($_POST['ac_method']=='total_calculate'){
				foreach($_SESSION['item_row'] as $item_info){
					$sub_total+=$item_info['sub_total_amnt'];
					$discount+=$item_info['discount_amnt'];
					$vat_amount+=$item_info['vat_amount'];
					$net_pay+=($item_info['net_amount']+$item_info['vat_amount']);
				}
				$rtn_data=array(
					"sub_total"			=> $sub_total,
					"discount"			=> $discount,
					"vat_amount"		=> $vat_amount,
					"net_pay"			=> $net_pay
				);
				echo json_encode($rtn_data);
			}
			else if($_POST['ac_method']=='qty_change'){
				$main_key = array_search($_POST['tr_item'], array_column($_SESSION['item_row'] ,'item_code'));
				$stock_sts=$cmncls->inop_status($_POST['tr_item'],$_POST['tr_qty']);
				if($main_key!==NULL && $stock_sts==='ok'){
					$item_srate=$_SESSION['item_row'][$main_key]['item_srate'];
					$item_discount=$_SESSION['item_row'][$main_key]['item_discount'];
					$item_vatrate=$_SESSION['item_row'][$main_key]['item_vatrate'];
					
					$_SESSION['item_row'][$main_key]['item_qty']=$_POST['tr_qty'];
					$_SESSION['item_row'][$main_key]['sub_total_amnt']=$_POST['tr_qty']*$item_srate;
					$_SESSION['item_row'][$main_key]['discount_amnt']=round((($item_discount/100)*$item_srate)*$_POST['tr_qty'],2);
					$_SESSION['item_row'][$main_key]['net_amount']=$_SESSION['item_row'][$main_key]['sub_total_amnt']-$_SESSION['item_row'][$main_key]['discount_amnt'];
					$_SESSION['item_row'][$main_key]['vat_amount']=round((($item_vatrate/100)*$_SESSION['item_row'][$main_key]['net_amount']),2);
					$_SESSION['item_row'][$main_key]['net_pay']=$_SESSION['item_row'][$main_key]['net_amount']+$_SESSION['item_row'][$main_key]['vat_amount'];
					//$rtn_data=$_SESSION['item_row'][$main_key];
					$rtn_data=array(
						"line_amount"			=> $_SESSION['item_row'][$main_key]['sub_total_amnt'],
						"line_discount"			=> $_SESSION['item_row'][$main_key]['discount_amnt'],
						"line_net"				=> $_SESSION['item_row'][$main_key]['net_amount'],
						"sts"					=> 1
					);
				}else{
					if($stock_sts!=null){
						$rtn_data=array(
							"avail_qty"				=> $stock_sts,
							"text"					=> 'Stock unavailable!',
							"type"					=> 'warning',
							"sts"					=> 0
						);
					}else if($stock_sts===null){
						$rtn_data=array(
							"text"					=> 'Stock unavailable!',
							"type"					=> 'error',
							"sts"					=> 0
						);
					}else{
						$rtn_data=array(
							"text"					=> 'Session invalid!',
							"type"					=> 'error',
							"sts"					=> 0
						);
					}
				}
				echo json_encode($rtn_data);
			}
			else if($_POST['ac_method']=='delete_item'){
				//remove item from temp session row list//
				$main_key = array_search($_POST['tr_item'], array_column($_SESSION['item_row'] , 'item_code'));
				if($main_key!==NULL){
					unset($_SESSION['item_row'][$main_key]);
					$_SESSION['item_row'] = array_values($_SESSION['item_row']);
				}
				$item_info=$cmncls->newpikval('item_info','item_code',$_POST['tr_item']);
				$prokey = array_search($item_info['bar_cod'],$_SESSION['item_code']);
				if($prokey!==NULL){
					unset($_SESSION['item_code'][$prokey]);
					$_SESSION['item_code'] = array_values($_SESSION['item_code']);
				}
				//foreach($_SESSION['item_row'] as $main_key=>$values){
				//	$key = array_search($_POST['tr_item'],$values);
				//}
				////remove bar-code from temp session list//
				//$prokey = array_search($item_info['bar_cod'],$_SESSION['item_code']);
				//if($prokey>0){
				//	unset($_SESSION['item_code'][$prokey]);
				//}else{
				//	array_shift($_SESSION['item_code']);
				//}
				echo json_encode($rtn_data);
			}
			else if($_POST['ac_method']=='add_quotation_trn'){
				if($_POST['quot_date']==null){
					$_POST['quot_date']=date('Y-m-d');
				}
				if($_POST['quot_advance_rate']==null){
					$_POST['quot_advance_rate']=0;
				}
				if($_POST['quot_pay_method']!='cash' && $_POST['quot_pay_method']!='credit'){
					$_POST['quot_advance_rate']=$_POST['quot_netamount'];
				}
				if(!isset($_SESSION['qout_slno'])){
					$hslno = $action->getslno('quotation_header');
					$shead_sql="INSERT INTO quotation_header(slno, zid, dcus_cod, quot_date, quot_amount,
					quot_discount_rate, quot_discount, quot_vat, quot_netamount, quot_pay_method, quot_advance_rate, quot_ref, quot_desc, dent_id)
					VALUES('".$hslno."','".$_SESSION['zid']."','".$_POST['dcus_cod']."','".$_POST['quot_date']."','".$_POST['quot_amount']."',
					'".(($_POST['quot_discount']*100)/$_POST['quot_netamount'])."','".$_POST['quot_discount']."','".$_POST['quot_vat']."','".$_POST['quot_netamount']."','".$_POST['quot_pay_method']."',
					'".$_POST['quot_advance_rate']."','".$_POST['quot_ref']."','".$_POST['quot_desc']."','".$_SESSION['user_id']."')";
					$cmncls->sqlqry($shead_sql);
					if(!@mysql_errno()){
						$sdetail_sql="INSERT INTO quotation_details(hslno, zid, item_code, item_qty, sale_rate, buy_rate, disc_rate, vat_rate, ent_id) VALUES ";
						foreach($_SESSION['item_row'] as $item_info){
							$cost_goods+=round(($item_info['item_brate']*$item_info['item_qty']),2);
							$sdetail_sqli.="('".$hslno."','".$_SESSION['zid']."','".$item_info['item_code']."','".$item_info['item_qty']."','".$item_info['item_srate']."','".$item_info['item_brate']."','".$item_info['item_discount']."','".$item_info['item_vatrate']."','".$_SESSION['user_id']."'),";
						}
						if($sdetail_sqli!=NULL){
							$sdetail_sql.=substr($sdetail_sqli, 0, -1);
							if($cmncls->sqlqry($sdetail_sql)){
								$_SESSION['qout_slno']=$hslno;
								$title="Done!";
								$text="Successfully Saved!";
								$type="success";
							}
						}else{
							$cmncls->delete('quotation_header','slno','$hslno');
						}
					}else{
						$title="Error!";
						$text=@mysql_error()." at Transaction Head!";
						$type="error";
					}
					
				}else{
					$hupdt_sql="UPDATE quotation_header SET 
					quot_amount='".$_POST['quot_amount']."',
					quot_discount='".$_POST['quot_discount']."',
					quot_vat='".$_POST['quot_vat']."',
					quot_netamount='".$_POST['quot_netamount']."',
					quot_pay_method='".$_POST['quot_pay_method']."',
					quot_advance_rate='".$_POST['quot_advance_rate']."',
					quot_ref='".$_POST['quot_ref']."',
					quot_desc='".$_POST['quot_desc']."',
					updt_id='".$_SESSION['user_id']."'
					WHERE slno='".$_SESSION['qout_slno']."'
					AND zid='".$_SESSION['zid']."'";
					$cmncls->sqlqry($hupdt_sql);
					if(!@mysql_errno()){
						$cmncls->delete('quotation_details','hslno',$_SESSION['qout_slno']);
						$sdetail_sql="INSERT INTO quotation_details(hslno, zid, item_code, item_qty, sale_rate, buy_rate, disc_rate, vat_rate, ent_id) VALUES ";
						foreach($_SESSION['item_row'] as $item_info){
							$cost_goods+=round(($item_info['item_brate']*$item_info['item_qty']),2);
							$sdetail_sqli.="('".$_SESSION['qout_slno']."','".$_SESSION['zid']."','".$item_info['item_code']."','".$item_info['item_qty']."','".$item_info['item_srate']."','".$item_info['item_brate']."','".$item_info['item_discount']."','".$item_info['item_vatrate']."','".$_SESSION['user_id']."'),";
						}
						if($sdetail_sqli!=NULL){
							$sdetail_sql.=substr($sdetail_sqli, 0, -1);
							$cmncls->sqlqry($sdetail_sql);
						}
						if(!@mysql_errno()){
							$data=array(
								'slno'					=>$_SESSION['qout_slno'],
								'dcus_cod'				=>$_POST['dcus_cod'],
								'quot_date'				=>$_POST['quot_date'],
								'quot_amount'			=>$_POST['quot_amount'],
								'quot_discount'			=>$_POST['quot_discount'],
								'quot_vat'				=>$_POST['quot_vat'],
								'quot_netamount'		=>$_POST['quot_netamount'],
								'quot_advance_rate'		=>$_POST['quot_advance_rate'],
								'trn_cost_goods'		=>	$cost_goods,
							);
							$Acc_sts=$accounts->CorpSalseToAccounts($data,'update');
							if($Acc_sts===true){
								$title="Done!";
								$text="Successfully Saved!";
								$type="success";
							}else{
								$title="Warning!";
								$text="Successfully Saved Without Accounts Voucher!";
								$type="warning";
							}
							$title="Done!";
							$text="Successfully Saved!";
							$type="success";
						}else{
							$title="Error!";
							$text=@mysql_error()." at details!";
							$type="error";
							unset($_SESSION['qout_slno']);
						}
					}else{
						$title="Error!";
						$text=@mysql_error()." at Transaction Head!";
						$type="error";
					}
				}
				$rtn_data=array(
					'rtndata'		=>$_SESSION['qout_slno'],
					'title'			=>$title,
					'text'			=>$text,
					'type'			=>$type
				);
				echo json_encode($rtn_data);
			}
		}
		exit;
	}else{
		$_SESSION[msg] = $msg;
		$_SESSION[clor] = $clor;
		header("location:index.php?pg=".$_POST[ppg]."&&sx_code=".$sxcode);
	}
?>
