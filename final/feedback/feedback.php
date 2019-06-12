<?php
require_once "../token.php";
require_once "../operation.php";
$token=new token();
global $op;
global $id;
if(isset($_COOKIE["token"]) and $token->vtoken($_COOKIE["token"])){
    $op=new operation($_COOKIE["token"]);
}
else header("Location: ../paginalogare/paginalogare.php");
if(isset($_GET['id']))$id=$_GET['id'];
else header("Location: ../paginalogare/paginalogare.php");
//$continut=$op[0]["continut"];
    global $question;
$question=$op->getquestion($id);
if(sizeof($question)==0)header("Location: ../paginalogare/paginalogare.php");
$id=$op->db->getIdFromToken($_COOKIE["token"]);
$raspuns=$op->getAnswer($_GET["user"],$_GET["id"])
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>
<body>

    <header class="header">
        <ul>
             <li><a class="active" href="../homepage/index.php">Home</a></li>
  <li><a href="../account/account.php">My Account</a></li>
  <li><a href="../paginalogare/logout.php">Sign out</a></li>
            </ul>
    </header>

    <div class="question-container"><a href="">
        <div class="check">
            <img src="check.png" alt="check image">
            <span><?php echo $question["scor"];?></span>
        </div>
        <div class="view">
            <img src="view.png" alt="view image">
            <span><?php echo $question["vizualizare"];?></span>
        </div>
        <div class="star">
            <img src="star.png" alt="star image">
            <span><?php echo $question["scor"];?></span>
        </div>
        <img src="easy.png" alt="easy tag" class="difficulty-tag">
        <p>
           <?php echo $question["continut"];?>
        </p>
        <div class="author">
          
            <span><?php echo $op->db->getNameFromId($question["id_user"]);?></span>
        </div>
        <img src="arrow2.png" alt="arrow to answer" id="arrow2">
    </a></div>
    <div class ="answer">
        <p>
             <?php echo $op->getAnswer($_GET["user"],$_GET["id"]);?>
        </p>
        <div class = "answer-person">
            <span> Answer by: </span>
            <span> <?php echo $op->db->getNameFromId($_GET["user"]);?></span>
        </div>
    </div>
    <div class ="feedback">
        <form method="POST" action="addfeedback.php">
            <input type="hidden" name="answear" value="<?php echo $op->getAnswerId($_GET["user"],$_GET["id"]);?>">
            <input type="hidden" name="id_user" value="<?php echo $_GET['user'];?>">
            <textarea name="feedback">Leave your feedback !</textarea>
            <input type="submit" name="submit" value = "Submit">
             <div class="rating"> 
            <img id="+2" src="+2.png" alt="very good" onclick="changeState(this.id)">
            <input type="checkbox" name="checkbox" id="checkbox+2" value="+5">
            <img id="+1" src="+1.png" alt="good" onclick="changeState(this.id)">
            <input type="checkbox" name="checkbox" id="checkbox+1" value="+4">
            <img id="0" src="0.png" alt="decent" onclick="changeState(this.id)">
            <input type="checkbox" name="checkbox" id="checkbox0" value="+3">
            <img id="-1" src="-1.png" alt="bad" onclick="changeState(this.id)">
            <input type="checkbox" name="checkbox" id="checkbox-1" value="+2">
            <img id="-2" src="-2.png" alt="very bad" onclick="changeState(this.id)">
            <input type="checkbox" name="checkbox" id="checkbox-2" value="+1">
            <input type="checkbox" name="checkbox" id="checkbox-23" value="0" checked="true">

        </div>
        </form>
        <script language="JavaScript">
            function multiCheckTest(){
                var count = 0;
                var cb1 = document.getElementById("checkbox+2");
                var cb2 = document.getElementById("checkbox+1");
                var cb3 = document.getElementById("checkbox0");
                var cb4 = document.getElementById("checkbox-1");
                var cb5 = document.getElementById("checkbox-2");
                if(cb1.checked == true) count++;
                if(cb2.checked == true) count++;
                if(cb3.checked == true) count++;
                if(cb4.checked == true) count++;
                if(cb5.checked == true) count++;
                return count;
            }
            function changeState(clicked_id){
                var cb = "checkbox";
                if(multiCheckTest()==0 ){
                    document.getElementById(cb.concat(clicked_id)).checked = true;
                    document.getElementById(clicked_id).style.opacity="1";
                }else{
                    document.getElementById(cb.concat(clicked_id)).checked = false;
                    document.getElementById(clicked_id).style.opacity="0.45";
                }
            }
            
        </script>
       
    </div>
    
</body>
</html>