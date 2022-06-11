<?php
$table = 'dcus_info';
$primaryKey = 'slno';
$columns = array(
	array( 'db' => 'dcus_cod',				'dt' => 0),
	array( 'db' => 'dcus_num',				'dt' => 1),
	array( 'db' => 'dcus_cprsn',			'dt' => 2),
	array( 'db' => 'dcus_cprsnmob',			'dt' => 3),
	array(
			'db'		=> 'dcus_cod',
			'dt'		=> 4,
			'button'	=>array(
				'edit_button'=>array(
					'type'			=> 'alink',
					'title'			=> 'Modify',
					'icon'			=> 'fa-edit',
					'class'			=> 'bg-blue waves-effect',
					'hRef'				=> array(
						'pg'			=> 'cus_info',
						'sx_code'		=> array(
							'db'		=> 'dcus_cod',
						),
					),
				),
			),
	)
	
);
$where= array(
	" dcus_type ='0' ",
);
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primaryKey, $columns,NULL,$where )
);
?>
