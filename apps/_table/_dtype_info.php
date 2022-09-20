<?php
$table = 'vitype_info';
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
						'pg'			=> 'type_info',
						'sx_cod'		=> array(
							'db'		=> 'slno',
						),
					),
				),
			),
	)
	
);
$where= array(
	" zid in ('".$_SESSION['zid']."','1') ",
);
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primaryKey, $columns,NULL,$where )
);
?>
