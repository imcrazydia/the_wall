<?php
session_start();
// Include the database configuration file
include '../config/config.php';

$query = $pdo->query("INSERT into favorite (file_name, uploaded_on, user_id, post_text)
SELECT file_name, uploaded_on, user_id, post_text FROM images i LEFT JOIN users u ON u.id = i.user_id");

if ($query) {
  header("location: ../home.php");
} else {
  alert("Error, please try again later.");
}


 ?>
