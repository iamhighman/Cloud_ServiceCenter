<?php

include("./GoogleClass.php");

$obj = new GoogleClass();

$ViewLink = "http://spreadsheets.google.com/pub?key=pOUkqH7otJYfKSAvCTf-Yag";

$FormLink ="http://spreadsheets.google.com/formResponse?key=pOUkqH7otJYfKSAvCTf-Yag";
//echo $FormLink;

$a = "highman";
$b = rand();
$c = rand();
$d = "Hello world";

$Post = "entry.3.single=$a&entry.4.single=$b&entry.5.single=$c&entry.6.single=$d"; 

$obj->Save2GDB($FormLink, $Post); //Save to DB

print_r($obj->getGDB($ViewLink)); //Display DB



?>
