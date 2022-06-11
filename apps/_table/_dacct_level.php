<?php
$table = 'acc_calevel';
$primaryKey = 'slno';
$columns = array(
	array( 'db' => 'acct_level_no',					'dt' => 0),
	array( 'db' => 'acct_level_name',				'dt' => 1),
	array( 'db' => 'acct_type',				'dt' => 2),
	array( 'db' => 'acct_level_desc',				'dt' => 3),
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
						'pg'			=> 'acct_level',
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
