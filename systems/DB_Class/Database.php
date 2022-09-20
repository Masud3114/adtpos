<?php
namespace Adt\systems\DB_Class;
use PDO;
class Database extends PDO
{
	protected $db_server		=DB_HOST;
	protected $db_name			=DB_NAME;
	protected $db_user			=DB_USER;
	protected $db_pass			=DB_PASS;
	protected $db_query			=NULL;
	protected $back_sql			=NULL;
	public function __construct(){
		try {
			$connStr ="mysql:host=".$this->db_server.";dbname=".$this->db_name;
			parent::__construct($connStr,$this->db_user,$this->db_pass);
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch( PDOException $e){
			die( "Error connecting to SQL Server");
		}
	}
	public function tableExists($table){
		$tablesInDb = $this->prepare("SELECT DISTINCT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME=?");
		$pram=array($table);
		$tablesInDb->execute($pram);
		if($tablesInDb->fetch()!=false){
			return true;
		}else{
			return false;
		}
	}
	public function select($table,$field,$where=NULL){
		if(is_array($field)){
			$sel_field= implode(',', $field);
		}else{
			$sel_field=$field;
		}
		if(is_array($where)){
			$where_code= " where ".implode(' AND ', $where);
		}else if(isset($where)){
			$where_code=" where ".$where;
		}		
		$this->db_query="select ".$sel_field." from ".$table.$where_code;
		//echo $this->db_query;
		$stmt=$this->prepare($this->db_query);
		try {
			$stmt->execute();
		}catch (PDOException $e) {
			//return $e->getMessage();
			return false;
		}
		$SelData=$stmt->fetchAll();
		if($SelData!=false){
			return $SelData;
		}else{
			return false;
		}
	}
	public function escap_string($data){
		if(is_array($data)){
			foreach($data as $key => $value) {
				if(!is_array($value)){
					$value = trim($value);
					//$value = htmlspecialchars($value);
					$value = $this->quote($value);
					$return[$key] = $value;
				}else{
					$return[$key] = $value;
				}
			}
		}else{
			$newVal = trim($data);
			$newVal = $this->quote($newVal);
		}
		return $return;
	}
	public function insert($table, $value,$skip_vals=null){
		if ($this->tableExists($table)) {
			if($skip_vals!=null){
				foreach($skip_vals as $skip_val){
					unset($value[$skip_val]);
				}
			}
			if (is_array($value)) {
				foreach ($value as $pointer => $data) {
					if($data!=null && $data!=''){
						$field[]		= $pointer;
						$field_bind[]	="?";
						$field_value[]	= htmlspecialchars(trim($data));
						//$field_value2[]	= "'".htmlspecialchars(trim($data))."'";
					}
				}
				$field			= implode(',', $field);
				$field_bind		= implode(',', $field_bind);
				$insert_sql		= 'INSERT INTO ' . $table . " (" . $field . ") VALUES (" . $field_bind . ")";
				//$insData		= implode(',', $field_value2);
				//$insert_sql		= 'INSERT INTO ' . $table . " (" . $field . ") VALUES (" . $insData . ")";
				//echo $insert_sql."<br/>";
				$stmt=$this->prepare($insert_sql);
				try {
					$stmt->execute($field_value);
				}catch (PDOException $e) {
					return $e->getMessage();
				}
				return true;
			}
		}else{
			return false;
		}
	}
	public function update_data($table, $value,$skip_vals=null,$s_fld, $svalue,$whr_cod = NULL){
		if ($this->tableExists($table)) {
			//$value=$this->escap_string($value);
			if($skip_vals!=null){
				foreach($skip_vals as $skip_val){
					unset($value[$skip_val]);
				}
			}
			if (isset($value)) {
				foreach ($value as $pointer => $data) {
					if($data!=null){
						$field[]       = $pointer."='".$data."'";
					}
					else{
						$field[]       = $pointer."= DEFAULT ";
					}
				}
				$update_values       = implode(',', $field);
				if ($whr_cod == NULL) {
					if(is_numeric($svalue)){
						$whr_cod = "where $s_fld=$svalue";
					}else{
						$whr_cod = "where $s_fld='$svalue'";
					}
				} 
				$this->qrycmd  = "UPDATE $table SET $update_values $whr_cod ";
				//echo $this->qrycmd;
				//exit;
				try {
					$this->query($this->qrycmd);
					return true;
				} catch(PDOException $e) {
					return $e->getMessage();
				}
			}
		}
	}
	public function newpikval($tbl_num,$fild,$sx_code,$sql_cmd=NULL){
		if(isset($sql_cmd)!=NULL){
			$this->db_query=$sql_cmd;
		}
		else if ($sx_code!=NULL){
			$this->db_query="Select * from $tbl_num where $fild = '$sx_code'";
		}
		$stmt=$this->prepare($this->db_query);
		try {
			$stmt->execute();
		}catch (PDOException $e) {
			//return $e->getMessage();
			return false;
		}
		if($stmt->rowCount()>0){
			return $stmt->fetchAll();
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