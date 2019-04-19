<?php
session_start();
// Include the database configuration file
include '../config/config.php';
$statusMsg = '';
$id = $_SESSION['id'];

if (isset($_POST["submit"])) {
  $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
  $website = filter_var($_POST['website'], FILTER_SANITIZE_STRING);

  $update = $pdo->query("UPDATE users SET bio = '$bio', website = '$website' WHERE id = $id");
  if($update){
      sleep(3);
      header("location: profile_edit.php");
} else {
  $statusMsg = "There was a problem updating your info.";
 }
}

// Display status message
echo $statusMsg;
?>
