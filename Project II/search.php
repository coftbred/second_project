<?php
include 'db.php';
$num_rows = 0;
if(isset($_POST['submit'])) {
  $search = $_POST['search'];
  //#1 prepare statement
  $search_term = "%{$search}%";
  $stmt = $conn->prepare("SELECT ID, post_title, date_created, post_body FROM posts WHERE post_title LIKE ?");
  //#2 bind parameters
  $stmt->bind_param("s", $search_term);
  // #3 execute the Query
  $stmt->execute();
  // #4 get results
  $results = $stmt->get_result();
  // #5 fetch assoc array from results
  $num_rows = $results->num_rows;
  $rows = $results->fetch_all(MYSQLI_ASSOC);
}
include 'includes/header.php';
 ?>

      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-3">Number of Results: <?php echo $num_rows; ?> </h1>
          <p class="lead">Search again...</p>
          <form class="" action="search.php" method="post">
            <input type="text" name="search" class="form-control mt-4 mb-4" placeholder="Search the database..." value="">
            <button type="submit" class="btn btn-outline-primary" name="submit">Search Database</button>
          </form>
        </div>
      </div>
      <div class="container front recent-articles">
        <div class="row">

          <?php

          if($num_rows == 0) {
            echo "<h3 class='mb-5'>No results found try again....</h3>";
          } else {
           foreach ($rows as $row) {
             $post = filter_var(substr($row['post_content'],0, 55), FILTER_SANITIZE_STRING);
             echo "<div class='col-md-6'>
                   <h3><a href='article.php?id={$row['ID']}'>{$row['post_title']}</a></h3>
                   <p>{$post}...</p></div>";
           }
         }

        ?>


        </div>
      </div>

<?php include 'includes/footer.php'; ?>
