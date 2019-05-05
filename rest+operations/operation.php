<?php
require_once "dboperations.php";
class operation{
	public $db;
	public $token;
	function __construct($token){
		$this->db=new dboperations();
		$this->token=$token;
	}
	public function getquestion($id=0){
		  $question = array();
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
       if($type=="")$sql="SELECT id,id_user,continut,categorie,dificultate,vizualizare,scor from intrebari";
       else $sql="SELECT id,id_user,continut,categorie,dificultate,vizualizare,scor from intrebari where categorie='$type'";
       $result = mysqli_query($this->db->conn,$sql);
        
       while($row = mysqli_fetch_assoc($result)){
         $question["id"] = $row['id'];
         $question["id_user"] = $row['id_user'];
         $question["categorie"] = $row['categorie'];
         $question["dificultate"] = $row['dificultate'];
         $question["vizualizare"] = $row['vizualizare'];
         $question["scor"] = $row['scor'];
         $question["continut"] = $row['continut'];
        $questions[]=$question;
        }
      return $questions;
      }
public function putquestion($continut, $categorie, $dificultate, $solutie){
      $id = $this->db->getIdFromToken($this->token);
      $sql = "INSERT INTO intrebari (id_user, categorie, dificultate,vizualizare,scor,continut, solutie) VALUES ('$id', '$categorie', '$dificultate','1','1', '$continut','$solutie')";
       if ($this->db->conn->query($sql) === TRUE)
         echo "Question added successfully";
       else 
        echo "Error: " . $sql . "<br>" . $this->db->conn->error;
     }

	public function answertoquestion($questionid="",$answer=""){
    $iduser=$this->db->getIdFromToken($this->token);
    	if($this->db->checkAnswerExistence($iduser,$questionid)!=1){
        $sql="INSERT INTO raspunsuri (id_user, id_intrebare, continut)
VALUES ('$iduser', '$questionid', '$answer')";
        if ($this->db->conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $this->db->conn->error;
}

      }	
      else echo "you already answered to this question. lol";
	}
	
	public function getallownedquestions($type="")
     {
      $questions = array();
      $id = $this->db->getIdFromToken($this->token);
		if(!empty($type))
      		$sql="SELECT id,id_user,continut,categorie,dificultate,vizualizare,scor from intrebari where id_user='$id' and categorie='$type'" ;
  		else $sql="SELECT id,id_user,continut,categorie,dificultate,vizualizare,scor from intrebari where id_user='$id'";
      $result = mysqli_query($this->db->conn,$sql);
      
       while($row = mysqli_fetch_assoc($result)){
         $question["id"] = $row['id'];
            $question["id_user"] = $row['id_user'];
         $question["categorie"] = $row['categorie'];
         $question["dificultate"] = $row['dificultate'];
         $question["vizualizare"] = $row['vizualizare'];
         $question["scor"] = $row['scor'];
         $question["continut"] = $row['continut'];
         $questions[]=$question;

     }

     return $questions;
       	
    }
public function getallansweredquestions()
     {
      $questions = array();
      $id = $this->db->getIdFromToken($this->token);
      
      $sql="SELECT id,id_user,continut,categorie,dificultate,vizualizare,scor from intrebari";
      $result = mysqli_query($this->db->conn,$sql);
      
       while($row = mysqli_fetch_assoc($result)){
         
         $question["id"] = $row['id'];
            $question["id_user"] = $row['id_user'];
         $question["categorie"] = $row['categorie'];
         $question["dificultate"] = $row['dificultate'];
         $question["vizualizare"] = $row['vizualizare'];
         $question["scor"] = $row['scor'];
         $question["continut"] = $row['continut'];
         if($this->db->checkAnswerExistence($id,$question["id"])==1)$questions[]=$question;

     }

     return $questions;
        
    }
    public function getallanswersfromquestion($id_question)
     {
      $answers = array();
      $id = $this->db->getIdFromToken($this->token);
      
      $sql="SELECT id,id_user,id_intrebare,continut from raspunsuri where id_intrebare='$id_question'";
      $result = mysqli_query($this->db->conn,$sql);
      
       while($row = mysqli_fetch_assoc($result)){
         
         $answer["id"] = $row['id'];
            $answer["id_user"] = $row['id_user'];
         $answer["id_intrebare"] = $row['id_intrebare'];
         $answer["continut"] = $row['continut'];
         $answers[]=$answer;

     }

     return $answers;
        
    }
    public function getunansweredquestions($type)
     {
      $questions = array();
      $id = $this->db->getIdFromToken($this->token);
      if(!empty($type))
          $sql="SELECT id,id_user,continut,categorie,dificultate,vizualizare,scor from intrebari where categorie='$type' and NOT id_user='$id'" ;
      else $sql="SELECT id,id_user,continut,categorie,dificultate,vizualizare,scor from intrebari where NOT id_user='$id'";
    
      $result = mysqli_query($this->db->conn,$sql);
      
       while($row = mysqli_fetch_assoc($result)){
         
         $question["id"] = $row['id'];
            $question["id_user"] = $row['id_user'];
         $question["categorie"] = $row['categorie'];
         $question["dificultate"] = $row['dificultate'];
         $question["vizualizare"] = $row['vizualizare'];
         $question["scor"] = $row['scor'];
         $question["continut"] = $row['continut'];
         if($this->db->checkAnswerExistence($id,$question["id"])!=1)$questions[]=$question;

     }

     return $questions;
        
    }
    public function checkFeedback($id,$id_question){
      $response="";
      $sql="SELECT id,id_user,id_question,continut,validitate from feedback where id_user='$id' and id_question='$id_question'";
      $result = mysqli_query($this->db->conn,$sql);
      while($row = mysqli_fetch_assoc($result)){
            $response=$row["continut"]." your answer is ".$row["validitate"];
      }
      return $response;
    }
	public function logout($token){
$this->db->validateAndDeleteToken($token);
	}
}
?>