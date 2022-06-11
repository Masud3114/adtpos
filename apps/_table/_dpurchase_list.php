<?php
$table = 'zdt_gnrl_purchase';
$primaryKey = 'trn_id';
$columns = array(
	array( 'db' => 'trn_id',				'dt' => 0),
	array( 'db' => 'supplier_name',			'dt' => 1),
	array( 'db' => 'trn_date',				'dt' => 2),
	array( 'db' => 'trn_ref',				'dt' => 3),
	array( 'db' => 'ttl_item',				'dt' => 4),
	array( 'db' => 'trn_amount',			'dt' => 5),
	array(
		'db'		=> 'sid',
		'dt'		=> 6,
		'button'	=>array(
			'edit_button'=>array(
				'type'			=> 'alink',
				'title'			=> 'Modify',
				'icon'			=> 'fa-edit',
				'class'			=> 'bg-orange waves-effect',
				'hRef'				=> array(
					'pg'			=> 'purchase_entry',
					'sx_code'		=> array(
						'db'		=> 'sid',
					)
				)
			),'general_invoice'=>array(
				'type'		=> 'button',
				'title'		=> 'Print',
				'icon'		=> 'fa-print',
				'class'		=> 'bg-blue waves-effect print_button',
				'extra_elm'		=> array(
					'target'	=> 'purchase_report',
					'pram'		=> 'spid',
				),
			)
		)
	)
);
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primaryKey, $columns)
);
?>