<?php
//initialize the session
session_start();

//Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../log_sys/login.php");
  exit;
}
 ?>

<html>

<head>
  <meta charset="utf-8">
  <title>Upload</title>
  <meta name="author" content="Diaquino Fortmeier, MD1A">
  <link rel="stylesheet" href="../css/upload.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type='text/javascript'>
function preview_image(event)
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>
</head>

<body>
  <div id="navbar">
  <a href="../home.php"><span>Home</span></a>
  <a href="#community"><span>Community</span></a>
  <a href="#search"><span>Search</span></a>
  <a class="active"><span>Post</span></a>
  <a href="../profile/profile.php"><span>Profile</span></a>
</div>
<br><br>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <div id="wrapper">
      <br><br>
      <input type="text" name="title" placeholder="Type your title here...">
      <br><br>
      <input type="text" name="post_text" placeholder="Type your post here...">
      <br><br>
    <input type="text" name="tags" id="tagField" placeholder="Tags here , comma separated">
    <br><br>
    <input type="file" accept="image/*" id="button2" name="file" onchange="preview_image(event)">
    <br>
    <img id="output_image"/>
    </div>
    <br>
    <input class="button" type="submit" name="submit" value="Upload">
  </form>
</body>

</html>
