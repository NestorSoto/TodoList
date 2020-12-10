<?php
session_start();
require_once  '../../vendor/autoload.php'; 
$fb = new Facebook\Facebook([
  'app_id' => '291519948897073',
  'app_secret' => 'fea39d5ed1179a29c350c0046a379c69',
  'default_graph_version' => 'v3.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$redirectURL = "https://".$_SERVER['SERVER_NAME']."/fb-callback.php";
$loginUrl = $helper->getLoginUrl($redirectURL, $permissions);
echo '<a href="' . $loginUrl . '">Log in con Facebook!</a>';

 ?>