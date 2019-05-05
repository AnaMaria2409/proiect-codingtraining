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
    <div class="container" id="view-info">
        <a href="../account/account.php">
        <img src="view-info-image.png" alt="view-info-image" >
        <p>View your profile information</p>
        </a>
    </div>
    <div class="container" id="solve-question">
        <a href="../main question page/main.php">
        <img src="solve-question-image.png" alt="solve-question-image">
        <p>Questions</p>
        </a>
    </div>
    <div class="container" id="add-question">
        <a href="../add question/add.php">
        <img src="add-question-image.png" alt="add-question-image">
        <p>Add a question</p>
        </a>                                                  
    </div>
    <div class="container" id="view-livestream">
         <a href="../livestream/livestream.php">
        <img src="view-livestream-image.png" alt="view-livestream-image">
        <p>Watch a live-stream</p>
         </a>
    </div>
</body>
</html>
