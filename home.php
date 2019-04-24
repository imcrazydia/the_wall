<?php
//initialize the session
session_start();

//Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: log_sys/login.php");
  exit;
}
 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/jpeg" href="img/image.png">
    <title>Social Direct Messages</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

  <div id="navbar">
  <a class="active"><span>Home</span></a>
  <a href="#community"><span>Community</span></a>
  <a href="#search"><span>Search</span></a>
  <a href="post/uploadform.php"><span>Post</span></a>
  <a href="profile/profile.php"><span>Profile</span></a>
</div>
<br><br><br>

    <?php
 // Include the database configuration file
 include 'config/config.php';

 // Get images from the database
 $query = $pdo->query("SELECT i.*, u.id AS user_id, u.username, u.user_pic FROM images i LEFT JOIN users u ON u.id = i.user_id ORDER BY i.uploaded_on DESC");

 if($query->rowCount() > 0){
    while($row = $query->fetch()){
        $imageURL = 'uploads/'.$row["file_name"];

  $user_id = $row['user_id'];
  $prof_p = $row['user_pic'];
  $text = $row['post_text'];
  $title = $row['title'];
  $id = $row['id'];
 ?>
   <div class="post">
     <div class="username">
    <img id="profPic" src="profile/<?php echo $prof_p; ?>" />
    <span><?php echo htmlspecialchars($row['username']) ?></span>
  </div>
  <br>

  <img id="postPic" src="<?php echo $imageURL; ?>" />
      <h1><?php echo $title ?></h1>
      <p><?php echo $text ?></p>
      <br>
      <?php if ($user_id == $_SESSION['id']) {?>
      <!-- Delete button -->
        <a id="deleteButton" href="delete.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure ?')">Delete</a>
      <?php } ?>
      <!-- Favorite button -->
      <?php if ($user_id !== $_SESSION['id']) {?>
        <i class='fab'><a class="favIcon" href="profile/favorite.php?image_id=<?php echo $id ?>">&#xf184;</a></i>
      <?php } ?>
    <br><br>
  </div>
  <br>
 <?php }
 }else{ ?>
    <p>No image(s) found...</p>
 <?php } ?>

 <script>
 var prevScrollpos = window.pageYOffset;
 window.onscroll = function() {
 var currentScrollPos = window.pageYOffset;
   if (prevScrollpos > currentScrollPos) {
     document.getElementById("navbar").style.top = "0";
   } else {
     document.getElementById("navbar").style.top = "-50px";
   }
   prevScrollpos = currentScrollPos;
 }
 </script>
 <script src="js/search.js"></script>
</body>
</html>
