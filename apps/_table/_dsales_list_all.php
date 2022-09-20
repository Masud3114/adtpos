<?php
$table = 'zdt_pos';
$primaryKey = 'inv_id';
$columns = array(
	array( 'db' => 'inv_id',				'dt' => 0),
	array( 'db' => 'dcus_num',				'dt' => 1),
	array( 'db' => 'trn_date',				'dt' => 2),
	array( 'db' => 'trn_amount',			'dt' => 3),
	array( 'db' => 'trn_disc',				'dt' => 4),
	array( 'db' => 'trn_vat',				'dt' => 5),
	array( 'db' => 'trn_netamount',			'dt' => 6),
	array( 'db' => 'trn_ptype',				'dt' => 7),
	array( 'db' => 'trn_rcvamount',			'dt' => 8),
	array(
		'db'		=> 'sid',
		'dt'		=> 9,
		'button'	=>array(
			'edit_button'=>array(
				'type'			=> 'alink',
				'title'			=> 'Modify',
				'icon'			=> 'fa-edit',
				'class'			=> 'bg-orange waves-effect',
				'hRef'				=> array(
					'pg'			=> 'ca_sales',
					'sx_code'		=> array(
						'db'		=> 'sid',
					)
				)
			),'general_invoice'=>array(
				'type'		=> 'button',
				'title'		=> 'Print Voucher',
				'icon'		=> 'fa-print',
				'class'		=> 'bg-blue waves-effect print_button',
				'extra_elm'		=> array(
					'target'	=> 'ca_sales_invoice',
					'pram'		=> 'sid',
				),
			)
		)
	)
);
$where= array(
	" zid ='".$_SESSION['zid']."'",
);
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primaryKey, $columns, NULL, $where)
);
?>