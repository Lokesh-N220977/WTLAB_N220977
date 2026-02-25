<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: signup.php");
    exit;
}

/* Collect & sanitize input */
$firstname = trim($_POST["firstname"] ?? "");
$lastname  = trim($_POST["lastname"] ?? "");
$gender    = trim($_POST["gender"] ?? "");
$username  = trim($_POST["username"] ?? "");
$email     = trim($_POST["email"] ?? "");
$password  = $_POST["password"] ?? "";

/* Validate empty fields */
if (!$firstname || !$lastname || !$gender || !$username || !$email || !$password) {
    header("Location: signup.php?error=empty");
    exit;
}

/* Strong password check */
$pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/";
if (!preg_match($pattern, $password)) {
    header("Location: signup.php?error=password");
    exit;
}

/* Check if email already exists */
$existingUser = $users->findOne(['email' => $email]);

if ($existingUser) {
    header("Location: signup.php?error=exists");
    exit;
}

/* Hash password */
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

/* Insert into MongoDB */
$users->insertOne([
    'firstname' => $firstname,
    'lastname'  => $lastname,
    'gender'    => $gender,
    'username'  => $username,
    'email'     => $email,
    'password'  => $hashedPassword,
    'auth_type' => 'local',
    'createdAt' => new MongoDB\BSON\UTCDateTime()
]);

header("Location: signup.php?success=1");
exit;
?>