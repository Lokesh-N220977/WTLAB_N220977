<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../signup.php");
    exit;
}

$username = trim($_POST["username"]);
$email    = trim($_POST["email"]);
$password = trim($_POST["password"]);

if ($username === "" || $email === "" || $password === "") {
    header("Location: ../signup.php?error=empty");
    exit;
}

/* check if email already exists */
$sql = "SELECT id FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    header("Location: ../signup.php?error=exists");
    exit;
}

mysqli_stmt_close($stmt);

/* hash password */
$hashed = password_hash($password, PASSWORD_DEFAULT);

/* insert user */
$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed);
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
mysqli_close($conn);

header("Location: ../signup.php?success=1");
exit;
