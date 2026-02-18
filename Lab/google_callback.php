<?php
require 'vendor/autoload.php';

use Google\Client as Google_Client;
use Dotenv\Dotenv;

session_start();

// Load .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

/* DEBUG — remove later */
echo "<pre>";
echo "CLIENT ID: " . $_ENV['GOOGLE_CLIENT_ID'] . "\n";
echo "REDIRECT URI: " . $_ENV['GOOGLE_REDIRECT_URI'] . "\n";
echo "</pre>";
exit();
/* END DEBUG */

$client = new Google_Client();
$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
$client->addScope("email");
$client->addScope("profile");

header('Location: ' . $client->createAuthUrl());
exit();