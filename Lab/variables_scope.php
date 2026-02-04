<?php

$name = "Happy";          
$age = 21;                 
$cgpa = 8.45;              
$isStudent = true;         
$skills = array("PHP", "HTML", "CSS"); 

echo "<h3>PHP Data Types</h3>";
echo "Name (string): $name <br>";
echo "Age (integer): $age <br>";
echo "CGPA (Double(/float)): $cgpa <br>";
echo "Is Student (boolean): " . ($isStudent ? "true" : "false") . "<br>";
echo "Skills (array): ";
print_r($skills);
echo "<hr>";

//Local scope 
function localScopeEx() {
    $local="I am a local variable for this function";
    echo "<b>Local Scope:</b> $local  <br>";
}
localScopeEx();
// Global Scope
$globalv= "I am a global variable";
function globalScopeEx() {
    global $globalv;
    echo "<b>Global Scope:</b> $globalv <br>";
}
globalScopeEx();

function staticScopeEx() {
    static $count = 0;
    $count++;
    echo "<b>Static -- Count:</b> $count <br>";
}

echo "<br><b>Static Scope:</b><br>";
staticScopeEx();
staticScopeEx();
staticScopeEx();



?>