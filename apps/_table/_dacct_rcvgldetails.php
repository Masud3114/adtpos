<?php
$table = 'acct_gldetailv';
$primaryKey = 'slno';
$columns = array(
	array( 'db' => 'acct_code',					'dt' => 0),
	array( 'db' => 'acct_name',					'dt' => 1),
	array( 'db' => 'acct_code_sub',				'dt' => 2),
	array( 'db' => 'acct_sub_name',				'dt' => 3),
	array( 'db' => 'xdebit',					'dt' => 4),
	array( 'db' => 'xcredit',					'dt' => 5),
	array(
			'db'		=> 'slno',
			'dt'		=> 6,
			'button'	=>array(
				'edit_button'=>array(
					'type'			=> 'alink',
					'title'			=> 'Modify',
					'icon'			=> 'fa-edit',
					'class'			=> 'bg-blue waves-effect',
					'hRef'				=> array(
						'pg'			=> 'acct_rcvEntry',
						'sx_cods'		=> array(
							'db'		=> 'slno',
						),
					),
				),
			),
	)
);
$where= array(
	" hslno ='".$_POST['dt_prams']."' AND zid ='".$_SESSION['zid']."' ",
);
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primaryKey, $columns,NULL,$where )
);
?>
