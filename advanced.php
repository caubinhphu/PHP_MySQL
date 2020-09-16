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






// upload file
echo "<strong>Upload file</strong>";
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
// print_r($_FILES["file"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// print_r($imageFileType);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["file"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}