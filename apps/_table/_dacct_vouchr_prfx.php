<?php
$table = 'acct_vou_prfx';
$primaryKey = 'slno';
$columns = array(
	array( 'db' => 'prfx_name',					'dt' => 0),
	array( 'db' => 'prfx_type',					'dt' => 1),
	array( 'db' => 'prfx_strt',					'dt' => 2),
	array( 'db' => 'prfx_incr',					'dt' => 3),
	array( 'db' => 'prfx_desc',					'dt' => 4),
	array(
			'db'		=> 'slno',
			'dt'		=> 5,
			'button'	=>array(
				'edit_button'=>array(
					'type'			=> 'alink',
					'title'			=> 'Modify',
					'icon'			=> 'fa-edit',
					'class'			=> 'bg-blue waves-effect',
					'hRef'				=> array(
						'pg'			=> 'acct_vouchr_prfx',
						'sx_code'		=> array(
							'db'		=> 'slno',
						),
					),
				),
			),
	)
	
);
$where= array(
	" zid in ('".$_SESSION['zid']."','1')",
);
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primaryKey, $columns,NULL,$where )
);
?>
