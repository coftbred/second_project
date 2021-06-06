<?php
include_once 'config.php';
include 'functions/postmanager.php';
include 'functions/commentmanager.php';
include 'includes/header.php';
if(isset($_GET['id'])) {
  $post = getPost($_GET['id'], $conn);
  $theid = $_GET['id'];
  $comments = getComments($theid, $conn);
  $sql = "SELECT post_title, post_img, post_body, posts.date_created, users.name, users.id AS author_id, posts.ID FROM posts JOIN users ON users.ID = posts.post_author WHERE posts.ID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $_GET['id']);
  $stmt->execute();
  $results = $stmt->get_result();
  if($results->num_rows == 1) {
    $row = $results->fetch_assoc();
    $title = $row['post_title'];
    $body = $row['post_body'];
    $author_id = $row['author_id'];
    $author = $row['name'];
    $date = $row['date_created'];
    $img = $row['post_img'];
  } else {
    $errorMsg = "Post not found!";
  }
}

 ?>

<style media="screen">
h1 {
  color: red;
  font-style: oblique;
  font-weight: lighter;
}
</style>

 <hr>
 <div class="container post">
   <div class="row">
     <?php if ($post == false): ?>
       <h2 class="display-4">404 Post Not Found!</h2>
      </div>
     <?php else: ?>
       <div class="col-md-8 offset-md-2">
         <p class="lead">
           Author: <a href="user.php?id=<?php echo htmlspecialchars($author_id); ?>">
           <?php echo htmlspecialchars($author); ?>
           </a>
         </p>
          <img src="<?php echo $post['post_img']; ?>" class="img-fluid" alt="">

          <h2 class="font-weight-light mt-4"><?php echo htmlspecialchars($post['post_title']); ?></h2>

          <h5><em><?php echo htmlspecialchars($post['date_created']); ?>
          </em></h5>
           <p><?php echo htmlspecialchars($post['post_body']);?></p>
           <?php if ($author == 1 || $_SESSION['user_id'] == $author_id) : ?>
          <button type="button" class=" mt-5 btn btn-outline-danger" name="button"> <a href="delete.php?id=<?php echo $row['ID']; ?>"> <i class="fa fa-delete"></i> Delete Post</a></button>
           <?php else: ?>
             <h1>just Read because you're not author or admin</h1>
            <?php endif; ?>
            <?php if ($author == 1 || $_SESSION['user_id'] == $author_id) : ?>
           <button type="button" class=" mt-5 btn btn-outline-warning" name="button"> <a href="edit.php?id=<?php echo $row['ID']; ?>"> <i class="fa fa-delete"></i> Edit Post</a></button>
            <?php else: ?>

             <?php endif; ?>
       </div>
     </div> <!-- end of post row -->

     <!-- comment row -->
      <hr>
      <h3 class="display-4 mt-3 mb-3">Comments</h3>
      <hr>
     <div class="row comments">

       <div class="col-md-8 form">
         <?php if ($_SESSION['loggedin']): ?>
           <form class="comment-form" method="POST" action="functions/commentmanager.php">
             <textarea name="comment" class="form-control" rows="4" cols="80"></textarea>
             <input type="hidden" name="id" value="<?php echo htmlspecialchars($_SERVER['QUERY_STRING']); ?>">
             <button type="submit" name="comment-submit" class="btn btn-outline-success mt-2"><i class="far fa-comment"></i> Add Comment</button>
           </form>
         <?php else: ?>
           <h3>Please login to comment!</h3>
           <a href="login.php"><button type="button" class="btn btn-primary btn-lg">Login</button></a>
         <?php endif; ?>

       </div>


     </div>
     <?php

       outputComments($comments);
      ?>
     <?php endif; ?>

 </div>

 <hr>
 <?php
 $queryIDCount = count($_SESSION['query_history']) -2;
 $queryStrPos = strpos($_SESSION['query_history'][$queryIDCount],"id");
 $queryId = substr($_SESSION['query_history'][$queryIDCount],$queryStrPos);
 $queryId = explode("=", $queryId);
 include 'includes/footer.php';
  ?>
