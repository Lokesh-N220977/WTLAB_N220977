<?php

echo "<h2>PHP File Open Modes Demonstration</h2>";

$file = "modes_demo.txt";

echo "<h3>1. Mode: w (Write - erase old data)</h3>";
$fp = fopen($file, "w");
fwrite($fp, "This is written using w mode.\n");
fclose($fp);
echo "File written using w mode.<br>";

echo "<h3>2. Mode: a (Append)</h3>";
$fp = fopen($file, "a");
fwrite($fp, "This line is appended using a mode.\n");
fclose($fp);
echo "Data appended.<br>";


echo "<h3>3. Mode: r (Read Only)</h3>";
$fp = fopen($file, "r");
$content = fread($fp, filesize($file));
fclose($fp);
echo nl2br($content);


echo "<h3>4. Mode: r+ (Read & Write)</h3>";
$fp = fopen($file, "r+");
fwrite($fp, "R+ mode writing at beginning.\n");
fclose($fp);
echo "Used r+ mode.<br>";


echo "<h3>5. Mode: w+ (Read & Write - erase)</h3>";
$fp = fopen($file, "w+");
fwrite($fp, "File reset using w+ mode.\n");
rewind($fp);
echo nl2br(fread($fp, filesize($file)));
fclose($fp);


echo "<h3>6. Mode: a+ (Read & Append)</h3>";
$fp = fopen($file, "a+");
fwrite($fp, "Appending using a+ mode.\n");
rewind($fp);
echo nl2br(fread($fp, filesize($file)));
fclose($fp);


echo "<h3>7. Mode: x (Create New - Fail if Exists)</h3>";

$newFile = "new_file.txt";

if (file_exists($newFile)) {
    unlink($newFile);
}

$fp = fopen($newFile, "x");
fwrite($fp, "Created using x mode.\n");
fclose($fp);

echo "New file created using x mode.<br>";


echo "<h3>8. Mode: x+ (Create New - Read & Write)</h3>";

$newFile2 = "new_file2.txt";

if (file_exists($newFile2)) {
    unlink($newFile2);
}

$fp = fopen($newFile2, "x+");
fwrite($fp, "Created using x+ mode.\n");
rewind($fp);
echo nl2br(fread($fp, filesize($newFile2)));
fclose($fp);

echo "<br><br>All file modes demonstrated successfully.";
?>