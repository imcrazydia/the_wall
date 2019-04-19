<?php
//initialize the session
session_start();

//Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../log_sys/login.php");
  exit;
}
 ?> <!-- Problemen: Als ik in upload_edit_profile.php $bio en $website wil updaten dan lukt het,
    maar wanneer ik er maar 1 invul dan wordt de andere leeg gemaakt omdat ik hem update met niks erin.
     En ander probleem is dat als iemands bio te lang is moet je naar links scrollen en ik wil dat het na een aantal char. onder elkaar komt te staan. ) -->

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Diaquino Fortmeier, MD1A">
    <link rel="icon" type="image/jpeg" href="../img/image.png">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
  <div class="profile_head">
    <br>
    <?php
 // Include the database configuration file
 include '../config/config.php';

 $query = $pdo->query("SELECT * FROM users");

if($query->rowCount() > 0){
   while($row = $query->fetch()){

  $id = $row['id'];
?>
   <?php if ($id == $_SESSION['id']) {
     $user_pic = $row["user_pic"];
     $username = htmlspecialchars($row['username']);
     $bio = htmlspecialchars($row['bio']);
     $website = htmlspecialchars($row['website']); ?>
     <!-- Icon and Title of page -->
     <head>
       <title><?php echo $username ?> - Profile</title>
     </head>
     <!-- End Icon and Title of page -->

     <!-- Profiel Picture, Username and edit profile button-->
     <i class='fas'><a class="returnIcon" href="../home.php">&#xf3e5;</a></i>
     <i class='fas'><a class="settingIcon" href="profile_edit.php">&#xf013;</a></i>
    <img class="prof_pic" src="<?php echo $user_pic ?>" width="81" height="auto" />
    <div class="prof_info">
    <h2><b><?php echo $username ?></b></h2>
    <div class="bio">
    <h3><?php echo $bio ?></h3>
  </div>
    <a href="<?php echo $website ?>" target="_blank"><?php echo $website ?></a>
    <?php } ?>
  <?php }
} ?>
</div>
<!-- END Profiel Picture and Username -->
</div>
<!-- END Profiel head -->

<!-- Own Posts and Favorited Posts -->
<div class="backNav">
<div class="nav">
  <button class="navLinks" onclick="openPost(event, 'own')" >Own</button>
  <button class="navLinks" onclick="openPost(event, 'favorite')" >Favorite</button>
</div>
</div>

<div id="own" class="navContent">
<?php
$query = $pdo->query("SELECT * FROM images ORDER BY uploaded_on DESC");

if($query->rowCount() > 0){
  while($row = $query->fetch()){

 $imageURL = '../uploads/'.$row["file_name"];
 $user_id = $row['user_id'];
?>
  <?php if ($user_id == $_SESSION['id']) {?>
    <div class="photo">
     <img src="<?php echo $imageURL; ?>" width="300" height="300" />
    </div>
   <?php } ?>
 <?php }
} ?>
</div>

<div id="favorite" class="navContent">
  <h3>Favorite Posts</h3>
</div>

<script>
function openPost(evt, navName) {
var i, navContent, navLinks;
navContent = document.getElementsByClassName("navContent");
for (i = 0; i < navContent.length; i++) {
navContent[i].style.display = "none";
}
navLinks = document.getElementsByClassName("navLinks");
for (i = 0; i < navLinks.length; i++) {
navLinks[i].className = navLinks[i].className.replace(" active", "");
}
document.getElementById(navName).style.display = "block";
evt.currentTarget.className += " active";
}
</script>
</body>
</html>
