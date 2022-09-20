<?php
class database{
	var $con;
	var $qrycmd;
	var $qryrslt;
	var $seldb;
	var $myconn;
	var $result = array();
	
	public function __construct(){
		if(!$this->con){
			$this->myconn = @mysql_connect(DB_HOST,DB_USER,DB_PASS);
			if($this->myconn){
				$this->seldb = @mysql_select_db(DB_NAME,$this->myconn);
				if($seldb){
					$this->con = true;
					return true;
				} else {
					return false;
				}
			} else{
				return false;
			}
		} else{
			return true;
		}
	}
	public function __destruct(){
		if($this->con){
			if(@mysql_close()){
				$this->con = false;
				return true;
			}else{
				return false;
			}
		}
	}
	public function escap_string($data){
		if(is_array($data)){
			foreach($data as $key => $value) {
				if(!is_array($value)){
					$value = trim($value);
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
	public function insert_data($table, $value,$skip_vals=null){
		if ($this->tableExists($table)) {
			$value=$this->escap_string($value);
			if($this->checkZid($table) && $skip_vals[0]!="register" ){
				if($_SESSION['zid']!=NULL && $_SESSION['zid']!=''){
					$value['zid']	= $_SESSION['zid'];
				}else{
					return "Please setup your Business information!";
				}
			}
			if($skip_vals!=null){
				foreach($skip_vals as $skip_val){
					unset($value[$skip_val]);
				}
			}
			if (isset($value)) {
				foreach ($value as $pointer => $data) {
					if($data!=null){
						$field[]       = $pointer;
						$field_value[] = "'" . $data . "'";
					}
				} //$value as $pointer => $data
				$field       = implode(',', $field);
				$field_value = implode(',', $field_value);
				$insert_sql  = 'INSERT INTO ' . $table . " (" . $field . ") VALUES (" . $field_value . ")";
				@mysql_query($insert_sql);
				if (!@mysql_errno()) {
					return true;
				} //!@mysql_errno()
				else {
					return @mysql_error();
				}
			} //isset($value)
		}
	}
	public function update_data($table, $value,$skip_vals=null,$s_fld, $svalue,$whr_cod = NULL){
		if ($this->tableExists($table)) {
			$value=$this->escap_string($value);
			if($skip_vals!=null){
				foreach($skip_vals as $skip_val){
					unset($value[$skip_val]);
				}
			}
			if (isset($value)) {
				foreach ($value as $pointer => $data) {
					if($data!=null){
						$field[]		= $pointer."='".$data."'";
					}
				} //$value as $pointer => $data
				$update_values			= implode(',', $field);
				if ($whr_cod == NULL) {
					$whr_cod = " where $s_fld='$svalue'";
				}
				if($this->checkZid($table) && $_SESSION['zid']>1){
					$whr_cod .=" AND zid='".$_SESSION['zid']."'";
				}
				$this->qrycmd  = "UPDATE $table SET $update_values $whr_cod";
				//echo $this->qrycmd;
				@mysql_query($this->qrycmd);
				if (!@mysql_errno()) {
					return true;
				} //!@mysql_errno()
				else {
					return @mysql_error();
				}
			} //isset($value)
		}
	}
	private function tableExists($table){
		$tablesInDb = @mysql_query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$table.'"');  
		if($tablesInDb){
			if(@mysql_num_rows($tablesInDb)==1){
				return true;
			}else{
				return false;
			}
		}
	}
	
	public function select($table, $rows = '*', $where = null, $order = null){
		$q = 'SELECT '.$rows.' FROM '.$table;
		if($where != null)
			$q .= ' WHERE '.$where;
		if($order != null)
			$q .= ' ORDER BY '.$order;
		if($this->tableExists($table)){
			//echo $q;
			$query = @mysql_query($q);
			if($query){
				if(@mysql_num_rows($query)>0){
					$rtn_data=array();
					while($row=@mysql_fetch_array($query)){
						$rtn_data[]=$row;
					}
					return $rtn_data;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else {
			return false;
		}
	}
	public function insert($table,$values,$rows = null){
		if($this->tableExists($table))  
			{  
			$insert = 'INSERT INTO '.$table;
			if($rows != null)  
				{  
				$insert .= ' ('.$rows.')';
				}  

			for($i = 0; $i < count($values); $i++)
				{  
				if(is_string($values[$i])) 
				$values[$i] = "'".$values[$i]."'";
				}  
			$values = implode(',',$values);
			$insert .= ' VALUES ('.$values.')';
			//echo $insert;
			//exit;
			$this->qryrslt = @mysql_query($insert);
			if(!@mysql_errno()){
				if ($this->qryrslt){
					return true;
				}
			}
			else{
				$error ="MySQL ERROR: ".@mysql_error()."<br />";
				return $error;
			}
		}
	}
	
	public function delete($tbl_num,$tbl_fld=NULL,$sxcode=NULL,$whr_cod=NULL){
		if($this->tableExists($tbl_num)) {
			$delete = "DELETE FROM ".$tbl_num." ";
			if($whr_cod==NULL){
				$delete .= " WHERE ".$tbl_fld." = '".$sxcode."'";
			}
			else{
				$delete .= $whr_cod;
			}
			if($this->checkZid($tbl_num) && $_SESSION['zid']>1){
				$delete .=" AND zid='".$_SESSION['zid']."'";
			}
			if(@mysql_query($delete)){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	
	public function update($tbu_num,$tbl_fldvlu,$s_fld,$svalue,$whr_cod= NULL)  
		{  
		if($this->tableExists($tbu_num))  
			{  
				for($i = 0; $i < count($tbl_fldvlu); $i++)  
				{  
					if(is_string($tbl_fldvlu[$i]))  
						$tbl_fldvlu[$i] = $tbl_fldvlu[$i]."'";  
				}  
				$values = implode(',',$tbl_fldvlu); 
				if($whr_cod==NULL)
					{
					$whr_cod = "where $s_fld='$svalue'";
					}
				$this->qrycmd = "UPDATE $tbu_num SET $values $whr_cod";
				//echo $this->qrycmd;
				$this->qryrslt = @mysql_query($this->qrycmd);
				if(!@mysql_errno())
					{
					if ($this->qryrslt)
						{
						return true;
						}
					}
				else{
					$error = @mysql_error();
					return $error;
					}
			}   
		}
	
	public function getslno($tblnum,$sl_no='slno')  {
		$slold = 0;
		
		$this->qrycmd = "SELECT * FROM $tblnum where $sl_no ORDER BY $sl_no ASC";
		$this->qryrslt = @mysql_query($this->qrycmd);
		if($this->qryrslt){
			while($rslt = @mysql_fetch_array($this->qryrslt)){
				$slno = $rslt[$sl_no];
				$sldf = ($slno-$slold);
				if ($sldf >= 2){
					$slno = ($slold+1);
					break;
				}
				else{
					$slold = $slno;
					$slno = $slno +1;
				}
			}
		}
		if (!$slno){
			$slno = 1;
		}
		return $slno;
	}
	function chkdepnd($tblnum, $sfld, $svlu)
		{
		$this->qrycmd = "SELECT * FROM $tblnum where $sfld = '$svlu'";
		$this->qryrslt = @mysql_query($this->qrycmd);
		if ($this->qryrslt)
			{
				while($rslt = @mysql_fetch_array($this->qryrslt))
				{
					if ($rslt!=NULL)
						{
						return true;
						}
					else {return false;}
				}
			
			}
		}
	public function getslno_max($tblnum, $sl_no = 'slno') {
		$slold = 0;
		$this->qrycmd  = "SELECT max(".$sl_no.")+1 as ".$sl_no." FROM $tblnum where 1 ORDER BY $sl_no ASC";
		$this->qryrslt = @mysql_query($this->qrycmd);
		if(@mysql_num_rows($this->qryrslt)>0){
			$result_val=@mysql_fetch_assoc($this->qryrslt);
			if($result_val[$sl_no]!=NULL){
				$slno=$result_val[$sl_no];
			}else{
				$slno = 1;
			}
		}else{
			$slno = 1;
		}
		return $slno;
	}
	public function countRow($table,$field,$value){
		$this->qrycmd = "SELECT count(*) as rows FROM ".$table." where ".$field." = '".$value."'";
		$this->qryrslt = mysql_query($this->qrycmd);
		$result_val=@mysql_fetch_assoc($this->qryrslt);
		if($result_val['rows']>0){
			return $result_val['rows']+1;
		}else{
			return 1;
		}
	}
	public function checkZid($table){
		$this->qrycmd = "SELECT information_schema.STATISTICS.TABLE_NAME as TABLENAME
		FROM information_schema.STATISTICS
		WHERE STATISTICS.TABLE_SCHEMA='".DB_NAME."'
		AND STATISTICS.COLUMN_NAME='zid'
		AND STATISTICS.TABLE_NAME='".$table."'
		GROUP BY STATISTICS.TABLE_NAME";
		$this->qryrslt = $this->execute_query($this->qrycmd);
		if(@mysql_num_rows($this->qryrslt)>0){
			return true;
		}else{
			return false;
		}
	}
	public function execute_query($sql_stmnt){
		if ($sql_stmnt!=NULL){
			$this->qryrslt = @mysql_query($sql_stmnt);
			return $this->qryrslt;
		}
	}
	public function dd($array){
		echo "<pre>";
		if(is_array($array)){
			print_r($array);
		}else{
			echo $array;
		}
		echo "</pre>";
		exit;
	}
}
?>