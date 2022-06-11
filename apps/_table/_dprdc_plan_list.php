<?php
$table = 'zdt_prdc_plan';
$primaryKey = 'plnid';
$columns = array(
	array( 'db' => 'prdc_plnid',     		'dt' => 0),
	array( 'db' => 'item_name', 			'dt' => 1),
	array( 'db' => 'targt_qty', 			'dt' => 2),
	array( 'db' => 'trn_date',  			'dt' => 3),
	array( 'db' => 'trn_amount',   			'dt' => 4),
	array( 'db' => 'recv_qty',     			'dt' => 5),
	array( 'db' => 'cost_perunit',     		'dt' => 6),
	//array( 'db' => 'action_btn',     		'dt' => 7),
	array(
			'db'		=> 'plnid',
			'dt'		=> 7,
			'button'	=>array(
				'print_plan'=>array(
					'title'			=> 'Print',
					'icon'			=> 'fa-print',
					'class'			=> 'print_button bg-blue waves-effect',
					'extra_elm'		=> array(
						'target'	=> 'prdc_plan',
						'pram'		=> 'plid',
					),
				)
			)
	)
	
);
echo json_encode(
	SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns )
);
?>
