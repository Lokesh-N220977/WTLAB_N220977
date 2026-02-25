<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;

/* Load .env */
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


$client = new Google_Client();

$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);

$client->addScope("email");
$client->addScope("profile");

header("Location: " . $client->createAuthUrl());
exit;