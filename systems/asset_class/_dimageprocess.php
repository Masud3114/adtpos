<?php
class maya_image_process{
	private $valid_formats = array("jpeg","JPEG","jpg","JPG", "png","PNG", "gif","GIF", "bmp", "BMP");
	
	public function img_uplod($imgfld,$dst_path,$imgcmpsize=NULL,$dstimgnum = NULL){
		$name = $_FILES[$imgfld]['name'];
		$size = $_FILES[$imgfld]['size'];
		if(strlen($name)){
			list($txt, $ext) = explode(".", $name);
			list($image_width, $image_height, $image_type) = getimagesize($_FILES[$imgfld]['tmp_name']);
			$image_extenssion=strtolower(image_type_to_extension($image_type));
			if(in_array($image_extenssion,$this->valid_formats)){
				if($size < $imgcmpsize){
					$actual_image_name = time().$dstimgnum.".".strtolower($image_extenssion);
					$tmp = $_FILES[$imgfld]['tmp_name'];
					$dst_path = $dst_path.$actual_image_name;
					if(move_uploaded_file($tmp, $dst_path)){
						return $dst_path;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function image_upload_mult($field_name,$dts_path,$com_size,$dst_image_name){
		if(is_array($_FILES['file']['name'])){
			$ds				= DIRECTORY_SEPARATOR;
			$storeFolder	= '/../ap_img/item_img';
			foreach ($_FILES['file']['name'] as $f => $name){
				$tempFile = $_FILES['file']['tmp_name'][$f];
				$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
				$targetFile =  $targetPath.$_POST['ppg']."--". $_FILES['file']['name'][$f];
				move_uploaded_file($tempFile,$targetFile);
			}
		}else{
			$item_images = $cmncls->img_uplod('file','ap_img/item_img/',4096*1024,'-'.$_POST['ppg'].'-'.sprintf("%03s", $_POST['slno']));
		}
	}
	function generate_image_thumbnail($source_image_path, $thumbnail_image_path,$max_width,$max_height){
		list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
		switch ($source_image_type){
			case IMAGETYPE_GIF:
				$source_gd_image = imagecreatefromgif($source_image_path);
				$ext="GIF";
				break;
			case IMAGETYPE_JPEG:
				$source_gd_image = imagecreatefromjpeg($source_image_path);
				$ext="JPEG";
				break;
			case IMAGETYPE_PNG:
				$source_gd_image = imagecreatefrompng($source_image_path);
				$ext="PNG";
				break;
			default:
				return false;
		}
		if ($source_gd_image === false) {
			return false;
		}
		$source_aspect_ratio = $source_image_width / $source_image_height;
		$thumbnail_aspect_ratio = $max_width / $max_height;
		if($source_image_width <= $max_width && $source_image_height <= $max_height){
			$thumbnail_image_width = $source_image_width;
			$thumbnail_image_height = $source_image_height;
		}elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
			$thumbnail_image_width = (int) ($max_height * $source_aspect_ratio);
			$thumbnail_image_height = $max_height;
		}else{
			$thumbnail_image_width = $max_width;
			$thumbnail_image_height = (int) ($max_width / $source_aspect_ratio);
		}
		$thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
		if($ext == "GIF" or $ext == "PNG"){
			imagecolortransparent($thumbnail_gd_image, imagecolorallocatealpha($thumbnail_gd_image, 0, 0, 0, 127));
			imagealphablending($thumbnail_gd_image, false);
			imagesavealpha($thumbnail_gd_image, true);
		}
		imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
		
		if($ext=="GIF"){
			imagegif($thumbnail_gd_image, $thumbnail_image_path, 100);
		}else if($ext=="JPEG"){
			imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 100);
		}
		if($ext=="PNG"){
			imagepng($thumbnail_gd_image, $thumbnail_image_path,9);
		}
		imagedestroy($source_gd_image);
		imagedestroy($thumbnail_gd_image);
		return true;
	}
}
?>