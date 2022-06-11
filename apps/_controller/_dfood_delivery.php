<?php  
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$delivery = new food_delivery();
	$data=NULL;
	if($_POST['action']==='auto_process'){
		if($_POST['del_date']!=NULL){
			$delivery->autodelivery_list_process($_POST['del_date']);
			$data=$delivery->show_active_list($_POST['del_date']);
			$massage="Successfully Processed!";
			$massage_type="success";
		}else{
			$massage="Date Must be Select!";
			$massage_type="error";
		}
	}else
	if($_POST['action']=='show_from'){
		if($_POST['del_date']!=NULL){
			$data=$delivery->show_active_list($_POST['del_date']);
		}else{
			$massage="Date Must be Select!";
			$massage_type="error";
		}
	}else
	if($_POST['action']=='update'){
		echo "Successfully Update!";
	}
	$return_data=array(
		'disp_data'			=>$data,
		'massage'			=>$massage,
		'massage_type'		=>$massage_type
	);
	echo json_encode($return_data);
}
else{
	echo "Directory access is forbidden...........";
}
?>
