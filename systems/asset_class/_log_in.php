<?php 
class log_in extends database{
	var $username;
	var $password;
	var $md5_password;
	var $rmbr_sts;
	var $quary;
	public function logout(){
		if($_SESSION['signed_dsoft'] === true){
			//unset all variables
			$_SESSION['signed_dsoft'] = NULL;
			$_SESSION['user_name'] = NULL;
			$_SESSION['user_id']   = NULL;
			$_SESSION['pass_word'] = NULL;
			//$msg = 'Succesfully signed out, thank you for visiting.';
			return true;
		}
	}
		
	public function create_login(){
		$this->username = $_POST[user];
		$this->password = $this->encryptIt($_POST[passd]);
		$this->rmbr_sts = $_POST[rmbr];
		$this->quary = "select * from dusr_info where dusr_logid = '$this->username' and dusr_pswd = '$this->password' and sts = '1'";
		$result=@mysql_query($this->quary);
		if(@mysql_num_rows($result)>0)
			{ // If match.
			
			$row = @mysql_fetch_assoc($result);
			if($row['dusr_logid']==$this->username){
				$_SESSION['signed_dsoft'] = true; // Craete session username.
				$_SESSION['user_id'] 	= $row['dusr_id'];
				$_SESSION['user_name'] 	= $row['dusr_num'];
				$_SESSION['access_code'] 	= $row['dusr_acscod'];
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
		if($_SESSION['signed_dsoft'] === true){
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