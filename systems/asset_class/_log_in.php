<?php 
class log_in extends comncls{
	var $username;
	var $password;
	var $md5_password;
	var $rmbr_sts;
	var $quary;
	public function logout(){
		if($_SESSION['pos_auth'] === true){
			$_SESSION['pos_auth']			= NULL;
			$_SESSION['user_id']			= NULL;
			$_SESSION['zid']				= NULL;
			$_SESSION['user_name']			= NULL;
			$_SESSION['access_code']		= NULL;
			return true;
		}
	}
	public function create_user(){
		$ins_data=$_POST;
		$ins_data['dusr_pswd'] = $this->encryptIt($_POST['dusr_pswd']);
		$ins_data['slno'] = $this->getslno('dusr_info');
		$dusr_id = "USER-".sprintf("%06s", $ins_data['slno']);
		//image code start 
		if($_FILES['dusr_img']['name'] !=NULL){
			$dusr_img = $this->img_uplod('dusr_img','ap_img/user_img/',4096*1024,'-'.$dusr_id.'-'.sprintf("%04s", $ins_data['slno']));
		}
		else{
			$dusr_img =null;;
		}
		$ins_data['dusr_id'] 		= $dusr_id;
		$ins_data['dusr_img'] 		= $dusr_img;
		$ins_data['dusr_acscod'] 	= 'admin';
		$ins_data['dent_id'] 		= $dusr_id;
		//$skip_valus=array('register');
		$skip_valus=array('register','confirm');
		$adsts=$this->insert_data('dusr_info',$ins_data,$skip_valus);
		if ($adsts == 1){
			$msg = "Successfully create user!";
			$clor = green;
		}else{
			if(is_file($dusr_img)){
				unlink($dusr_img);
			}
			$msg = $adsts;
			$clor = red;
		}
		$_SESSION['msg']	= $msg;
		$_SESSION['color']	= $clor;
	}
	public function create_login(){
		$this->username = $_POST[user];
		$this->password = $this->encryptIt($_POST[passd]);
		$this->rmbr_sts = $_POST[rmbr];
		$this->quary = "select * from dusr_info where dusr_logid = '".$this->username."' and dusr_pswd = '".$this->password."' and sts = '1'";
		$result=@mysql_query($this->quary);
		if(@mysql_num_rows($result)>0){
			$row = @mysql_fetch_assoc($result);
			if($row['dusr_logid']==$this->username){
				$_SESSION['pos_auth']			= true; // Create session username.
				$_SESSION['user_id'] 			= $row['dusr_id'];
				$_SESSION['zid'] 				= $row['zid'];
				$_SESSION['user_name'] 			= $row['dusr_num'];
				$_SESSION['access_code'] 		= $row['dusr_acscod'];
				return true;
			}else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	public function chk_login(){
		if($_SESSION['pos_auth'] === true){
			return true;
		}else{
			return false;
		}
	}
	public function encryptIt( $q ){
		$cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
		$qEncoded = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ))));
		return( $qEncoded );
	}
	
}
?>