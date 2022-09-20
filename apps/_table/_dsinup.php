<?php
$table = 'dusr_info';
$primaryKey = 'slno';
$columns = array(
	array( 'db' => 'dusr_num',					'dt' => 0),
	array( 'db' => 'dusr_logid',				'dt' => 1),
	array( 'db' => 'dusr_dsig',					'dt' => 2),
	array( 'db' => 'dusr_mobno',				'dt' => 3),
	array(
			'db'		=> 'dusr_id',
			'dt'		=> 4,
			'button'	=>array(
				'edit_button'=>array(
					'type'			=> 'alink',
					'title'			=> 'Modify',
					'icon'			=> 'fa-edit',
					'class'			=> 'bg-blue waves-effect',
					'hRef'				=> array(
						'pg'			=> 'sinup',
						'sx_code'		=> array(
							'db'		=> 'dusr_id',
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
