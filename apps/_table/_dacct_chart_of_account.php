<?php
$table = 'acc_vca_list';
$primaryKey = 'slno';
$columns = array(
	array( 'db' => 'acct_code',						'dt' => 0),
	array( 'db' => 'acct_type',						'dt' => 1),
	array( 'db' => 'acct_level_name',				'dt' => 2),
	array( 'db' => 'acct_name',						'dt' => 3),
	array( 'db' => 'acct_usages',					'dt' => 4),
	array( 'db' => 'acct_source',					'dt' => 5),
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
						'pg'			=> 'acct_chart_of_account',
						'sx_code'		=> array(
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
