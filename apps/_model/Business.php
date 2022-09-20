<?php
namespace Adt\apps\_model ;
use Adt\systems\DB_Class\Database;


class Business extends Database{


	private $table = "dcmpny_info";

	public function __construct(){
		parent::__construct();
	}
	public function get($business){
		$data =  $this->select($this->table,"*","slno='".$business."'");
		return $data[0];
	}
}
?>