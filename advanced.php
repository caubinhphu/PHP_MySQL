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

