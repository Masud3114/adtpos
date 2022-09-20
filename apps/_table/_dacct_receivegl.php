<?php
$table = 'acct_glheader';
$primaryKey = 'slno';
$columns = array(
	array( 'db' => 'xvoucher',					'dt' => 0),
	array( 'db' => 'xdate',						'dt' => 1),
	array( 'db' => 'xref',						'dt' => 2),
	array( 'db' => 'xnarration',				'dt' => 3),
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
						'pg'			=> 'acct_rcvEntry',
						'sx_code'		=> array(
							'db'		=> 'slno',
						)
					)
				),'delete_user'=>array(
					'type'			=> 'alink',
					'title'		=> 'Print Voucher',
					'icon'		=> 'fa-print',
					'class'		=> 'bg-blue waves-effect print_voucher',
					'extra_elm'		=> array(
						'data'	=> array(
							'db'		=> 'slno',
						),
					),
				),
			),
	)
	
);
$where= array(
	" prfx_name ='RE-' AND zid ='".$_SESSION['zid']."' ",
);
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primaryKey, $columns,NULL,$where)
);
?>
