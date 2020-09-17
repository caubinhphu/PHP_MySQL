<?php

// include './basic.php';
// require './basic.php';

// data time
echo "<strong>Date time</strong>";
echo "<br>", date("d/m/Y");
$date_1 = mktime(0, 0, 0, 5, 10, 2010);
echo "<br>", date("d/m/Y", $date_1);
echo "<br>", time();
$date_2 = date_create("2009-05-15");
echo "<br>", date_format(date_modify($date_2, "3 days"), "Y-m-d");
print_r(date_parse("2009-05-15"));
// ........................

// file
echo "<br><strong>File</strong><br>";
readfile('text.txt');
$file = fopen('text.txt', "r") or die("Unable to open file!");
while(!feof($file)) {
  echo "<br>", fgets($file);
}
rewind($file); // reset pointer read file
while(!feof($file)) {
  echo "<br>", fgetc($file);
}
fclose($file);


// cookies
echo "<br><strong>Cookies</strong><br>";
setcookie("id", "23qbwe23v4q62<>34vq23", time() + 1000000, "/");
setrawcookie("idd", "23qbwe23v4q6<>234vq23", time() + 1000000, "/");
echo $_COOKIE["id"];
echo "<br>";
echo $_COOKIE["idd"];

show_cookie('idd');

function show_cookie($cookie) {
  if(!isset($_COOKIE[$cookie])) {
    echo "<br>Cookie '$cookie' is not set!";
  } else {
    echo "<br>Cookie '$cookie' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie];
  }
}

function remove_cookie($cookie) {
  setcookie($cookie, "", time() - 100000, "/");
}
?>
<a href="/php_mysql/advanced.php?remove=true">Remove cookie idd</a>

<?php
if (isset($_GET['remove'])) {
  remove_cookie('idd');
}


// JSON
echo "<br><strong>JSON</strong><br>";
$data= array("Teo"=>10, "Ty"=>9, "Tet"=>11);
$json = json_encode($data);
echo $json;
$data_decode = json_decode($json);
print_r($data_decode);
echo $data_decode->Ty;

// Exception
echo "<br><strong>Exception</strong><br>";
try {
  throw new Exception("Error Processing Request");
} catch (Exception $err) {
  print_r($err);
  echo "<br>Message: ", $err->getMessage() ;
}