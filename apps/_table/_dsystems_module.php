<?php
$table = 'usystem_module';
$primaryKey = 'slno';
$columns = array(
	array( 'db' => 'module_name',				'dt' => 0),
	array( 'db' => 'link_caption',				'dt' => 1),
	array( 'db' => 'link_url',					'dt' => 2),
	array( 'db' => 'parent_slno',				'dt' => 3),
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
						'pg'			=> 'systems_module',
						'sx_code'		=> array(
							'db'		=> 'slno',
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
