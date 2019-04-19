<?php
//initialize the session
session_start();

//Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../log_sys/login.php");
  exit;
}
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <meta name="author" content="Diaquino Fortmeier, MD1A">
     <link rel="stylesheet" href="../css/edit_profile.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" type="image/jpeg" href="../img/image.png">
     <title>Edit Profile</title>
   </head>
   <body lang="en">
     <form action="upload_edit_profile.php" method="post" enctype="multipart/form-data">
       <div class="website">
         <label>Website:</label><br>
         <input type="url" name="website">
       </div>
       <div class="bio">
         <label>Bio:</label><br>
         <input type="text" name="bio" maxlength="150">
       </div>
      <!-- <div class="img">
         <input type="file" accept="image/*" value="first image" name="file">
       </div>
       <div class="img">
         <input type="file" accept="image/*" value="second image" name="img2">
       </div>
       <div class="img">
         <input type="file" accept="image/*" value="third image" name="img3">
       </div> -->
        <input class="button" type="submit" name="submit" value="Upload">
     </form>
     <a class="button" href="profile.php">Back</a>
   </body>
 </html>
