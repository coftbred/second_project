<?php
include 'config.php';
include 'functions/postmanager.php';
include 'includes/header.php';
$results = $conn->query("SELECT * FROM posts ORDER BY date_created DESC LIMIT 12");
$rows = $results->fetch_all(MYSQLI_ASSOC);
 ?>

<style media="screen">
  .img-fluid {
    width: 300px;
  }
</style>

 <div class="jumbotron jumbotron-fluid">
   <div class="container front">
     <h1 class="display-3">Blog</h1>
     <p class="lead">Query the WordPress Database using MYSQLi</p>
     <form class="" action="search.php" method="post">
       <input type="text" name="search" class="search form-control mt-4 mb-4" placeholder="Search the database..." value="">
       <button type="submit" class="btn btn-outline-primary" name="submit">Search Database</button>

     </form>
     <div class="ajax-output">

     </div>
   </div>
 </div>
 <div class="container">
   <?php if (isset($_GET['login'])): ?>
     <div class="alert alert-success" role="alert">
       You have logged in successfully!
     </div>
   <?php elseif(isset($_GET['logout'])): ?>
   <div class="alert alert-warning" role="alert">
     You have logged out successfully!
   </div>
   <?php endif; ?>
 </div>
 <div class="container recent-articles">
   <h2 class="font-weight-light">Recent Articles</h2>
   <hr>
   <div class="row">
     <?php
     foreach ($rows as $row) {
       $post = filter_var(substr($row['post_body'],0, 55), FILTER_SANITIZE_STRING);
       echo "<div class='col-md-4'>
             <h3><a href='post.php?id={$row['ID']}'>{$row['post_title']}</a></h3>
             <img class='img-fluid' src='{$row['post_img']}' alt=''>
             <p>{$post}...</p></div>";
     }
      ?>


   </div>
 </div>



<script src="main.js" charset="utf-8"></script>


 <?php
 include 'includes/footer.php';
  ?>
