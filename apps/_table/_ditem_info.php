<?php
$table = 'item_info';
$primaryKey = 'slno';
$columns = array(
	array( 'db' => 'item_name',				'dt' => 0),
	array( 'db' => 'item_model',			'dt' => 1),
	array( 'db' => 'item_srate',			'dt' => 2),
	array( 'db' => 'bar_cod',				'dt' => 3),
	array(
			'db'		=> 'slno',
			'dt'		=> 4,
			'button'	=>array(
				'edit_button'=>array(
					'type'			=> 'alink',
					'title'			=> 'Modify',
					'icon'			=> 'fa-edit',
					'class'			=> 'bg-blue waves-effect',
					'hRef'				=> array(
						'pg'			=> 'item_info',
						'sx_cod'		=> array(
							'db'		=> 'slno',
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
