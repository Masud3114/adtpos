<?php
$table = 'zdt_quotation';
$primaryKey = 'quot_id';
$columns = array(
	array( 'db' => 'quot_id',										'dt' => 0),
	array( 'db' => 'dcus_num',										'dt' => 1),
	array( 'db' => 'rm',											'dt' => 2),
	array( 'db' => 'quot_date',										'dt' => 3),
	array( 'db' => 'quot_amount',									'dt' => 4),
	array( 'db' => 'quot_discount',									'dt' => 5),
	array( 'db' => 'quot_vat',										'dt' => 6),
	array( 'db' => 'quot_netamount',								'dt' => 7),
	array( 'db' => 'quot_pay_method',								'dt' => 8),
	array( 'db' => 'quot_ref',										'dt' => 9),
	array(
		'db'		=> 'slno',
		'dt'		=> 10,
		'button'	=>array(
			'edit_button'=>array(
				'type'			=> 'alink',
				'title'			=> 'Modify',
				'icon'			=> 'fa-edit',
				'class'			=> 'bg-orange waves-effect',
				'hRef'				=> array(
					'pg'			=> 'quotation_entry',
					'sx_code'		=> array(
						'db'		=> 'slno',
					)
				)
			),'general_invoice'=>array(
				'type'		=> 'button',
				'title'		=> 'Print Voucher',
				'icon'		=> 'fa-print',
				'class'		=> 'bg-blue waves-effect print_button',
				'extra_elm'		=> array(
					'target'	=> 'quotation',
					'pram'		=> 'qid',
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