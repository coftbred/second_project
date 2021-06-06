<?php
include 'db.php';
include 'functions/account.php';
if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "UPDATE posts SET post_title = ?, post_body = ?, post_author = ? WHERE ID = $id";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssi",  $title, $body, $_SESSION['user_id']);
  $stmt->execute();
}
 ?>
