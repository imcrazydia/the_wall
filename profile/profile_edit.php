<?php
//initialize the session
session_start();

include '../config/config.php';

//Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../log_sys/login.php");
  exit;
}

 $query = $pdo->query("SELECT * FROM users");

 while($row = $query->fetch()){

 $website = $row['website'];
 $bio = $row['bio'];
 $user_pic = $row['user_pic'];
  $user_id = $row['id'];
 ?>
<?php if ($user_id == $_SESSION['id']) {?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <meta name="author" content="Diaquino Fortmeier, MD1A">
     <link rel="stylesheet" href="../css/edit_profile.css">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" type="image/jpeg" href="../img/image.png">
     <title>Edit Profile</title>
   </head>
   <body lang="en">
     <br>
     <i class='fas'><a class="returnIcon" href="profile.php">&#xf3e5;</a></i>
     <img class="prof_pic" src="<?php echo $user_pic ?>" width="81" height="auto" />
     <br>
     <a id="changeProfPic" href="profile_picform.php">Change profile picture</a>
     <br><br>
     <form action="upload_edit_profile.php" method="post" enctype="multipart/form-data">
       <div class="website">
         <label>Website:</label><br>
         <input type="url" name="website" value="<?php echo $website ?>">
       </div>
       <div class="bio">
         <label>Bio:</label><br>
         <input type="text" name="bio" value="<?php echo $bio ?>" maxlength="150">
       </div>
       <br>
        <input class="button" type="submit" name="submit" value="Upload">
     </form>
     <?php } ?>
   <?php } ?>
   </body>
 </html>
