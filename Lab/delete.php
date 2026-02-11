<?php

if (isset($_POST['file'])) {

    $file = basename($_POST['file']);   // Prevent directory traversal
    $filepath = "uploads/" . $file;

    if (file_exists($filepath)) {
        unlink($filepath);   // Delete file
    }

}

header("Location: index.php");
exit();
?>