<?php
session_start();
// Include the database configuration file
include '../config/config.php';


$query = $pdo->prepare("INSERT into favorite (image_id, user_id, favorited_on) VALUES (?, ?, NOW())");

$data = array(
  $_GET['image_id'],
  $_SESSION['id']
);

$insert = $query->execute($data);

if ($insert) {
  header("location: ../home.php");
} else {
  alert("Error, please try again later.");
}


 ?>
