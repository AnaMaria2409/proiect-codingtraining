<?php
session_start();
include_once("../token.php");
require_once 'Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '316692349248892', // Replace {app-id} with your app id
  'app_secret' => '1199d36d68703d9243178282f30e0571',
  'default_graph_version' => 'v3.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
//echo '<h3>Access Token</h3>';
//var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=email,first_name,last_name,picture', $accessToken->getValue());
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}


echo $response->getGraphUser()->asArray()['id'];
echo $response->getGraphUser()->asArray()['first_name'].'</br>';
echo $response->getGraphUser()->asArray()['last_name'].'</br>';
$username=$response->getGraphUser()->asArray()['first_name'].$response->getGraphUser()->asArray()['last_name'].$response->getGraphUser()->asArray()['id'];
$password=$response->getGraphUser()->asArray()['id']."secretcode";
if(isset($response->getGraphUser()->asArray()['email']))$email=$response->getGraphUser()->asArray()['email'];
else $email="inexistent@gmail.com";
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
//var_dump($response->getGraphUser()->asArray());



// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
//echo '<h3>Metadata</h3>';
//var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId('316692349248892'); // Replace {app-id} with your app id
// If you kn/ow the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
    exit;
  }
}

$_SESSION['fb_access_token'] = (string) $accessToken;
?>