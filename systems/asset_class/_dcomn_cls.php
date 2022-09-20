<?php
class comncls extends database{
	public function __construct(){
		parent::__construct();
	}
	public function newpikval($tbl_num,$fild,$sx_code,$sql_cmd=NULL){
		if(isset($sql_cmd)!=NULL){
			$search=$sql_cmd;
		}
		else if ($sx_code!=NULL){
			$search = "Select * from $tbl_num where $fild = '$sx_code'";
			if($this->checkZid($tbl_num) && $_SESSION['zid']>1){
				$search .=" AND zid in('".$_SESSION['zid']."','1')";
			}
		}
		$qrsearch=mysql_query($search);
		if($qrsearch){
			$newval=mysql_fetch_array($qrsearch);
			return $newval;
		}
	}
	
	public function pikval_byexp($tbl_num,$sx_code){
		if ($sx_code!=NULL){
			$search="Select * from $tbl_num where $sx_code";
			$qrsearch=mysql_query($search);
		}
		if($qrsearch){
			$newval=mysql_fetch_array($qrsearch);
			return $newval;
		}
	}
	public function newval($tbl_num,$fild,$sx_code){
		if ($sx_code!=NULL){
			$search="Select * from $tbl_num where $fild = '$sx_code'";
			$qrsearch=mysql_query($search);
		}
		if($qrsearch){
			return $qrsearch;
		}
	}
	
	public function sqlqry($qrury){
		if ($qrury!=NULL){
			$quryrslt=mysql_query($qrury);
			return $quryrslt;
		}
	}
	public function tim_gen($pickval=NULL){
		for($i = 0; $i<24; $i++){
			$i = sprintf('%02d',$i);
			for($j = 0; $j < 60; $j = $j+5){
				$j = sprintf('%02d',$j);
				$sct_time = $i.":".$j.":"."00";
				?> 
				<option value="<? echo "$i:$j:00";?>"<? if ($pickval == $sct_time) {?> selected="selected" <? }?> ><? echo "$i:$j" ?></option>";
				<?
			}
		}
	}
	function datediff($dateA,$dateB){
		$date1 = new DateTime($dateA);
		$date2 = new DateTime($dateB);
		$interval = $date1->diff($date2);
		$elapsed   = $interval->format('%y years, %m months, %d days, %H:%I:%S');
		$elapsed = str_replace(array('0 years,', ' 0 months,', ' 0 days,'), '', $elapsed);
		$elapsed = str_replace(array('1 years, ', ' 1 months, ', ' 1 days, ', ' 1 hours, ', ' 1 minutes', ' 1 seconds'), array('1 year, ', '1 month, ', ' 1 day, ', ' 1 hour, ', ' 1 minute', ' 1 second'), $elapsed);
		return $elapsed;
	}
	//--------------In Word In English-------//
	function convert_number_to_words($number){
		$hyphen			='-';
		$conjunction	=' ';
		$separator		=' ';
		$negative		='negative ';
		$decimal		=' and paisa ';
		$dictionary  = array(
			0					=> 'Zero',
			1					=> 'One',
			2					=> 'Two',
			3					=> 'Three',
			4					=> 'Four',
			5					=> 'Five',
			6					=> 'Six',
			7					=> 'Seven',
			8					=> 'Eight',
			9					=> 'Nine',
			10					=> 'Ten',
			11					=> 'Eleven',
			12					=> 'Twelve',
			13					=> 'Thirteen',
			14					=> 'Fourteen',
			15					=> 'Fifteen',
			16					=> 'Sixteen',
			17					=> 'Seventeen',
			18					=> 'Eighteen',
			19					=> 'Nineteen',
			20					=> 'Twenty',
			30					=> 'Thirty',
			40					=> 'Fourty',
			50					=> 'Fifty',
			60					=> 'Sixty',
			70					=> 'Seventy',
			80					=> 'Eighty',
			90					=> 'Ninety',
			100					=> 'Hundred',
			1000				=> 'Thousand',
			100000				=>'Lac',
			10000000			=>'Crore',
			1000000000			=>'Hundred Crore',
			100000000000		=>'Hundred Billion' 
		);
		if (!is_numeric($number)) {
			return false;
		}
		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
			// overflow
			trigger_error(
				'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
				E_USER_WARNING
			);
			return false;
		}
		if ($number < 0) {
			return $negative . $this->convert_number_to_words(abs($number));
		}
		$string = $fraction = null;
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
				break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= $hyphen . $dictionary[$units];
				}
				break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= $conjunction . $this->convert_number_to_words($remainder);
				}
				break;
			default:
				$baseUnit = 10 * pow(100, floor(log($number/10, 100)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number % $baseUnit;
				$string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= $remainder < 100 ? $conjunction : $separator;
					$string .= $this->convert_number_to_words($remainder);
				}
				break;
		}
		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}
		return $string;
	}
	//-----End-------------//
//Encrypt and Decrypt Function
	function encryptIt( $q ){
		$cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
		$qEncoded = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
		return( $qEncoded );
	}
	function decryptIt( $q ){
		$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
		$qDecoded = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
		return( $qDecoded );
	}
//End Encrypt and Decrypt Function

//loged ID
	function eventer_info($id_val){
		$rtn_val = $this->newpikval(dusr_info,dusr_id,$id_val);
		$user_info = array(
			id_				=>$rtn_val[dusr_id],
			name_			=>$rtn_val[dusr_num],
			log_id_			=>$rtn_val[dusr_logid],
			access_code		=>$rtn_val[dusr_acscod],
			designation_	=>$rtn_val[dusr_dsig]);
		return $user_info;
	}
//End Loged ID
	function chkdepnd($tblnum, $sfld, $svlu){
		$this->qrycmd = "SELECT * FROM $tblnum where $sfld = '$svlu'";
		$this->qryrslt = mysql_query($this->qrycmd);
		if ($this->qryrslt){
				while($rslt = mysql_fetch_array($this->qryrslt)){
					if ($rslt!=NULL){
						return true;
					}
					else {
						return false;
					}
				}
			
		}
	}
	function isTime($time,$is24Hours=true,$seconds=true){
		$pattern = "/^".($is24Hours ? "([1-2][0-3]|[01]?[1-9])" : "(1[0-2]|0?[1-9])").":([0-5]?[0-9])".($seconds ? ":([0-5]?[0-9])" : "")."$/";
		if (preg_match($pattern, $time)){
				return true;
		}
		return false;
	}
	function validateDate($date, $format = 'Y-m-d H:i:s'){
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
	function maya_escap_string($data){
		if(is_array($data)){
			foreach($data as $key => $value) {
				if(!is_array($value)){
					$value = trim($value);
					//$value = htmlspecialchars($value);
					$value = mysql_real_escape_string($value);
					$return[$key] = $value;
				}else{
					$return[$key] = $value;
				}
			}
		}else{
			$newVal = trim($data);
			$newVal = htmlspecialchars($newVal);
			$return = mysql_real_escape_string($newVal);
		}
		return $return;
	}
	public function img_uplod($imgfld,$dst_path,$imgcmpsize=NULL,$dstimgnum = NULL){
		$valid_formats = array("jpeg","JPEG","jpg","JPG", "png","PNG", "gif","GIF", "bmp", "BMP");
		$name = $_FILES[$imgfld]['name'];
		$size = $_FILES[$imgfld]['size'];
		if(strlen($name)){
			list($txt, $ext) = explode(".", $name);
			if(in_array($ext,$valid_formats)){
				if($size < $imgcmpsize){
					$actual_image_name = time().$dstimgnum.".".$ext;
					$tmp = $_FILES[$imgfld]['tmp_name'];
					$dst_path = $dst_path.$actual_image_name;
					if(move_uploaded_file($tmp, $dst_path)){
						return $dst_path;
					}
				}
			}
		}
	}
	public function m_implode($data){
		if(is_array($data) && isset($data)){
			foreach($data as $key=>$item){
				$data[$key]="'".$item."'";
			}
			return implode(",",$data);
		}else{
			return null;
		}
	}
	function inop_status($item,$qty){
		$chk_sql="SELECT balance FROM inop_balance WHERE item_code='".$item."'";
		$rtn_qry=$this->execute_query($chk_sql);
		if(@mysql_num_rows($rtn_qry)>0){
			$data=@mysql_fetch_assoc($rtn_qry);
			if($data['balance']>=$qty){
				return 'ok';
			}else{
				return $data['balance'];
			}
		}else{
			return null;
		}
	}
	function gen_xvoucher($prefix,$xdate){
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
}
?>