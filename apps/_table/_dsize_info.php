<?php
$table = 'visize_info';
$primaryKey = 'slno';
$columns = array(
	array( 'db' => 'pram_name',				'dt' => 0),
	array(
			'db'		=> 'slno',
			'dt'		=> 1,
			'button'	=>array(
				'edit_button'=>array(
					'type'			=> 'alink',
					'title'			=> 'Modify',
					'icon'			=> 'fa-edit',
					'class'			=> 'bg-blue waves-effect',
					'hRef'				=> array(
						'pg'			=> 'size_info',
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
