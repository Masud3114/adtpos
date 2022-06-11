<?php
define("DB_HOST", "localhost");
/** name of the database. please note: database and database table are not the same thing! */
define("DB_NAME", "adt_pos");
//user for your database. the user needs to have rights for SELECT, UPDATE, DELETE and INSERT.
//By the way, it's bad style to use "root", but for development it will work */
define("DB_USER", "root");
/** The password of the above user */
define("DB_PASS", "masud3114");
/** The Address of  */
define("SRVRADRS", "http://".$_SERVER['HTTP_HOST']."/adt_pos/");
// For Datatable//
$sql_details = array(
	'user' => DB_USER,
	'pass' => DB_PASS,
	'db'   => DB_NAME,
	'host' => DB_HOST
);
?>