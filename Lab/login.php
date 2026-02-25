<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: signin.php");
    exit;
}

/* Read input */
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

/* Validate empty */
if ($email === "" || $password === "") {
    header("Location: signin.php?error=empty");
    exit;
}

/* Find user in MongoDB */
$user = $users->findOne(['email' => $email]);

if (!$user) {
    header("Location: signin.php?error=notfound");
    exit;
}

/* Check if account is local login */
if (!isset($user['auth_type']) || $user['auth_type'] !== 'local') {
    header("Location: signin.php?error=google");
    exit;
}

/* Verify password */
if (!password_verify($password, $user['password'])) {
    header("Location: signin.php?error=invalid");
    exit;
}

/* Login success */
$_SESSION['user'] = $user['email'];

header("Location: index.php");
exit;