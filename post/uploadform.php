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
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <div id="wrapper">
      <br>
    <input type="text" name="post_text" placeholder="Type your post here...">
    <br>
    <input type="file" accept="image/*" id="button2" name="file" onchange="preview_image(event)">
    <br>
    <img style="min-width:500px; max-width: 500px;" id="output_image"/>
    </div>
    <br>
    <input class="button" type="submit" name="submit" value="Upload">
  </form>
  <a class="button" href="../home.php">Back</a>
</body>

</html>
