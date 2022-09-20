<?php
class sendMassage{
	protected $soapClient=null;
	protected $api_key=null;
	protected $userName="";
	protected $userPassword="";
	protected $messageText=null;
	protected $numberList=null;
	protected $singleNumber=null;
	protected $smsType="TEXT";
	protected $maskName="";
	protected $campaignName=null;
	
	protected $paramArray = array();
	
	public function __construct($user,$pass,$mask_name='',$company='Part One BD'){
		$this->userName			=$user;
		$this->userPassword		=$pass;
		$this->maskName			=$mask_name;
		$this->campaignName		=$company;
		try{
			$this->soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
		}catch(Exception $e){
			return $e->getMessage();
		}
	}
	public function sendToOne($number,$massage){
		$this->singleNumber		=$number;
		$this->messageText		=$massage;
		$this->paramArray = array( 
			'userName' 		=> $this->userName,
			'userPassword' 	=> $this->userPassword,
			'mobileNumber' 	=> $this->singleNumber,
			'smsText' 		=> $this->messageText,
			'type' 			=> $this->smsType,
			'maskName' 		=> $this->maskName,
			'campaignName' 	=> $this->campaignName
		);
		try{
			$value = $this->soapClient->__call("OneToOne", array($this->paramArray)); 
			return $value->OneToOneResult;
		}catch(Exception $e){
			return $e->getMessage();
		}
	}
	public function sendToMany($numberList,$massage){
		$this->numberList		=$numberList;
		$this->messageText		=$massage;
		$this->paramArray = array(
			'userName' 		=> $this->userName,
			'userPassword' 	=> $this->userPassword,
			'messageText' 	=> $this->messageText,
			'numberList' 	=> $this->numberList,
			'smsType' 		=> $this->smsType,
			'maskName' 		=> $this->maskName,
			'campaignName' 	=> $this->campaignName
		);
		try{
			if($this->soapClient){
				$value = $this->soapClient->__call("OneToMany", array($this->paramArray)); 
				return $value->OneToManyResult;
			}else{
				return false;
			}
		}catch(Exception $e){
			return $e->getMessage();
		}
	}
	public function checkBalance(){
		$this->paramArray = array(
			'userName' 		=> $this->userName,
			'userPassword' 	=> $this->userPassword
		);
		try{
			$value = $this->soapClient->__call("GetBalance", array($this->paramArray)); 
			return $value->GetBalanceResult;
		}catch(Exception $e){
			return $e->getMessage();
		}
	}
}
?>