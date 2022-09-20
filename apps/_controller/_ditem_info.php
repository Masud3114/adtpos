<?php
class products extends comncls{
	public function add_products($data){
		
		if($data['color_extract']==1){
			//product name auto genarate//
			$product_name = $this->name_genarate($data);
			//Product Type Alt Code//
			$type_code = $this->select('vitype_info','pramalt_code',"slno='".$data['item_type']."'");
			$type_altcode = $type_code[0]['pramalt_code'];
			$colors = $this->extract_products($data,'item_color',$product_name);
			$items = $this->ItemList($colors,$product_name,$type_altcode);
			return $this->SaveData($data,$items);
		}else{
			$data['slno'] = $this->getslno('item_info');
			$data['item_code'] = "PR-" . sprintf("%09s", $data['slno']);
			$skip_valus=array('ditem_ad','ppg');
			if (isset($data['item_color'])) {
				$data['item_color']	= implode(',', $data['item_color']);
			}else{
				array_push($skip_valus,'item_color');
			}
			//if (isset($_REQUEST['item_size'])) {
			//	$_POST['item_size']	= implode(',', $_POST['item_size']);
			//}else{
			//	array_push($skip_valus,'item_size');
			//}
			$data['dent_id']=$_SESSION['user_id'];
			$adsts=$this->insert_data('item_info',$data,$skip_valus);
			if ($adsts == 1){
				$msg = "Successfully Add!";
				$clor = green;
			}else{
				$msg = $adsts;
				$clor = red;
			}
		}
		return [$msg,$clor];
	}
	private function SaveData($data,$items){
		$slno = $this->getslno_max('item_info','slno');
		foreach($items as $item){
			$data['slno'] = $slno;
			$data['item_code'] = "PR-" . sprintf("%09s", $data['slno']);
			$data['item_name'] = $item['name'];
			$data['bar_cod'] = $item['barcode'];
			$skip_valus=array('ditem_ad','color_extract','ppg');
			$data['item_color']	= $item['cslno'];
			
			$adsts=$this->insert_data('item_info',$data,$skip_valus);
			if ($adsts == 1){
				$success++;
			}else{
				$failed++;
			}
			$slno++;
		}
		return "Successfully Add ".$success." Products!<br/>Failed ".$failed." Products!";
	}
	private function name_genarate($data){
		$brand_name = $this->select('vibrand_info','slno,pram_name',"slno='".$data['item_brand']."'");
		$category_name = $this->select('vicat_info','slno,pram_name',"slno='".$data['item_cat']."'");
		$type_name = $this->select('vitype_info','slno,pram_name',"slno='".$data['item_type']."'");
		
		$product_name =$brand_name[0]['pram_name']." ".$category_name[0]['pram_name']." ".$type_name[0]['pram_name'];
		$int_barcod = $brand_name[0]['slno'].$category_name[0]['slno'].$type_name[0]['slno'];
		return [ 
			"name"			=>$product_name,
			"barcode"		=>$int_barcod
		];
	}
	private function extract_products($data,$field_name,$product_name){
		if(count($data[$field_name])>1){
			foreach($data[$field_name] as $color){
				$colors = $this->select('vicolor_info','pram_name,slno'," slno = '".$color."'");
				$color_array[] = [
					'slno'				=>$colors[0]['slno'],
					'pram_name'			=>$colors[0]['pram_name']
				];
			}
			return $color_array;
		}else{
			return false;
		}
	}
	private function ItemList($colors,$product_name,$type_altcode){
		$abs_product_name = array();
		$i=0;
		foreach($colors as $color){
			$i++;
			$abs_product_name[] = array(
				"name"		=> $product_name['name']." ".$color['pram_name']." ". $type_altcode."-".sprintf("%03s", $i),
				"cslno"		=> $color['slno'],
				"barcode"	=> $product_name['barcode'].sprintf("%03s", $i),
			);
		}
		return $abs_product_name;
	}
	
}
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
&& !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	if($_FILES['file']['name'] !=NULL){
		if(is_array($_FILES['file']['name'])){
			$ds				= DIRECTORY_SEPARATOR;
			$storeFolder	= '/../ap_img/item_img';
			foreach ($_FILES['file']['name'] as $f => $name){
				$tempFile = $_FILES['file']['tmp_name'][$f];
				list($image_width, $image_height, $image_type) = getimagesize($tempFile);
				$image_extenssion=strtolower(image_type_to_extension($image_type));
				$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
				$targetFile =  $targetPath.time()."__".$image_width."x".$image_height."-".$f.$image_extenssion;
				move_uploaded_file($tempFile,$targetFile);
			}
		}else{
			$item_images = $cmncls->img_uplod('file','ap_img/item_img/',4096*1024,'-'.$_POST['ppg'].'-'.sprintf("%03s", $_POST['slno']));
		}
	}
}else if($_SERVER['REQUEST_METHOD']=='POST'){
	$product = new products();
	if(isset($_POST[ditem_ad])){
		$sts			= $product->add_products($_POST);
		$msg			= $sts[0];
		$clor			= $sts[1];
	}
	else if (isset($_POST['ditem_updt'])){
		if($_POST['slno']!=NULL){
			$skip_valus=array('ditem_updt','slno','ppg');
			if (isset($_POST['item_color'])) {
				$_POST['item_color']	= implode(',', $_POST['item_color']);
			}else{
				array_push($skip_valus,'item_color');
			}
			//if (isset($_POST['item_size'])) {
			//	$_POST['item_size']	= implode(',', $_POST['item_size']);
			//}else{
			//	array_push($skip_valus,'item_size');
			//}
			//echo $_POST['item_color'];
			$_POST['dupdt_id']=$_SESSION['user_id'];
			$updsts=$action->update_data('item_info',$_POST,$skip_valus,'slno',$_POST['slno']);
			//exit;
			if ($updsts == true){
				$msg = "Successfully Update";
				$clor = green;
			}else{ 
				$msg = "Can't Update! Please Check your all submitted value! ";//.$updsts;
				$clor = red;
			}
		}else {
			$msg = "Can't Update! Please Select an Information...";
			$clor = red;
		}
	}else if(isset($_POST['ditem_dlt'])){
		$news_banner = $cmncls->newpikval('item_info','slno',$_POST['slno']);
		$dlt_sts = $action->delete('item_info','slno',$_POST['slno']);
		if ($dlt_sts==true){
			$msg = "Successfully Delete!";
			$clor = green;
		}
	}else{
		$ds				= DIRECTORY_SEPARATOR;
		$storeFolder	= 'ap_img/item_img';
		if (!empty($_FILES)) {
			$tempFile = $_FILES['file']['tmp_name'];
			$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
			$targetFile =  $targetPath. $_FILES['file']['name'];
			move_uploaded_file($tempFile,$targetFile);
		}
	}
	$sxcode = $_POST['slno'];
	$_SESSION['msg'] = $msg;
	$_SESSION['clor'] = $clor;
	header("location:index.php?pg=".$_POST['ppg']."&&sx_cod=".$sxcode);
}
?>
