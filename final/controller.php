<?php
include "operation.php";
class controller{
	public $response;
	public $opresponse;
	public $operation;
	public $token;
	function __construct($token){
	$this->token=$token;
	$this->response=array();
	$this->opresponse=array();
	$this->operation=new operation($token); 
	}
 	public function do($string){
 		$this->response["operation"]=$string;
 		$this->response["status"]="authorized";
 			switch ($string) {
 			case 'getquestion':

 			 if(isset($_REQUEST['id']))$this->response["response"]=$this->operation->getquestion($_REQUEST['id']);
 			 else $this->response["error"]="id is null";
 			 break;
 			 case 'getquestions':
 			 if(isset($_REQUEST['type']))$this->response["response"]=$this->operation->getquestions($_REQUEST['type']);
 			 	else $this->response["error"]="type is null";
 			 break;
 			 case 'putquestion':
 			 if(isset($_REQUEST['type']) and isset($_REQUEST['question']))
 			 	$this->response["response"]=$this->operation->putquestion($_REQUEST["question"],$_REQUEST["category"],$_REQUEST["difficulty"],$_REQUEST["solution"]);
 			 else  $this->response["error"]="type is null/question is null";
 			 break;
 			 case 'answertoquestion':
 			 if(isset($_REQUEST['id']) and isset($_REQUEST['answer']))
 			$this->response["response"]=$this->operation->answertoquestion($_REQUEST['id'],$_REQUEST['answer']);
 			 break;
 			case 'getallownedquestions':
 			$type="all";
 			if(isset($_REQUEST['type']))$type=$_REQUEST['type'];
 			$this->response["response"]=$this->operation->getallownedquestions($type);
 			break;
 			case 'getOwnerFromQuestion':
 			$id=1;
 			if(isset($_REQUEST['id']))$id=$_REQUEST['id'];
 			$this->response["response"]=$this->operation->getOwnerFromQuestion($id);
 			break;
 			case 'logout':
 			
 			$this->response["response"]=$this->operation->logout($this->token);
 			break;
 			default:
 				$this->response["operation-valid"]="false";
 				break;
 		}
 			return $this->response;

 	}


}
?>