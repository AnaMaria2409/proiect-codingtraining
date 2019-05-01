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
            <li><a class="active" href="../../Alexandru Denis/home page/index.html">Home</a></li>
            <li><a href="../../Proiect/account.html">My Account</a></li>
            <li><a href="../../Proiect/paginalogare.html">Sign out</a></li>
        </ul>
    </header>

    <div id="container">  
        <div id="difficulty">
            <img src="easy.png" alt="easy icon">
            <img src="medium.png" alt="medium icon">
            <img src="hard.png" alt="hard icon">
        </div>
        <div id="exercise-type">
                <img src="html.png" alt="html icon">
                <img src="css.png" alt="css icon">
                <img src="php.svg" alt="php icon">
                <img src="javascript.png" alt="javscript icon">
        </div>
        <div id="question-statement">
            <p>Write your question:</p>
            <textarea></textarea>
        </div>
        <div id="question-description">
                <p>Describe your question:</p>
                <textarea></textarea>
        </div>
        <button>SEND</button>
    </div>
</body>
</html>
