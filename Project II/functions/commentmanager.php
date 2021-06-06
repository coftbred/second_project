<?php
if(isset($_POST['delete'])) {
  session_start();
  deleteComment($_POST['delete']);
}



if(isset($_POST['comment'])) {
  $errors = [];
  include_once '../config.php';
  if(!isset($_SESSION['user_id'])) {
    $errors['userid'] = "User id not set";
  }
  if(!isset($_POST['id'])) {
    $errors['postid'] = "post id not set";
  }
  else {
    $queryIDCount = 3;
    $queryStrPos = strpos($_SESSION['query_history'][$queryIDCount],"id");
    $queryId = substr($_SESSION['query_history'][$queryIDCount],$queryStrPos);
    $queryId = explode("=", $queryId);
    if($queryId[1] != $_POST['id']) {
      $errors['queryid'] = "query id doesnt equal post id";
    }
  }

  if(empty($errors)) {
    $sql = "INSERT INTO comments (comment_text, comment_user, comment_post) VALUE (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $_POST['comment'], $_SESSION['user_id'], $_POST['id']);
    $stmt->execute();
    if($stmt->affected_rows == 1) {
      $id = $stmt->insert_id;
      $sql = "SELECT cm.ID, cm.comment_text, u.user_name, cm.date_created FROM comments cm JOIN users u ON u.id = cm.comment_user WHERE cm.ID = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      echo json_encode($result->fetch_assoc());
    } else {
      echo json_encode($errors);
    }
  }

}

function addComment($postid, $conn) {
  $sql = "INSERT INTO comments (comment_text)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_POST["comment_text"]);
  $stmt->execute();
  $results = $stmt->get_result();
  return $results->fetch_all(MYSQLI_ASSOC);
}

function getComments($postid, $conn) {
  $sql = "SELECT cm.ID, cm.comment_text, u.name, cm.date_created FROM comments cm JOIN users u ON u.ID = cm.comment_user JOIN posts ON posts.ID = cm.comment_post WHERE posts.ID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $postid);
  $stmt->execute();
  $results = $stmt->get_result();
  return $results->fetch_all(MYSQLI_ASSOC);
}

function outputComments($comments) {
  $output = '';
  foreach ($comments as $comment) {
    $output .= "<div class='card mt-2 mb-2'><div class='card-header'> {$comment['user_name']} | {$comment['date_created']} <a href='func/commentmanager.pgp?id={$comment['ID']}'><button type='button' class='btn delete-post btn-outline-danger btn-sm  float-right'>X</button></a></div><div class='card-body'><p class='card-text'>{$comment['comment_text']} </p></div></div>";
  }
  echo $output;
}


function deleteComment($id) {
  $sql = "DELETE FROM comments WHERE ID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  echo $stmt->affected_rows;
}
 ?>
