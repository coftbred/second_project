<?php
include 'db.php';
if(isset($_GET['q'])) {
  $request = "%" . $_GET['q'] . "%";
  $sql = "SELECT * FROM posts WHERE post_title LIKE ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $request);
  $stmt->execute();
  $results = $stmt->get_result();
  if(isset($_GET['submit'])) {
    echo json_encode($results->fetch_all(MYSQLI_ASSOC));
  } else {
    echo $results->num_rows;
  }
}
 ?>
