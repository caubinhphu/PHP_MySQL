<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  print_r($_POST);
  echo "<br>", $_POST["text"];
  $file = fopen("data.txt", "w") or die("Unable to open file!");
  foreach($_POST as $name=>$value) {
    fwrite($file, "$name: $value\n");
  }
  fclose($file);

} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  print_r($_GET["name"]);
}
