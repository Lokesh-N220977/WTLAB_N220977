<?php

$target_dir = "uploads/";

if (!is_dir($target_dir)) {
    mkdir($target_dir);
}

$target_file = $target_dir . basename($_FILES["myfile"]["name"]);

if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) {
    header("Location: index.php?upload=success");
    exit;
} else {
    header("Location: index.php?upload=error");
    exit;
}