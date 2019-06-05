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
      $stmt = $this->db->conn->prepare("SELECT id_user,continut,categorie,dificultate,vizualizare,scor from intrebari where id=?");
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$result = $stmt->get_result();
				while($row = $result->fetch_assoc()){
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
       $stmt = $this->db->conn->prepare("SELECT id_user from intrebari where id=?");
       $stmt->bind_param("s", $id_question);
       $stmt->execute();
       $result = $stmt->get_result();
       if($result->num_rows > 0)
         while($row = $result->fetch_assoc())
            return $row['id_user'];
        return 0;         
	}

	public function getquestions($type="")
    {
       $questions = array();
       if($type=="")
       $stmt = $this->db->conn->prepare("SELECT id,id_user,continut,categorie,dificultate,vizualizare,scor from intrebari");
       else
       {
         $stmt = $this->db->conn->prepare("SELECT id,id_user,continut,categorie,dificultate,vizualizare,scor from intrebari where categorie=?");
         $stmt->bind_param("s", $type);
      }
      $stmt->execute();
      $result = $stmt->get_result();
        
       while($row = $result->fetch_assoc()){
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

      public function getAnswer($id_user,$id_question){
          if($this->db->checkAnswerExistence($id_user,$id_question)==1){
            $stmt = $this->db->conn->prepare("SELECT id,id_user,id_intrebare,continut from raspunsuri where id_user=? and id_intrebare=?");
            $stmt->bind_param("ii", $id_user,$id_question);
            $stmt->execute();
            $result = $stmt->get_result();
          
            while($row = $result->fetch_assoc()){
              return $row["continut"];
             }
          }else 
          return "this user didn't responded yet";
      }

      public function getAnswerId($id_user,$id_question){
        if($this->db->checkAnswerExistence($id_user,$id_question)==1){
          $stmt = $this->db->conn->prepare("SELECT id from raspunsuri where id_user=? and id_intrebare=?");
          $stmt->bind_param("ii", $id_user,$id_question);
          $stmt->execute();
          $result = $stmt->get_result();
        
          while($row = $result->fetch_assoc()){
            return $row["id"];
           }
        }else 
        return "this user didn't responded yet";
    }

      public function putquestion($continut, $categorie, $dificultate, $solutie){
      $nr = 0;
      $id = $this->db->getIdFromToken($this->token);
      if($categorie!=null and $dificultate!=null and $categorie!=null and $solutie!=null){
      $stmt = $this->db->conn->prepare("INSERT INTO intrebari (id_user, categorie, dificultate,vizualizare,scor,continut, solutie) VALUES (?,?,?,?,?,?,?)");
      $stmt->bind_param("issiiss", $id,$categorie,$dificultate,$nr,$nr,$continut,$solutie);
      $stmt->execute();
       if ($stmt->affected_rows > 0)
         echo "Question added successfully";
       else 
        echo "Error: <br>" . $this->db->conn->error;
     }
     else
       echo "Error : invalid arguments";
    }

     public function putfeedback($id_raspuns, $id_user, $feedback, $checkbox){
      $id = $this->db->getIdFromToken($this->token);
      if($feedback != null and $checkbox != null){
      $stmt = $this->db->conn->prepare("INSERT INTO feedback (id_user, id_raspuns, continut,validitate) VALUES (?,?,?,?)");
      $stmt->bind_param("iisi",$id_user,$id_raspuns,$feedback,$checkbox);
      $stmt->execute(); 
      
      if ($stmt->affected_rows > 0)
         echo "Feedback added successfully";
       else 
        echo "Error: <br>" . $this->db->conn->error;
      }
      else
      echo "Error: incorrect parameters ";
    }


      public function getfeedback( $id_user,$id_raspuns){
      $id = $this->db->getIdFromToken($this->token);
      $stmt = $this->db->conn->prepare('SELECT continut FROM feedback WHERE id_user=? AND id_raspuns=?');
			$stmt->bind_param("ii",$id_user,$id_raspuns);
			$stmt->execute();
      $result=$stmt->get_result();
      if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
              return $row['continut'];
      }
      $stmt->close();
      }
        return "you don t have feedback yet";
     }


	public function answertoquestion($questionid="",$answer=""){
    $iduser=$this->db->getIdFromToken($this->token);
    	if($this->db->checkAnswerExistence($iduser,$questionid)!=1){
        $stmt = $this->db->conn->prepare("INSERT INTO raspunsuri (id_user, id_intrebare, continut) VALUES (?,?,?)");
        $stmt->bind_param("iis",$iduser,$questionid,$answer);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
     echo "New record created successfully";} 
     else {
    echo "Error: <br>" . $this->db->conn->error;}

      }	
      else echo "you already answered to this question. lol";
	}
	
	public function getallownedquestions($type="")
     {
      $questions = array();
      $id = $this->db->getIdFromToken($this->token);
		if(!empty($type)){
          $stmt = $this->db->conn->prepare("SELECT id,id_user,continut,categorie,dificultate,vizualizare,scor from intrebari where id_user=? and categorie=?");
          $stmt->bind_param("is",$id,$type);
        }
          else {
          $stmt = $this->db->conn->prepare("SELECT id,id_user,continut,categorie,dificultate,vizualizare,scor from intrebari where id_user=?");
          $stmt->bind_param("i",$id);
          }
          $stmt->execute();
          $result = $stmt->get_result();
          
           while($row = $result->fetch_assoc()){
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
      $stmt = $this->db->conn->prepare("SELECT id,id_user,id_intrebare,continut from raspunsuri where id_intrebare=?");
      $stmt->bind_param("i",$id_question);
      $stmt->execute();
      $result = $stmt->get_result();
      
       while($row = $result->fetch_assoc()){
         
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
      {
        $stmt = $this->db->conn->prepare("SELECT id,id_user,continut,categorie,dificultate,vizualizare,scor from intrebari where categorie=? and NOT id_user=?");
        $stmt->bind_param("si", $type,$id);
      }
      else {
       $stmt = $this->db->conn->prepare("SELECT id,id_user,continut,categorie,dificultate,vizualizare,scor from intrebari where NOT id_user=?");
      $stmt->bind_param("i",$id);
          }
        $stmt->execute();
         $result = $stmt->get_result();
         while($row = $result->fetch_assoc()){
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
      $stmt = $this->db->conn->prepare("SELECT id,id_user,id_question,continut,validitate from feedback where id_user=? and id_question=?");
      $stmt->bind_param("ii", $id,$id_question);
      $stmt->execute();
      $result = $stmt->get_result();
    
      while($row = $result->fetch_assoc()){
        $response=$row["continut"]." your answer is ".$row["validitate"];
      }
      return $response;
    }
	public function logout($token){
$this->db->validateAndDeleteToken($token);
	}
}
