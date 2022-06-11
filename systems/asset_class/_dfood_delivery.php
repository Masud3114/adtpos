<?php
class food_delivery extends database{
	var $return_data=NULL;
	function show_active_list($frm_date){
		$sel_sql = "SELECT food_delivery_sts.slno, food_delivery_sts.dcus_cod,
		food_delivery_sts.item_code,food_delivery_sts.item_qty,
		food_delivery_sts.item_rate,food_delivery_sts.del_active,food_delivery_sts.del_sts,
		dcus_info.dcus_num,dcus_info.dcus_mobno,dcus_info.dcus_adrs,item_info.item_name
		FROM food_delivery_sts
		LEFT JOIN dcus_info ON food_delivery_sts.dcus_cod=dcus_info.dcus_cod
		LEFT JOIN item_info ON food_delivery_sts.item_code=item_info.item_code
		WHERE food_delivery_sts.del_date='".$frm_date."'";
		//echo $sel_sql;
		$sel_qry = @mysql_query($sel_sql);
		if (@mysql_num_rows($sel_qry) != NULL) {
			while ($client_info = @mysql_fetch_array($sel_qry)) {
				$slno = $slno + 1;
				$return_data.= '
				<form method="post" id="action_from_'.$slno.'">
					<tr valign="top">
						<td >' . $slno . '</td>
						<td >' . $client_info['dcus_num'] . '</td>
						<td >' . $client_info['dcus_mobno'] . '</td>
						<td >' . $client_info['dcus_adrs'] . '</td>
						<td >' . $client_info['item_name'] . '</td>
						<td >' . $client_info['item_rate'] . '</td>
						<td class="col-lg-2">
							<input type="hidden" name="slno" value="' . $client_info['slno'] . '">
							<input type="hidden" name="ppg" value="' . $_POST['ppg'] . '" />
							<input type="number" name="item_qty" class="form-control receive_qty" value="'.$client_info['item_qty'].'">
						</td>
						<td>
							<button type="button" data="update" data-target="action_from_'.$slno.'" class="btn btn-info waves-effect back_submit">
								<i class="material-icons">save</i>
							</button>
						</td>
						<td>
							<button type="button" data="delete" class="btn btn-danger waves-effect back_submit">
								<i class="material-icons">delete</i>
							</button>
						</td>
					</tr>
				</form>
				';
			}
		}
		return $return_data;
	}
	function autodelivery_list_process($del_date,$item_code=NULL){
		if($item_code!=NULL){
			$post_item_code=$item_code;
		}else{
			$post_item_code="PR-000000001";
		}
		$process_sql="INSERT INTO food_delivery_sts (dcus_cod,item_code,del_date,item_rate,dent_id)
		SELECT dcus_info.dcus_cod,item_info.item_code,'".$del_date."',item_info.item_srate,'".$_SESSION['user_id']."'
		FROM dcus_info,item_info
		WHERE dcus_info.dcus_type='1' AND item_info.item_code='".$post_item_code."'";
		$this->execute_query($process_sql);
	}
}
?>