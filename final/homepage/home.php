<?php
include "../token.php";
include "../operation.php";

$token=new token();
global $op;
if(isset($_COOKIE["token"]) and $token->vtoken($_COOKIE["token"])){
    echo "you are logged in , congrats<br/>";
    $op=new operation($_COOKIE["token"]);
    echo $token->db->getNameFromId($token->db->getIdFromToken($_COOKIE["token"]));
}
else echo "nlo";

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
                    <li><a class="active" href="../home page/home.html">Home</a></li>
                    <li><a href="../account/account.html">My Account</a></li>
                    <li><a href="../paginalogare/paginalogare.html">Sign out</a></li>
                </ul>
            </header>
    <div class="container" id="view-info">
        <a href="../account/account.html">
        <img src="view-info-image.png" alt="view-info-image" >
        <p>View your profile information</p>
        </a>
    </div>
    <div class="container" id="solve-question">
        <a href="../main question page/main.html">
        <img src="solve-question-image.png" alt="solve-question-image">
        <p>Solve some questions</p>
        </a>
    </div>
    <div class="container" id="add-question">
        <a href="../add question/add.html">
        <img src="add-question-image.png" alt="add-question-image">
        <p>Add a question</p>
        </a>                                                  
    </div>
    <div class="container" id="view-livestream">
         <a href="../livestream/livestream.html">
        <img src="view-livestream-image.png" alt="view-livestream-image">
        <?php $op->viewLinks();?>
         </a>
    </div>
</body>
</html>
