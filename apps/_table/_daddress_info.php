<?php
$table = 'dcmpny_info';
$primaryKey = 'slno';
$columns = array(
	array( 'db' => 'dcmpny_num',					'dt' => 0),
	array( 'db' => 'dcmpny_moto',				'dt' => 1),
	array( 'db' => 'dcmpny_adrs',					'dt' => 2),
	array( 'db' => 'dcmpny_telno',				'dt' => 3),
	array(
			'db'		=> 'dcmpny_cod',
			'dt'		=> 4,
			'button'	=>array(
				'edit_button'=>array(
					'type'			=> 'alink',
					'title'			=> 'Modify',
					'icon'			=> 'fa-edit',
					'class'			=> 'bg-blue waves-effect',
					'hRef'				=> array(
						'pg'			=> 'business/business_info',
						'sx_code'		=> array(
							'db'		=> 'dcmpny_cod',
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
