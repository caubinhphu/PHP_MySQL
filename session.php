<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
    $_SESSION["name"] = "Teo";
    $_SESSION["id"] = "1234";
    print_r($_SESSION);
    session_unset();
    session_destroy();
    print_r($_SESSION);
  ?>
</body>
</html>