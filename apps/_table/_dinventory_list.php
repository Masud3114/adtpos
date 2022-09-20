<?php
$table = 'zinvent_info';
$primaryKey = 'slno';
$columns = array(
	array( 'db' => 'trn_date',				'dt' => 0),
	array( 'db' => 'tran_category',			'dt' => 1),
	array( 'db' => 'dcus_num',				'dt' => 2),
	array( 'db' => 'dsup_num',				'dt' => 3),
	array( 'db' => 'target_item',			'dt' => 4),
	array( 'db' => 'wh_store',				'dt' => 5),
	array( 'db' => 'ent_info',				'dt' => 6)
);
$where= array(
	" zid ='".$_SESSION['zid']."' ",
);
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primaryKey, $columns,NULL,$where )
);
?>