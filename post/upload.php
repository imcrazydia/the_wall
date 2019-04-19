<?php
session_start();
// Include the database configuration file
include '../config/config.php';
$statusMsg = '';

// File upload path
$targetDir = "../uploads/";
$fileType = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
$fileName = uniqid().".".$fileType;
$targetFilePath = $targetDir . $fileName;

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
  $post_text = filter_var($_POST['post_text'], FILTER_SANITIZE_STRING);
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $statement = $pdo->prepare("INSERT into images (file_name, uploaded_on, user_id, post_text) VALUES (?, NOW(), ?, ?)");

            $data = array(
              $fileName,
              $_SESSION['id'],
              $post_text
            );
            $insert = $statement->execute($data);
            if($insert){
                header("location: ../home.php");
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
