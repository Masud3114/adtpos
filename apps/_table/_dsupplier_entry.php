<?php
$table = 'dsup_info';
$primaryKey = 'slno';
$columns = array(
	array( 'db' => 'dsup_num',					'dt' => 0),
	array( 'db' => 'dsup_mobno',				'dt' => 1),
	array( 'db' => 'dsup_telno',				'dt' => 2),
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
echo json_encode(
	SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns )
);
?>
