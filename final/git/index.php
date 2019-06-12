<?php
// Include GitHub API config file
require_once 'config.php';
include_once "../token.php";
global $output;
if(!session_id())
session_start();
if(isset($accessToken)){
    // Get the user profile info from Github
    $gitUser = $gitClient->apiRequest($accessToken);
    
    if(!empty($gitUser)){
        // User profile data
        $gitUserData = array();
        $gitUserData['oauth_provider'] = 'github';
        $gitUserData['oauth_uid'] = !empty($gitUser->id)?$gitUser->id:'';
        $gitUserData['name'] = !empty($gitUser->name)?$gitUser->name:'';
        $gitUserData['username'] = !empty($gitUser->login)?$gitUser->login:'';
        $gitUserData['email'] = !empty($gitUser->email)?$gitUser->email:'';
        $gitUserData['location'] = !empty($gitUser->location)?$gitUser->location:'';
        $gitUserData['picture'] = !empty($gitUser->avatar_url)?$gitUser->avatar_url:'';
        $gitUserData['link'] = !empty($gitUser->html_url)?$gitUser->html_url:'';
        
        
        // Put user data into the session
        $_SESSION['userData'] = $gitUserData;
        
        // Render Github profile data
        $output  = '<h2>Github Profile Details</h2>';
        $output .= '<img src="'.$gitUserData['picture'].'" />';
        $output .= '<p>ID: '.$gitUserData['oauth_uid'].'</p>';
        $output .= '<p>Name: '.$gitUserData['name'].'</p>';
        $output .= '<p>Login Username: '.$gitUserData['username'].'</p>';
        $output .= '<p>Email: '.$gitUserData['email'].'</p>';
        $output .= '<p>Location: '.$gitUserData['location'].'</p>';
        $output .= '<p>Profile Link :  <a href="'.$gitUserData['link'].'" target="_blank">Click to visit GitHub page</a></p>';
        $output .= '<p>Logout from <a href="logout.php">GitHub</a></p>'; 
        echo $output;
            $username=$gitUserData['username'].$gitUserData['oauth_uid'];
            $password=$username."secret";
            
            $email="inexistent@gmail.com";

            $token=new token();

            if($token->vuser($username,$password)){
            setcookie("token",$token->vuser($username,$password),time() + (86400 * 30),"/");
            $token->db->validateAndAddToken($username,$token->vuser($username,$password));
            header("Location: ../homepage/index.php");
            }else {

            $token->db->register($username,$password,$email);
            $tok=$token->vuser($username,$password);
            setcookie("token",$token->vuser($username,$password),time() + (86400 * 30),"/");
            $token->db->validateAndAddToken($username,$token->vuser($username,$password));

             header("Location: ../homepage/index.php");
            }



    }else{
        echo $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';

    }
    
}elseif(isset($_GET['code'])){
    // Verify the state matches the stored state
    if(!$_GET['state'] || $_SESSION['state'] != $_GET['state']) {
        header("Location: ".$_SERVER['PHP_SELF']);
    }
    
    // Exchange the auth code for a token
    $accessToken = $gitClient->getAccessToken($_GET['state'], $_GET['code']);
  
    $_SESSION['access_token'] = $accessToken;
  
    header('Location: ./');
}else{
    // Generate a random hash and store in the session for security
    $_SESSION['state'] = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);
    
    // Remove access token from the session
    unset($_SESSION['access_token']);
  
    // Get the URL to authorize
    $loginURL = $gitClient->getAuthorizeURL($_SESSION['state']);
    
    // Render Github login button
    $output = htmlspecialchars($loginURL);
}

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Login with GitHub using PHP by CodexWorld</title>
<meta charset="utf-8">
</head>
<body>
<div class="container">
    <!-- Display login button / GitHub profile information -->
   
</div>
</body>
</html>