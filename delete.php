<?php

 require_once "config/config.php";

 if(isset($_GET['delete_id']))
 {
  // select image from db to delete
  $stmt_select = $pdo->prepare('SELECT file_name FROM images WHERE id =:id');
  $stmt_select->execute(array(':id'=>$_GET['delete_id']));
  $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
  unlink("uploads/".$imgRow['file_name']);

  // it will delete an actual record from db
  $stmt_delete = $pdo->prepare('DELETE FROM images WHERE id =:id');
  $stmt_delete->bindParam(':id',$_GET['delete_id']);
  $stmt_delete->execute();

  $stmt_delete = $pdo->prepare('DELETE FROM image_tags WHERE image_id =:id');
  $stmt_delete->bindParam(':id',$_GET['delete_id']);
  $stmt_delete->execute();

  header("Location: home.php");
 }

?>
