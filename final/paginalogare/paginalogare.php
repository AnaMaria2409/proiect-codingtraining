<?php
include "../token.php";
include '../git/config.php';

$token=new token();
$db=new dboperations();
if(isset($_COOKIE["token"]) and $token->vtoken($_COOKIE["token"]))
    header("Location: ../homepage/index.php");
if(isset($_POST["user"]) and isset($_POST["pass"]))
{
$token=new token();
if($token->vuser($_POST["user"],$_POST["pass"])){
setcookie("token",$token->vuser($_POST["user"],$_POST["pass"]),time() + (86400 * 30),"/");
$db->validateAndAddToken($_POST["user"],$token->vuser($_POST["user"],$_POST["pass"]));
header("Location: ../homepage/index.php");
}
}
require_once '../fblogin/Facebook/autoload.php';
$permissions=['email'];
if(!session_id())
session_start();
$callbackurl='http://localhost/fblogin/callback.php';
$fb = new Facebook\Facebook([
  'app_id' => '316692349248892', // Replace {app-id} with your app id
  'app_secret' => '1199d36d68703d9243178282f30e0571',
  'default_graph_version' => 'v3.2',

  ]);
$helper = $fb->getRedirectLoginHelper();
if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}
$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/fblogin/callback.php', $permissions);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="paginalogare.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Bine ai venit!</title>
</head>

<body>
    <header> 
        <form method="POST" action="paginalogare.php" class="log">
            <div>
            <label for="username">Username:</label>
            <input type="text" id="user" name="user" required>
            </div>
            <div>
            <label for="password">Password:</label>
            <input type="password" name="pass" required id="pass">
            </div>
            <button class="btn">Login</button>
                 <a href="<?php echo htmlspecialchars($loginUrl);?>" class="fb mybtn">
          <i class="fa fa-facebook fa-fw"></i> Login with Facebook
         </a>
         <a href="<?php echo htmlspecialchars($output);?>" class="git my mybtn">
         <i class="git gi"></i> Login with Github
        </a>
        </form>
    </header>

    <div class="main">
        <div class="principal1">
            <p id="motto"> Coding training.<br/> Learn code with us.</p>
        </div>
        <div class="principal2">
            <form class="sign" action="register.php" method="POST">
                <p class="titlu">Sign up</p>
                <div>
                     <input type="text" name="user" required placeholder="Username">
                </div>
                <div>
                    <input type="email"  name="email" placeholder="Email" required>
                </div>
                <div>
                    <input type="password" name="pass" required  placeholder="Password">
                </div>
                <div>
                    <input type="checkbox" id="terms" required>
                    <label for="terms"><a href="fvf">Termeni si conditii*</a></label>
                </div>
                <div>
                    <button class="btn-signup">Sign up</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
