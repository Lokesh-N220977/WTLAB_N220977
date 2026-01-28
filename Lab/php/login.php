<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../signin.php");
    exit;
}

$email = trim($_POST["email"] ?? '');
$password = trim($_POST["password"] ?? '');

if ($email === "" || $password === "") {
    header("Location: ../signin.php?error=empty");
    exit;
}

$sql = "SELECT id, password FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("SQL prepare failed");
}

mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) !== 1) {
    header("Location: ../signin.php?error=notfound");
    exit;
}

mysqli_stmt_bind_result($stmt, $id, $dbPassword);
mysqli_stmt_fetch($stmt);

if (!password_verify($password, $dbPassword)) {
    header("Location: ../signin.php?error=wrongpass");
    exit;
}

$_SESSION["user_id"] = $id;

header("Location: ../index.php");
exit;
