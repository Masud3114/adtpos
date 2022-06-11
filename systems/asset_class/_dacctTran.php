<?php
class accounts extends database{
	public function __construct(){
		parent::__construct();
	}
	private function gen_xvoucher($prefix,$xdate){
		$first_date=date('Y-m-',strtotime($xdate)).'01';
		$last_date=date('Y-m-t',strtotime($xdate));
		$sql_cmd="SELECT MAX(xvoucher) AS last_voucher FROM acct_glheader 
		WHERE xvoucher LIKE '".$prefix."%' AND xdate ='".$xdate."'";
		$rtn_qry=$this->execute_query($sql_cmd);
		if(@mysql_num_rows($rtn_qry)>0){
			$data=@mysql_fetch_assoc($rtn_qry);
			if($data['last_voucher']!=NULL){
				$cur_voucher=array();
				$cur_voucher=explode('-',$data['last_voucher']);
				$xvoucher=$cur_voucher[0].'-'.$cur_voucher[1].'-'.sprintf("%06s", ($cur_voucher[2]+1));
			}else{
				$xvoucher=$prefix.date('dmy',strtotime($xdate)).'-'.sprintf("%06s", 1);
			}
		}else{
			$xvoucher=$prefix.date('dmy',strtotime($xdate)).'-'.sprintf("%06s", 1);
		}
		return $xvoucher;
	}
	public function posToAccounts($data,$ac_type='add'){
		if($ac_type!='add'){
			$whr_cod = " WHERE hslno = (SELECT slno FROM acct_glheader WHERE autoRef = '".$data['slno']."') AND sts ='1'";
			$dlt_sts = $this->delete('acct_gldetail','','',$whr_cod);
			if($dlt_sts==1){
				$whr_cod = " WHERE autoRef = '".$data['slno']."' AND sts ='1'";
				$dlt_sts = $this->delete('acct_glheader','','',$whr_cod);
			}
		}
		$glhslno 		= $this->getslno('acct_glheader');
		$xvoucher=$this->gen_xvoucher('POI-',$data['trn_date']);
		$acct_hdata=array(
			'slno'					=>$glhslno,
			'xvoucher'				=>$xvoucher,
			'prfx_name'				=>'POI-',
			'xdate'					=>$data['trn_date'],
			'xref'					=>'POS Sales Voucher ('."MON-".DATE('ym',strtotime($data['trn_date'])).$data['slno'].")",
			'autoRef'				=>$data['slno'],
			'xnarration'			=>'Cash Sales from POS station!',
			'dent_id'				=>$_SESSION['user_id']
		);
		$adsts=$this->insert_data('acct_glheader',$acct_hdata);
		if($adsts==1){
			$acc_details=array();
			if($data['trn_sub_total']!=NULL && $data['trn_sub_total']>0){
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>'40-000002', 					//Point of Sales Head (Income)//
					'xcredit'			=>$data['trn_sub_total'],		// Total Sales Amount Excluding Discount & VAT//
					'xdebit'			=>0,
					'dent_id'			=>$_SESSION['user_id']
				);
			}
			if($data['trn_vat_amnt']!=NULL && $data['trn_vat_amnt']>0){
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>'22-000001', 					// VAT Head (Liability) //
					'xcredit'			=>$data['trn_vat_amnt'],		// Total Sales VAT//
					'xdebit'			=>0,
					'dent_id'			=>$_SESSION['user_id']
				);
			}
			if($data['trn_discount']!=NULL && $data['trn_discount']>0){
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>'55-000001',					// Sales Discount Head (Expense)//
					'xdebit'			=>$data['trn_discount'],		// Total Sales Discount //
					'xcredit'			=>0,
					'dent_id'			=>$_SESSION['user_id']
				);
			}
			if($data['trn_net_pay']!=NULL && $data['trn_net_pay']>0){
				if($data['trn_ptype']=='cash'){
					$acct_code='11-000001';
				}else if ($data['trn_ptype']=='card'){
					$acct_code='13-000001';
				}else if ($data['trn_ptype']=='mbank'){
					$acct_code='13-000002';
				}
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>$acct_code,					// Point of Sales Head //
					'xdebit'			=>$data['trn_net_pay'],		// Total Sales Amount including Discount & VAT //
					'xcredit'			=>0,
					'dent_id'			=>$_SESSION['user_id']
				);
			}
			if($data['trn_cost_goods']!=NULL && $data['trn_cost_goods']>0){
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>'56-000001',					// Cost of goods Sold (Expense)//
					'xdebit'			=>$data['trn_cost_goods'],		// Cost of goods //
					'xcredit'			=>0,
					'dent_id'			=>$_SESSION['user_id']
				);
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>'11-000003',					// Cost of goods Sold (Expense)//
					'xdebit'			=>0,		// Cost of goods //
					'xcredit'			=>$data['trn_cost_goods'],
					'dent_id'			=>$_SESSION['user_id']
				);
			}
			foreach($acc_details as $acc_RowData){
				$adDetailSts=$this->insert_data('acct_gldetail',$acc_RowData);
			}
			return true;
		}else{
			return false;
		}
	}
	public function CorpSalseToAccounts($data,$ac_type='add'){
		if($ac_type!='add'){
			$whr_cod = " WHERE hslno = (SELECT slno FROM acct_glheader WHERE autoRef = '".$data['slno']."') AND sts ='1'";
			//echo $whr_cod;
			$dlt_sts = $this->delete('acct_gldetail','','',$whr_cod);
			if($dlt_sts==1){
				$whr_cod = " WHERE autoRef = '".$data['slno']."' AND sts ='1'";
				$dlt_sts = $this->delete('acct_glheader','','',$whr_cod);
			}
		}
		//exit;
		$glhslno 		= $this->getslno('acct_glheader');
		$xvoucher=$this->gen_xvoucher('CIN-',$data['trn_date']);
		$acct_hdata=array(
			'slno'					=>$glhslno,
			'xvoucher'				=>$xvoucher,
			'prfx_name'				=>'CIN-',
			'xdate'					=>$data['trn_date'],
			'xref'					=>'General / Corporate Sales Voucher('."MON-".DATE('ym',strtotime($data['trn_date'])).$data['slno'].")",
			'autoRef'				=>$data['slno'],
			'xnarration'			=>'General / Corporate Sales !',
			'dent_id'				=>$_SESSION['user_id']
		);
		$adsts=$this->insert_data('acct_glheader',$acct_hdata);
		if($adsts==1){
			$acc_details=array();
			if($data['trn_sub_total']!=NULL && $data['trn_sub_total']>0){
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>'40-000001', 					// Corporate Sales Head (Income)//
					'xcredit'			=>$data['trn_sub_total'],		// Total Sales Amount Excluding Discount & VAT//
					'xdebit'			=>0,
					'dent_id'			=>$_SESSION['user_id']
				);
			}
			if($data['trn_vat_amnt']!=NULL && $data['trn_vat_amnt']>0){
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>'22-000001', 					// VAT Head (Liability)//
					'xcredit'			=>$data['trn_vat_amnt'],		// Total Sales VAT//
					'xdebit'			=>0,
					'dent_id'			=>$_SESSION['user_id']
				);
			}
			if($data['trn_discount']!=NULL && $data['trn_discount']>0){
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>'55-000001',					// Sales Discount Head (Expense)//
					'xdebit'			=>$data['trn_discount'],		// Total Sales Discount //
					'xcredit'			=>0,
					'dent_id'			=>$_SESSION['user_id']
				);
			}
			if($data['trn_net_pay']!=NULL && $data['trn_net_pay']>0){
				
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>'11-000004',					// Receivable Head //
					'acct_code_sub'		=>$data['dcus_cod'],			// Receivable Customer Head //
					'xdebit'			=>$data['trn_net_pay'],			// Total Sales Amount Excluding Discount & VAT//
					'xcredit'			=>0,
					'dent_id'			=>$_SESSION['user_id']
				);
			}
			if($data['trn_cash']!=NULL && $data['trn_cash']>0){
				if ($data['trn_ptype']=='card'){
					$bacct_code='13-000001';
				}else if ($data['trn_ptype']=='mbank'){
					$bacct_code='13-000002';
				}else{
					$bacct_code='11-000001';
				}
				
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>'11-000004',					// Receivable Head //
					'acct_code_sub'		=>$data['dcus_cod'],			// Receivable Customer Head //
					'xdebit'			=>0,							// Total Sales Amount Excluding Discount & VAT//
					'xcredit'			=>$data['trn_cash'],
					'dent_id'			=>$_SESSION['user_id']
				);
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>$bacct_code,					// Receivable Head //
					'xdebit'			=>$data['trn_cash'],			// Total Sales Amount Excluding Discount & VAT//
					'xcredit'			=>0,
					'dent_id'			=>$_SESSION['user_id']
				);
			}
			if($data['trn_cost_goods']!=NULL && $data['trn_cost_goods']>0){
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>'56-000001',					// Cost of goods Sold (Expense)//
					'xdebit'			=>$data['trn_cost_goods'],		// Cost of goods //
					'xcredit'			=>0,
					'dent_id'			=>$_SESSION['user_id']
				);
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>'11-000003',					// Cost of goods Sold (Expense)//
					'xdebit'			=>0,		// Cost of goods //
					'xcredit'			=>$data['trn_cost_goods'],
					'dent_id'			=>$_SESSION['user_id']
				);
			}
			foreach($acc_details as $acc_RowData){
				$adDetailSts=$this->insert_data('acct_gldetail',$acc_RowData);
			}
			return true;
		}else{
			return false;
		}
	}
	public function InopReceiveToAccounts($data){
		//remove previous data//
		$whr_cod = " WHERE hslno = (SELECT slno FROM acct_glheader WHERE autoRef = '".$data['slno']."') AND sts ='1'";
		$dlt_sts = $this->delete('acct_gldetail','','',$whr_cod);
		if($dlt_sts==1){
			$whr_cod = " WHERE autoRef = '".$data['slno']."' AND sts ='1'";
			$dlt_sts = $this->delete('acct_glheader','','',$whr_cod);
		}
		//End Remove//
		
		$glhslno	= $this->getslno('acct_glheader');
		$xvoucher	= $this->gen_xvoucher('IR-',$data['trn_date']);
		$acct_hdata=array(
			'slno'					=>$glhslno,
			'xvoucher'				=>$xvoucher,
			'prfx_name'				=>'IR-',
			'xdate'					=>$data['trn_date'],
			'xref'					=>'Inventory Receive Voucher('."MONR-".DATE('ym',strtotime($data['trn_date'])).$data['slno'].")",
			'autoRef'				=>$data['slno'],
			'xnarration'			=>'Inventory Receive Voucher!',
			'dent_id'				=>$_SESSION['user_id']
		);
		$adsts=$this->insert_data('acct_glheader',$acct_hdata);
		if($adsts==1){
			$acc_details=array();
			if($data['goods_amount']!=NULL && $data['goods_amount']>0){
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>'11-000003',					// Inventory Asset Head//
					'xdebit'			=>$data['goods_amount'],		// Products Value //
					'xcredit'			=>0,
					'dent_id'			=>$_SESSION['user_id']
				);
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>'20-000001',					// Accounts Payable//
					'acct_code_sub'		=>$data['receive_from'],		// Ledger Head//
					'xdebit'			=>0,							
					'xcredit'			=>$data['goods_amount'],		// Products Value
					'dent_id'			=>$_SESSION['user_id']
				);
			}
			foreach($acc_details as $acc_RowData){
				$adDetailSts=$this->insert_data('acct_gldetail',$acc_RowData);
			}
			return true;
		}else{
			return false;
		}
	}
	public function InopPurchaseToAccounts($data){
		//remove previous data//
		$whr_cod = " WHERE hslno = (SELECT slno FROM acct_glheader WHERE autoRef = '".$data['slno']."') AND sts ='1'";
		$dlt_sts = $this->delete('acct_gldetail','','',$whr_cod);
		if($dlt_sts==1){
			$whr_cod = " WHERE autoRef = '".$data['slno']."' AND sts ='1'";
			$dlt_sts = $this->delete('acct_glheader','','',$whr_cod);
		}
		//End Remove//
		
		$glhslno	= $this->getslno('acct_glheader');
		$xvoucher	= $this->gen_xvoucher('IP-',$data['trn_date']);
		$acct_hdata=array(
			'slno'					=> $glhslno,
			'xvoucher'				=> $xvoucher,
			'prfx_name'				=> 'IP-',
			'xdate'					=> $data['trn_date'],
			'xref'					=> 'Inventory Receive Voucher('."MONP-".DATE('ym',strtotime($data['trn_date'])).$data['slno'].")",
			'autoRef'				=> $data['slno'],
			'xnarration'			=> 'Inventory Receive Voucher!',
			'dent_id'				=> $_SESSION['user_id']
		);
		$adsts=$this->insert_data('acct_glheader',$acct_hdata);
		if($adsts==1){
			$acc_details=array();
			if($data['goods_amount']!=NULL && $data['goods_amount']>0){
				$acc_details[]=array(
					'hslno'				=> $glhslno,
					'acct_code'			=> '11-000003',					// Inventory Asset Head//
					'xdebit'			=> $data['goods_amount'],		// Products Value //
					'xcredit'			=> 0,
					'dent_id'			=> $_SESSION['user_id']
				);
				$acc_details[]=array(
					'hslno'				=> $glhslno,
					'acct_code'			=> '20-000001',					// Accounts Payable//
					'acct_code_sub'		=> $data['receive_from'],		// Ledger Head//
					'xdebit'			=> 0,							
					'xcredit'			=> $data['goods_amount'],		// Products Value
					'dent_id'			=> $_SESSION['user_id']
				);
				$acc_details[]=array(
					'hslno'				=> $glhslno,
					'acct_code'			=> '11-000001',					// Inventory Asset Head//
					'xdebit'			=> 0,							// Products Value //
					'xcredit'			=> $data['goods_amount'],
					'dent_id'			=> $_SESSION['user_id']
				);
				$acc_details[]=array(
					'hslno'				=> $glhslno,
					'acct_code'			=> '20-000001',					// Accounts Payable//
					'acct_code_sub'		=> $data['receive_from'],		// Ledger Head//
					'xdebit'			=> $data['goods_amount'],							
					'xcredit'			=> 0,		// Products Value
					'dent_id'			=> $_SESSION['user_id']
				);
			}
			foreach($acc_details as $acc_RowData){
				$adDetailSts=$this->insert_data('acct_gldetail',$acc_RowData);
			}
			return true;
		}else{
			return false;
		}
	}
	public function InopissueToAccounts($data){
		//remove previous data//
		$whr_cod = " WHERE hslno = (SELECT slno FROM acct_glheader WHERE autoRef = '".$data['slno']."') AND sts ='1'";
		$dlt_sts = $this->delete('acct_gldetail','','',$whr_cod);
		if($dlt_sts==1){
			$whr_cod = " WHERE autoRef = '".$data['slno']."' AND sts ='1'";
			$dlt_sts = $this->delete('acct_glheader','','',$whr_cod);
		}
		//End Remove//
		
		$glhslno	= $this->getslno('acct_glheader');
		$xvoucher	= $this->gen_xvoucher('IS-',$data['trn_date']);
		$acct_hdata=array(
			'slno'					=>$glhslno,
			'xvoucher'				=>$xvoucher,
			'prfx_name'				=>'IS-',
			'xdate'					=>$data['trn_date'],
			'xref'					=>'Inventory Issue Voucher('."MONI-".DATE('ym',strtotime($data['trn_date'])).$data['slno'].")",
			'autoRef'				=>$data['slno'],
			'xnarration'			=>'Inventory Issue Voucher!',
			'dent_id'				=>$_SESSION['user_id']
		);
		$adsts=$this->insert_data('acct_glheader',$acct_hdata);
		if($adsts==1){
			$acc_details=array();
			if($data['trn_cost_goods']!=NULL && $data['trn_cost_goods']>0){
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>'11-000003',					// Inventory Asset Head//
					'xdebit'			=>0,		// Products Value //
					'xcredit'			=>$data['trn_cost_goods'],
					'dent_id'			=>$_SESSION['user_id']
				);
				$acc_details[]=array(
					'hslno'				=>$glhslno,
					'acct_code'			=>'11-000004',				// Accounts Payable//
					'acct_code_sub'		=>$data['trn_to'],			// Ledger Head//
					'xdebit'			=>$data['trn_cost_goods'],	// Products Value
					'xcredit'			=>0,
					'dent_id'			=>$_SESSION['user_id']
				);
			}
			foreach($acc_details as $acc_RowData){
				$adDetailSts=$this->insert_data('acct_gldetail',$acc_RowData);
			}
			return true;
		}else{
			return false;
		}
	}
}
$accounts=new accounts();
?>