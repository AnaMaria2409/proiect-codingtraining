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
        <ul>
            <li>HTML</li>
            <li>CSS</li>
            <li>PHP</li>
            <li>JAVASCRIPT</li>       
        </ul>
    </div>
    
    <div id="swipe">
            <img src="menu-button.png" alt="menu button" id="menuBtn">
    </div>
    <div class="content">
        
        <div class="question-container">
            <div class="check">
                <img src="check.png" alt="check image">
                <span>10</span>
            </div>
            <div class="view">
                <img src="view.png" alt="view image">
                <span>45</span>
            </div>
            <div class="star">
                <img src="star.png" alt="star image">
                <span>8</span>
            </div>
            <img src="easy.png" alt="easy tag" class="difficulty-tag">
            <p>
                Write the CSS needed to add the look and interaction found here. I'm giving you the HTML below. You can add classes and id's to the elements, if you feel the need, but otherwise don't modify the structure.
                There's also a little JavaScript there which adds the is--open class to the div class="menu" element when you click the button. It also removes this class if you press the Esc key. So when this class is present show the menu, otherwise it should be hidden.
                PS: don't worry about the JS code, it's ok if you don't understand it.
                PPS: you will need to use CSS transitions for the menu. Also flex would work wonders for the header.
            </p>
            <div class="author">
                <img src="live.png" alt="live image">
                <span>AuthorName</span>
            </div>
        </div>
        <div class="question-container">
                <div class="check">
                    <img src="check.png" alt="check image">
                    <span>14</span>
                </div>
                <div class="view">
                    <img src="view.png" alt="check image">
                    <span>75</span>
                </div>
                <div class="star">
                    <img src="star.png" alt="star image">
                    <span>2</span>
                </div>
                <img src="medium.png" alt="medium tag" class="difficulty-tag">
                <p>
                    Write the CSS needed to add the look and interaction found here. I'm giving you the HTML below. You can add classes and id's to the elements, if you feel the need, but otherwise don't modify the structure.
                    There's also a little JavaScript there which adds the is--open class to the div class="menu" element when you click the button. It also removes this class if you press the Esc key. So when this class is present show the menu, otherwise it should be hidden.
                    PS: don't worry about the JS code, it's ok if you don't understand it.
                    PPS: you will need to use CSS transitions for the menu. Also flex would work wonders for the header.
                </p>
                <div class="author">
                <img src="live_off.png" alt="live image">
                <span>AuthorName</span>
                </div>
        </div>
        <div class="question-container">
                <div class="check">
                    <img src="check.png" alt="check image">
                    <span>21</span>
                </div>
                <div class="view">
                    <img src="view.png" alt="check image">
                    <span>35</span>
                </div>
                <div class="star">
                    <img src="star.png" alt="star image">
                    <span>7</span>
                </div>
                
                <img src="hard.png" alt="hard tag" class="difficulty-tag">
                <p>
                    Write the CSS needed to add the look and interaction found here. I'm giving you the HTML below. You can add classes and id's to the elements, if you feel the need, but otherwise don't modify the structure.
                    There's also a little JavaScript there which adds the is--open class to the div class="menu" element when you click the button. It also removes this class if you press the Esc key. So when this class is present show the menu, otherwise it should be hidden.
                    PS: don't worry about the JS code, it's ok if you don't understand it.
                    PPS: you will need to use CSS transitions for the menu. Also flex would work wonders for the header.
                </p>
                <div class="author">
                <img src="live_off.png" alt="live image">
                <span>AuthorName</span>
                </div>
        </div>
        <div class="question-container">
                <div class="check">
                    <img src="check.png" alt="check image">
                    <span>6</span>
                </div>
                <div class="view">
                    <img src="view.png" alt="check image">
                    <span>32</span>
                </div>
                <div class="star">
                    <img src="star.png" alt="star image">
                    <span>3</span>
                </div>
                <img src="medium.png" alt="medium tag" class="difficulty-tag">
                <p>
                    Write the CSS needed to add the look and interaction found here. I'm giving you the HTML below. You can add classes and id's to the elements, if you feel the need, but otherwise don't modify the structure.
                There's also a little JavaScript there which adds the is--open class to the div class="menu" element when you click the button. It also removes this class if you press the Esc key. So when this class is present show the menu, otherwise it should be hidden.
                PS: don't worry about the JS code, it's ok if you don't understand it.
                PPS: you will need to use CSS transitions for the menu. Also flex would work wonders for the header.
                </p>
                <div class="author">
                <img src="live.png" alt="live image">
                <span>AuthorName</span>
                </div>
        </div>
        <div class="question-container">
                <div class="check">
                    <img src="check.png" alt="check image">
                    <span>13</span>
                </div>
                <div class="view">
                    <img src="view.png" alt="check image">
                    <span>51</span>
                </div>
                <div class="star">
                    <img src="star.png" alt="star image">
                    <span>8</span>
                </div>
                <img src="hard.png" alt="hard tag" class="difficulty-tag">
                <p>
                    Write the CSS needed to add the look and interaction found here. I'm giving you the HTML below. You can add classes and id's to the elements, if you feel the need, but otherwise don't modify the structure.
                    There's also a little JavaScript there which adds the is--open class to the div class="menu" element when you click the button. It also removes this class if you press the Esc key. So when this class is present show the menu, otherwise it should be hidden.
                    PS: don't worry about the JS code, it's ok if you don't understand it.
                    PPS: you will need to use CSS transitions for the menu. Also flex would work wonders for the header.
                </p>
                <div class="author">
                <img src="live_off.png" alt="live image">
                <span>AuthorName</span>
                </div>
        </div>
        <div class="question-container">
                <div class="check">
                    <img src="check.png" alt="check image">
                    <span>5</span>
                </div>
                <div class="view">
                    <img src="view.png" alt="check image">
                    <span>40</span>
                </div>
                <div class="star">
                    <img src="star.png" alt="star image">
                    <span>3</span>
                </div>
                <img src="easy.png" alt="easy tag" class="difficulty-tag">
                <p>
                    Write the CSS needed to add the look and interaction found here. I'm giving you the HTML below. You can add classes and id's to the elements, if you feel the need, but otherwise don't modify the structure.
                There's also a little JavaScript there which adds the is--open class to the div class="menu" element when you click the button. It also removes this class if you press the Esc key. So when this class is present show the menu, otherwise it should be hidden.
                PS: don't worry about the JS code, it's ok if you don't understand it.
                PPS: you will need to use CSS transitions for the menu. Also flex would work wonders for the header.
                </p>
                <div class="author">
                <img src="live_off.png" alt="live image">
                <span>AuthorName</span>
                </div>
        </div>

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
</body>
</html>