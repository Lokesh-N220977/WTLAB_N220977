<?php

echo "<h2>PHP File Functions Demo.</h2>";

$file ="demo.txt";

echo "<h3>1.Writing to File</h3>";

$fp=fopen($file,"w");
fwrite($fp,"Hello World\n");
fwrite($fp, "This is file functions demo.\n");
fclose($fp);

echo "Data written successfully.<br>";



echo "<h3>2. Reading File</h3>";

$fp = fopen($file, "r");
$content = fread($fp, filesize($file));
fclose($fp);

echo nl2br($content);  #nl2br stands for newline to break.



echo "<h3>3. File Information</h3>";

echo "File Exists: " . (file_exists($file) ? "Yes" : "No") . "<br>";
echo "File Size: " . filesize($file) . " bytes<br>";
echo "File Type: " . filetype($file) . "<br>";
echo "Last Accessed: " . date("Y-m-d H:i:s", fileatime($file)) . "<br>";
echo "Last Modified: " . date("Y-m-d H:i:s", filemtime($file)) . "<br>";
echo "Created Time: " . date("Y-m-d H:i:s", filectime($file)) . "<br>";
echo "Permissions: " . fileperms($file) . "<br>";
echo "Owner: " . fileowner($file) . "<br>";
echo "Group: " . filegroup($file) . "<br>";
echo "Inode: " . fileinode($file) . "<br>";



echo "<h3>4. Copy and Rename</h3>";

copy($file, "copy_demo.txt");
rename("copy_demo.txt", "renamed_demo.txt");

echo "File copied and renamed.<br>";





echo "<h3>5. Directory Handling</h3>";

echo "Current Working Directory: " . getcwd() . "<br>";

$files = scandir(".");
echo "Files in Current Directory:<br>";
foreach ($files as $f) {
    echo $f . "<br>";
}



echo "<h3>6. File Locking</h3>";

$fp = fopen($file, "a");

if (flock($fp, LOCK_EX)) {
    fwrite($fp, "Locked writing example.\n");
    flock($fp, LOCK_UN);
    echo "File locked and written safely.<br>";
}

fclose($fp);

#unlink("renamed_demo.txt");