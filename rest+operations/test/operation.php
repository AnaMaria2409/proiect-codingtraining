<?php
include "dboperations.php";
class operation{
	private $db;
	function __construct(){
		$this->db=new dboperations();
	}

	public function getquestion($id=0){
		if($this->db->validid($id)==true){
		$opresponse['id']=$id;
		$opresponse['question']="how many humans can change a bulb";
		
	}else {
		$opresponse['status']="invalid id";

	}
	return $opresponse;
//intrebarile vor fi luate din baza de date . functia va fi folosita in api cat si in aplicatia in sine
//functia returneaza un json necodat . 
	}

	public function getquestions(){
		$arr=array();
		$opresponse['id']="1";
		$opresponse['question']="how many humans can change a bulb";
		$arr[]=$opresponse;

		$opresponse['id']="2";
		$opresponse['question']="second question";
		$arr[]=$opresponse;

		return $arr;
	}
	public function putquestion(){
		$opresponse['status']="done";
		return $opresponse;
	}
	public function answertoquestion(){
		$opresponse['id']="1";
		$opresponse['question']="how many humans can change a bulb";
		return $opresponse;
	}
	public function getallownedquestions(){
		$arr=array();
		$opresponse['id']="1";
		$opresponse['question']="how many humans can change a bulb";
		$arr[]=$opresponse;
		$opresponse['id']="2";
		$opresponse['question']="second question";
		$arr[]=$opresponse;
		$opresponse['id']="3";
		$opresponse['question']="third question";
		$arr[]=$opresponse;

		return $arr;
	}
}
?>