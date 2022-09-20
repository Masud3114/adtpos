<?php
$table = 'dcus_info';
$primaryKey = 'slno';
$columns = array(
	array( 'db' => 'dcus_num',					'dt' => 0),
	array( 'db' => 'dcus_mobno',				'dt' => 1),
	array( 'db' => 'dcus_telno',				'dt' => 2),
	array( 'db' => 'dcus_adrs',					'dt' => 3),
	array(
			'db'		=> 'dcus_cod',
			'dt'		=> 4,
			'button'	=>array(
				'edit_button'=>array(
					'type'			=> 'alink',
					'title'			=> 'Modify',
					'icon'			=> 'fa-edit',
					'class'			=> 'bg-blue waves-effect',
					'hRef'				=> array(
						'pg'			=> 'food_cus',
						'sx_code'		=> array(
							'db'		=> 'dcus_cod',
						),
					),
				),
			),
	)
	
);
$where= array(
	" dcus_type in ('1','2') AND zid ='".$_SESSION['zid']."'",
);
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primaryKey, $columns ,NULL,$where)
);
?>
