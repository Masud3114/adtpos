<?php
namespace Adt\apps\_model ;
use Adt\systems\DB_Class\Database;


class Users extends Database{
	private $table = "dusr_info";

	public function __construct(){
		parent::__construct();
	}
	public function get($uid='USER-000001'){
		$data = $this->select($this->table,"*","dusr_id='".$uid."'");
		return $data[0];
	}
}
?>