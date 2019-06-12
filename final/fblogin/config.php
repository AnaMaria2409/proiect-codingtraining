<?php
require_once 'Facebook/autoload.php';
session_start();
$permissions=['email'];
$callbackurl='http://localhost/fblogin/callback.php';


$fb = new Facebook\Facebook([
  'app_id' => '316692349248892', // Replace {app-id} with your app id
  'app_secret' => '1199d36d68703d9243178282f30e0571',
  'default_graph_version' => 'v3.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/fblogin/callback.php', $permissions);


?>