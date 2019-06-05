<?php
require_once "../operation.php";
require_once "../token.php";
global $token;
$token=new token();
if(isset($_COOKIE["token"]) and $token->vtoken($_COOKIE["token"])){
    
}
else header("Location: ../paginalogare/paginalogare.php");
global $questions;
$db=new operation($_COOKIE["token"]);
if(isset($_GET["type"]))
$type=$_GET["type"];
else $type="";
if(isset($_GET["owned"]) and $_GET["owned"]=="true")
$questions=$db->getallownedquestions($type);
else if(isset($_GET["owned"]) and $_GET["owned"]=="false")
    $questions=$db->getallansweredquestions($type);
else $questions=$db->getunansweredquestions($type);


?>
<!DOCTYPE html>
<html lang="en"><head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagina Principala</title>
</head>
<body>
    <!-- <header class="navBar">
        <ul>
            <li><a class="active" href="#home">Home</a></li>
            <li><a href="#Intrebari">My Account</a></li>
            <li><a href="#Livestream">Sign out</a></li>
        </ul> 
    </header> -->  
    <div class="menu">
        <form method="post" action="" id="categories">
            <a href="?type=HTML"><input type="button" name="html button" value = "HTML"></a>
            <a href="?type=CSS"><input type="button" name="css button" value = "CSS"></a>
            <a href="?type=PHP"><input type="button" name="php button" value = "PHP"></a>
            <a href="?type=JAVA"><input type="button" name="javscript button" value = "JAVASCRIPT"></a>
        </form>
        <form method="post" action="" id="type">
              <a href="?owned=false"><input type="button" name="html button" value = "Answered questions"></a>
            <a href="?owned=true"><input type="button" name="css button" value = "Added questions"></a>
        </form>
    </div>
    
    <div id="swipe">
            <img src="menu-button.png" alt="menu button" id="menuBtn">
    </div>
    <div class="content">
        <header class="header">
            <ul>
                <li><a class="active" href="../homepage/index.php">Home</a></li>
                <li><a href="../account/account.php">My Account</a></li>
                <li><a href="../paginalogare/logout.php">Sign out</a></li>
             </ul>
        </header>
        <?php
foreach($questions as $question){
    $rezolvari=$rating=$question["scor"];
    $vizualizari=$question["vizualizare"];
    $intrebare=$question["continut"];
    $id=$question["id"];
    $autor=$token->db->getNameFromId($question["id_user"]);
    $dificultate=$question["dificultate"];
    echo "<div class='question-container'><a href='../answer/answer.php?id={$id}'>
            <div class='check'>
                <img src='check.png' alt='check image'>
                <span>{$rezolvari}</span>
            </div>
            <div class='view'>
                <img src='view.png' alt='view image'>
                <span>{$vizualizari}</span>
            </div>
            <div class='star'>
                <img src='star.png' alt='star image'>
                <span>{$rating}</span>
            </div>
            <img src='{$dificultate}.png' alt='{$dificultate} tag' class='difficulty-tag'>
            <p>
                {$intrebare}
            </p>
            <div class='author'>
                
                <span>{$autor}</span>
            </div>
        </a></div>";
}
        ?>
        
        
        
        
        
    </div>
    <script>
        let menuBtn = document.getElementById('menuBtn');
        let menu = document.querySelector('.menu');

        menuBtn.addEventListener('click', () => {
            menu.classList.add('is--open');
        });

        document.addEventListener('keyup', (e) => {
            if(e.key === 'Escape' || e.keyCode ===27) {
                menu.classList.remove('is--open');
            }
        })
    </script>

</body></html>
