<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../signup.php");
    exit;
}

/* Read input */
$firstname = trim($_POST["firstname"] ?? "");
$lastname  = trim($_POST["lastname"] ?? "");
$gender    = trim($_POST["gender"] ?? "");
$username  = trim($_POST["username"] ?? "");
$email     = trim($_POST["email"] ?? "");
$password  = $_POST["password"] ?? "";

/* Empty validation */
if (
    $firstname === "" || $lastname === "" || $gender === "" ||
    $username === "" || $email === "" || $password === ""
) {
    die("Error: All fields are required");
}

$firstname = ucwords(strtolower(htmlspecialchars($firstname)));
$lastname  = ucwords(strtolower(htmlspecialchars($lastname)));
$username  = ucfirst(strtolower(htmlspecialchars($username)));
$email     = htmlspecialchars($email);

if (strlen($username) < 4) {
    die("Error: Username must be at least 4 characters long");
}

if (
    strlen($password) < 8 ||
    !preg_match("/[A-Z]/", $password) ||
    !preg_match("/[a-z]/", $password) ||
    !preg_match("/[0-9]/", $password) ||
    !preg_match("/[\W]/", $password)
) {
    die("Error: Password must be strong (8 chars, upper, lower, number, special)");
}

$sql = "SELECT id FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    die("Error: Email already registered");
}
mysqli_stmt_close($stmt);

$hashed = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users 
(firstname, lastname, gender, username, email, password)
VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param(
    $stmt,
    "ssssss",
    $firstname,
    $lastname,
    $gender,
    $username,
    $email,
    $hashed
);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conn);

echo "Registration successful";
