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
	global $continut;
$continut=$op->getquestion($id);
if(sizeof($continut)==0)header("Location: ../paginalogare/paginalogare.php");
$id=$op->db->getIdFromToken($_COOKIE["token"]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel = "stylesheet"
   type = "text/css"
   href = "style.css" />
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Write the HTML for a </title>
</head>
<body>
<div class="navBar">
<ul>
  <li><a class="active" href="../homepage/index.php">Home</a></li>
  <li><a href="../account/account.php">My Account</a></li>
  <li><a href="../paginalogare/logout.php">Sign out</a></li>
</ul>
</div>
	
<div class="content">
<div class="questionBody">
	<div class="problem">Problem
	
	<div class="details"><img src="solved.png" height="40" alt><?php echo $continut["scor"];?></div>
	<div class="details"><img src="view.png" height="40" alt><?php echo $continut["vizualizare"];?></div>
	<div class="details"><img src="star.png" height="40" alt><?php echo $continut["scor"];?></div>
	
	</div>
<div class="question">
	<?php echo $continut["continut"];?>
</div>
</br>
<?php
$val=$_GET["id"];
if($op->db->checkAnswerExistence($id,$_GET["id"])==0){
echo '
<div class="questionForm">
	<form id="form" action="answertoquestion.php" method="POST">
	<textarea  onfocus="this.value="";" rows="10" cols="100" name="answer" form="form">Enter solution here...</textarea>
	<input type="hidden" name="id" value="'.$val.'">
	<input type="submit" name="submit" value="GO" class="submitButton">
	</form>
</div>';}else {
if($op->db->checkAnswerExistence($id,$_GET["id"])==1){
	//a raspuns la intrebare si nu este cel care are intrebarea
	if(strlen($op->checkFeedback($id,$_GET["id"]))>0){
		echo $op->checkFeedback($id,$_GET["id"]);
	}else {
		echo "Your don't have a feedback yet .";

	}
}
else{ //e intrebarea lui

$answers=$op->getallanswersfromquestion($_GET["id"]);
$x=sizeof($answers);
if($x==0){echo "<div class='congrat'>nobody answered to your question ... be patient</div>";}
else echo "  <div class='congrat'>Your question have ".$x." answers! Please give feedback !</div>";
foreach($answers as $answer){
echo "<a href='../feedback/feedback.php?id=".$_GET["id"]."&user=".$answer["id_user"]."' style='text-decoration:none'><div class='answer'>".$op->db->getNameFromId($answer["id_user"])." answered to this question <i>click here to give him feedback</i></div></a>";
}


} 
}
?>
</div>


</div>
</body>
</html> 
