<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../signin.php");
    exit;
}

/* Read input */
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

/* Empty validation */
if ($email === "" || $password === "") {
    die("Error: Email and password are required");
}

/* Fetch user from DB */
$sql = "SELECT id, password FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Database error");
}

mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

/* Check if user exists */
if (mysqli_stmt_num_rows($stmt) !== 1) {
    die("Error: User not found");
}

mysqli_stmt_bind_result($stmt, $userId, $dbPassword);
mysqli_stmt_fetch($stmt);

/* Verify password */
if (!password_verify($password, $dbPassword)) {
    die("Error: Invalid password");
}

/* Login success */
$_SESSION["user_id"] = $userId;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo "Login successful";
