<?php
include "../token.php";
include "../operation.php";

$token=new token();
global $username;
global $email;
global $added;
global $nrofsolved;


if(isset($_COOKIE["token"]) and $token->vtoken($_COOKIE["token"])){
     $username=$token->db->getUsernameFromToken($_COOKIE["token"]);
     $email=$token->db->getEmailFromToken($_COOKIE["token"]);
    $added=$token->db->counterAdded($_COOKIE["token"]);
$op=new operation($_COOKIE["token"]);
$id=$token->db->getIdFromToken($_COOKIE["token"]);
$nrofsolved=$op->getNumberofAnsweredQuestions($id);
}

else header("Location: ../paginalogare/paginalogare.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="account.css">
    <title>Account Info</title>
</head>
<body>
    <header class="navBar">
        <ul>
          <li><a class="active" href="../homepage/index.php">Home</a></li>
            <li><a href="../account/account.php">My Account</a></li>
            <li><a href="../paginalogare/logout.php">Sign out</a></li>
        </ul>
    </header>
    
    <div class=account>

        <div class="avatarcls">
            <img src="img.jpg" id="avatar" alt="image" onclick="" >
        </div>


        <div class="info">
            <h3>ACCOUNT DETAILS</h3>
           
            <label for="username">Username:</label>
            <input type="text" id="username" value="<?php echo $username;?>" disabled>
           
            <label for="mail">Email:</label>
            <input type="email" id="mail" value="<?php echo $email;?>" disabled>
           
            <label for="answerno">Problems solved</label>
            <input type="number" id="answerno" readonly value="<?php
                echo $nrofsolved;
            ?>" disabled>
           
            <label for="questionno">Problems added by you:</label>
            <input type="number" id="questionno" readonly value="<?php if(empty($added))$added=0;echo $added;?>" disabled>
        </div>
        <br/>
        <div class="parola">
            <form action="resetpassword.php" method="POST">
            <h3>UPDATE PASSWORD</h3>
            <label for="pass">Password:</label>
            <input name="currentpassword" type="password" id="pass" required="">
        
            <label for="newpass">New password:</label>
            <input name="newpass1" type="password" id="newpass" required="">

            <label for="retypepass">Retype password:</label>
            <input name="newpass2" type="password" id="retypepass" required="">

            <input type="submit" value="RESET" class="btn">
        </form>
        </div>

        </div>
    <footer></footer>
</body>
</html>
