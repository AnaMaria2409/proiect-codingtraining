<?php
include "operation.php";
class controller{
	public $response;
	public $opresponse;
	public $operation;
	function __construct(){
	$this->response=array();
	$this->opresponse=array();
	$this->operation=new operation(); 
	}
 	public function do($string){
 		$this->response["operation"]=$string;
 		$this->response["status"]="authorized";
 			switch ($string) {
 			case 'getquestion':

 			 $this->response["response"]=$this->operation->getquestion($_GET["id"]);
 			 break;
 			 case 'getquestions':
 			 $this->response["response"]=$this->operation->getquestions();
 			 break;
 			 case 'putquestion':
 			 $this->response["response"]=$this->operation->putquestion();
 			 break;
 			 case 'answertoquestion':
 			$this->response["response"]=$this->operation->answertoquestion();
 			 break;
 			case 'getallownedquestions':
 			$this->response["response"]=$this->operation->getallownedquestions();
 			break;
 			default:
 				$this->response["operation-valid"]="false";
 				break;
 		}
 			return $this->response;

 	}


}
?>