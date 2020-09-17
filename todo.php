<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TODO";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  try {
    $conn = connect_db();
    $stmt = $conn->prepare("SELECT ID, CONTENT, COMPLETED FROM TODO ORDER BY DATE_CREATE");
    $stmt->execute();

    echo json_encode(genData($stmt));
  } catch(PDOException $e) {
    echo "ERROR";
  }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST["todo"])) {
    try {
      $conn = connect_db();
      $stmt = $conn->prepare("INSERT INTO TODO (ID, CONTENT) VALUES (?, ?)");
      $id = generateRandomString();
      $stmt->execute(array($id, $_POST["todo"]));
      $stmt = $conn->prepare("SELECT ID, CONTENT, COMPLETED FROM TODO WHERE ID = '$id'");
      $stmt->execute();
    
      echo json_encode(genData($stmt));
  
    } catch(PDOException $e) {
      echo "ERROR";
    }
  } else if (isset($_POST['id'])) {
    if (isset($_POST['completed'])) {
      try {
        $conn = connect_db();
        $stmt = $conn->prepare("UPDATE TODO SET COMPLETED = ?, DATE_MODIFY = now() WHERE ID = ?");
        $stmt->execute(array(filter_var($_POST['completed'], FILTER_VALIDATE_BOOLEAN), $_POST['id']));
        echo "OK";
      } catch(PDOException $e) {
        echo "ERROR";
      }
    } else if (isset($_POST['content'])) {
      try {
        $conn = connect_db();
        $stmt = $conn->prepare("UPDATE TODO SET CONTENT = ?, DATE_MODIFY = now() WHERE ID = ?");
        $stmt->execute(array($_POST['content'], $_POST['id']));
        echo "OK";
      } catch(PDOException $e) {
        echo "ERROR";
      }
    } else {
      try {
        $conn = connect_db();
        $stmt = $conn->prepare("DELETE FROM TODO WHERE ID = ?");
        $stmt->execute(array($_POST['id']));
        echo "OK";
      } catch(PDOException $e) {
        echo "ERROR";
      }
    }
  } 
}


function generateRandomString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function genData($data) {
  $res = array();
  foreach($data as $item) {
    array_push($res,
    array(
      "id" => $item["ID"],
      "content" => $item["CONTENT"],
      "isCompleted" => $item["COMPLETED"]
    ));
  }
  return $res;
}

function connect_db() {
  $conn = new PDO(
    "mysql:host=" . $GLOBALS["servername"] . ";dbname=" . $GLOBALS["dbname"],
    $GLOBALS["username"],
    $GLOBALS["password"]
  );
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $conn;
}