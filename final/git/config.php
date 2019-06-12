<?php
// Start session
global $output;
if(!session_id())
session_start();
// Include Github client library 
require_once 'src/Github_OAuth_Client.php';

$clientID         = 'bacc67107a113359ec8e';
$clientSecret     =  'b79356e0103b85da2bc6e377adaa0c59a68b3254';
$redirectURL     = 'http://localhost/git/index.php';

    
$gitClient = new Github_OAuth_Client(array(
    'client_id' => $clientID,
    'client_secret' => $clientSecret,
    'redirect_uri' => $redirectURL,
));

$output=htmlspecialchars("https://github.com/login/oauth/authorize?client_id=bacc67107a113359ec8e&amp;amp;redirect_uri=http%3A%2F%2Flocalhost%2Fgit%2Findex.php&amp;amp;scope=user%3Aemail");

// Try to get the access token
if(isset($_SESSION['access_token'])){
    $accessToken = $_SESSION['access_token'];
}