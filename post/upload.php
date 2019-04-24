<?php
session_start();
// Include the database configuration file
include '../config/config.php';
include "../functions.php";
$statusMsg = '';

// File upload path
$targetDir = "../uploads/";
$fileType = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
$fileName = uniqid().".".$fileType;
$targetFilePath = $targetDir . $fileName;

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
  $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
  $post_text = filter_var($_POST['post_text'], FILTER_SANITIZE_STRING);
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $statement = $pdo->prepare("INSERT into images (file_name, uploaded_on, user_id, post_text, title) VALUES (?, NOW(), ?, ?, ?)");

            $data = array(
              $fileName,
              $_SESSION['id'],
              $post_text,
              $title
            );
            $insert = $statement->execute($data);
            $image_id = $pdo->lastInsertId();
            if($insert){
              $tags = seperateTags($_POST['tags']);

              if (!empty($tags)) {
                foreach ($tags as $tag) {
        $tag_id = 0;
        $sql = 'SELECT * FROM tags WHERE tag = ?';
        $statement = $pdo->prepare($sql);
        $data = [
            $tag
        ];
        $statement->execute($data);
        if($row = $statement->fetch()){
           $tag_id = $row['id'];
        }else{
            $sql = 'INSERT INTO tags (tag) VALUES (?)';
            $statement = $pdo->prepare($sql);
            $statement->execute($data);
            $tag_id = $pdo->lastInsertId();
        }
        $sql = 'REPLACE INTO image_tags (image_id, tag_id) VALUES (?,?)';
        $statement = $pdo->prepare($sql);
        $statement->execute([$image_id, $tag_id]);
           }
           header("location: ../home.php");
              }
            }else{
                $statusMsg = "File upload failed, please try again.";
            }
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
?>
