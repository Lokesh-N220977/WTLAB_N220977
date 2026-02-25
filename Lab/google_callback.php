<?php
session_start();
require 'vendor/autoload.php';
require 'db.php';

use Dotenv\Dotenv;

/* Load .env */
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client = new Google_Client();

$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);

if (!isset($_GET['code'])) {
    die("Google authentication failed.");
}

$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

if (isset($token['error'])) {
    die("Token error.");
}

$client->setAccessToken($token);

$oauth = new Google_Service_Oauth2($client);
$googleUser = $oauth->userinfo->get();

$email = $googleUser->email;
$firstname = $googleUser->givenName ?? "";
$lastname = $googleUser->familyName ?? "";
$googleId = $googleUser->id;

/* Check if user exists */
$user = $users->findOne(['email' => $email]);

if (!$user) {
    $users->insertOne([
        'firstname' => $firstname,
        'lastname'  => $lastname,
        'email'     => $email,
        'google_id' => $googleId,
        'auth_type' => 'google',
        'createdAt' => new MongoDB\BSON\UTCDateTime()
    ]);
}

/* Unified session */
$_SESSION['user'] = $email;

header("Location: index.php");
exit;