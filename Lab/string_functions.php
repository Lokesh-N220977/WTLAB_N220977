<?php
session_start();
$str = "  hello world from php  ";

echo "Original string: '$str' <br><br>";


echo "Length: " . strlen($str) . "<br>";
echo "Word count: " . str_word_count($str) . "<br>";
echo "Reverse: " . strrev($str) . "<br><br>";

echo "Uppercase: " . strtoupper($str) . "<br>";
echo "Lowercase: " . strtolower($str) . "<br>";
echo "Ucfirst: " . ucfirst(trim($str)) . "<br>";
echo "Ucwords: " . ucwords(trim($str)) . "<br><br>";


echo "Position of 'world': " . strpos($str, "world") . "<br>";
echo "Replace 'php' with 'PHP Lab': " . str_replace("php", "PHP Lab", $str) . "<br><br>";

echo "Substring (0–5): " . substr($str, 0, 5) . "<br>";
echo "Trim: '" . trim($str) . "' <br>";
echo "Left Trim: '" . ltrim($str) . "' <br>";
echo "Right Trim: '" . rtrim($str) . "' <br><br>";

echo "strcmp('hello','Hello'): " . strcmp("hello", "Hello") . "<br>";
echo "strcasecmp('hello','Hello'): " . strcasecmp("hello", "Hello") . "<br><br>";

$special = "<script>alert('XSS')</script>";
echo "htmlspecialchars: " . htmlspecialchars($special) . "<br>";
echo "addslashes: " . addslashes("I'm learning PHP") . "<br>";

echo "<hr>";


if (isset($_POST["username"])) {

    $_SESSION["username"] = trim($_POST["username"]);
    header("Location: string_functions.php");
    exit;
}
if (isset($_SESSION["username"])) {

    $username = $_SESSION["username"];

    echo "<h3>User Input String</h3>";
    echo "Stored input: $username <br>";
    echo "Uppercase: " . strtoupper($username) . "<br>";
    echo "Length: " . strlen($username) . "<br>";

    unset($_SESSION["username"]);
}
else {
?>

<h3>Enter Username</h3>
<form method="post">
    <input type="text" name="username" required>
    <input type="submit" value="Submit">
</form>

<?php
}
?>
