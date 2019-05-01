<?php
include "../token.php";
$token=new token();
global $username;
global $email;
global $added;
if(isset($_COOKIE["token"]) and $token->vtoken($_COOKIE["token"])){
     $username=$token->db->getUsernameFromToken($_COOKIE["token"]);
     $email=$token->db->getEmailFromToken($_COOKIE["token"]);
    $added=$token->db->counterAdded($_COOKIE["token"]);

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
            <input type="number" id="answerno" readonly value="<?php if(empty($added))$added=0;echo $added;?>" disabled>
           
            <label for="questionno">Problems added by you:</label>
            <input type="number" id="questionno" readonly value="<?php if(empty($added))$added=0;echo $added;?>" disabled>
        </div>
        <br/>
        <div class="parola">
            <h3>UPDATE PASSWORD</h3>
            <label for="pass">Password:</label>
            <input type="password" id="pass">
        
            <label for="newpass">New password:</label>
            <input type="password" id="newpass">

            <label for="retypepass">Retype password:</label>
            <input type="password" id="retypepass">

            <input type="submit" value="RESET" class="btn">
        </div>

        </div>
    <footer></footer>
</body>
</html>
