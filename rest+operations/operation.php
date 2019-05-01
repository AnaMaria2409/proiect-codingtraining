<?php
class operation{
	private $db;
	public $token;
	function __construct($token){
		$this->db=new dboperations();
		$this->token=$token;
	}

	public function getquestion($id=0){
		  $question = array();
      $id = $this->db->getIdFromToken($this->token);

      		$sql="SELECT id_user,continut,categorie,dificultate,vizualizare,scor from intrebari where id='$id'" ;
  	
      $result = mysqli_query($this->db->conn,$sql);
      
       while($row = mysqli_fetch_assoc($result)){
         $question["id_user"] = $row['id_user'];
         $question["categorie"] = $row['categorie'];
         $question["dificultate"] = $row['dificultate'];
         $question["vizualizare"] = $row['vizualizare'];
         $question["scor"] = $row['scor'];
         $question["continut"] = $row['continut'];
    
     }
     return $question;
       	
	}
	public function getOwnerFromQuestion($id_question){
	  $id = $this->db->getIdFromToken($this->token);
      $sql="SELECT id_user from intrebari where id='$id_question'";
      $result = mysqli_query($this->db->conn,$sql);
       while($row = mysqli_fetch_assoc($result))
       		return $row["id_user"];
	}

	public function getquestions($type="")
    {
       $questions = array();
       if($type=="")$sql="SELECT id, continut,categorie,dificultate,vizualizare,scor from intrebari";
       else $sql="SELECT id, continut,categorie,dificultate,vizualizare,scor from intrebari where categorie='$type'";
       $result = mysqli_query($this->db->conn,$sql);
        
       while($row = mysqli_fetch_assoc($result)){
         $question["id"] = $row['id'];
         $question["categorie"] = $row['categorie'];
         $question["dificultate"] = $row['dificultate'];
         $question["vizualizare"] = $row['vizualizare'];
         $question["scor"] = $row['scor'];
         $question["continut"] = $row['continut'];
        $questions[]=$question;
        }
      return $questions;
      }
	public function putquestion($type="",$question=""){
		
	}
	public function answertoquestion($questionid="",$answer=""){
		
	}
	
	public function getallownedquestions($type="")
     {
      $questions = array();
      $id = $this->db->getIdFromToken($this->token);
		if(!empty($type))
      		$sql="SELECT id,continut,categorie,dificultate,vizualizare,scor from intrebari where id_user='$id' and categorie='$type'" ;
  		else $sql="SELECT id,continut,categorie,dificultate,vizualizare,scor from intrebari where id_user='$id'";
      $result = mysqli_query($this->db->conn,$sql);
      
       while($row = mysqli_fetch_assoc($result)){
         $question["id"] = $row['id'];
         $question["categorie"] = $row['categorie'];
         $question["dificultate"] = $row['dificultate'];
         $question["vizualizare"] = $row['vizualizare'];
         $question["scor"] = $row['scor'];
         $question["continut"] = $row['continut'];
         $questions[]=$question;

     }
     return $questions;
       	
    }
	public function logout($token){
$this->db->validateAndDeleteToken($token);
	}
}
?>