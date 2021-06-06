<?php
include 'db.php';
if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM posts WHERE ID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
}


$location = "Location: index.php";
header($location);

 ?>
