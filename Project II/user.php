<?php
include 'config.php';
 $num_rows = 0;
 if(isset($_GET['id'])) {
   $author = $_GET['id'];
   $sql = "SELECT u.id AS author_id, p.ID, p.date_created, p.post_title, p.post_body, u.name
   FROM posts p
   JOIN users u ON u.id = p.post_author
   WHERE u.id = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("i", $author);
   $stmt->execute();
   $result = $stmt->get_result();

   if($result->num_rows != 0) {
     $num_rows = $result->num_rows;
     $rows = $result->fetch_all(MYSQLI_ASSOC);
     $author = $rows[0]['name'];
   }
 } else {
   //output error - article not found
 }
 include 'includes/header.php';
  ?>
<style media="screen">
.jumbotron {
  text-align-last: center;
}
</style>
       <div class="jumbotron jumbotron-fluid article">
         <div class="container">
           <button type="button" class="btn btn-outline-light"><a href='index.php'> < Back</a></button>
           <?php if ($num_rows != 0): ?>
             <div class="jumbotron">
               <h3 class="display-5"><?php echo $author; ?></h3>
               <img src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png" alt="">
             </div>
           <?php else: ?>
             <h1>Author not found!</h1>
           <?php endif; ?>

         </div>
       </div>
       <div class="container recent-articles">
         <div class="row">
           <?php
           if($num_rows == 0) {
             echo "<h3 class='mb-5'>No results found try again....</h3>";
           } else {
            foreach ($rows as $row) {
              $post = filter_var(substr($row['post_body'],0, 55), FILTER_SANITIZE_STRING);
              echo "<div class='col-md-6'>
                    <h3><a href='post.php?id={$row['ID']}'>{$row['post_title']}</a></h3>
                    <p>{$post}...</p></div>";
            }
          }
            ?>


         </div>
       </div>



<?php
include 'includes/footer.php';
?>
