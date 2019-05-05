<?php
include "../token.php";
$token=new token();
if(isset($_COOKIE["token"]) and $token->vtoken($_COOKIE["token"])){
    
}
else header("Location: ../paginalogare/paginalogare.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header class="navBar">
        <ul>
            <li><a class="active" href="../homepage/index.php">Home</a></li>
  <li><a href="../account/account.php">My Account</a></li>
  <li><a href="../paginalogare/logout.php">Sign out</a></li>
        </ul>
    </header>

    <div id="container">  
        <form action="addquestion.php" method="POST">
        <div id="difficulty">
            <p class="text"><b>Difficulty:</b></p>
            <select class="select" name="difficulty">
            <option>Easy</option>
            <option>Medium</option>
            <option>Hard</option>
            </select>
        </div>
    
        <div id="exercise-type">
            <p class="text"><b>Type:</b></p>
             <select class="select" name="category">
              <option>HTML</option>
              <option>CSS</option>
              <option>JAVA</option>
              <option>PHP</option>
             </select>
        </div>
        <div id="question-statement">
            <p>Write your question:</p>
            <textarea name="question"></textarea>
        </div>
        <div id="question-description">
                <p>Describe your solution:</p>
                <textarea name="solution"></textarea>
        </div>
    
        <input type="submit" class="button" value="SEND">
        </form>
    </div>
</body>
</html>
