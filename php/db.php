<?php
$conn = mysqli_connect("localhost", "root", "", "wtlab");

if (!$conn) {
    die("Database connection failed");
} else {
    echo "DB connected successfully";
}
?>
