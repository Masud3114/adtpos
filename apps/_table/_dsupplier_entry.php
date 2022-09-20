<?php
$table = 'dsup_info';
$primaryKey = 'slno';
$columns = array(
	array( 'db' => 'dsup_num',					'dt' => 0),
	array( 'db' => 'dsup_cprsn',				'dt' => 1),
	array( 'db' => 'dsup_cprsnmob',				'dt' => 2),
	array( 'db' => 'dsup_adrs',					'dt' => 3),
	array(
			'db'		=> 'dsup_cod',
			'dt'		=> 4,
			'button'	=>array(
				'edit_button'=>array(
					'type'			=> 'alink',
					'title'			=> 'Modify',
					'icon'			=> 'fa-edit',
					'class'			=> 'bg-blue waves-effect',
					'hRef'				=> array(
						'pg'			=> 'supplier_entry',
						'sx_code'		=> array(
							'db'		=> 'dsup_cod',
						),
					),
				),
			),
	)
	
);
$where= array(
	" zid ='".$_SESSION['zid']."' ",
);
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primaryKey, $columns,NULL,$where )
);
?>
