<?php
include 'config.php';
include 'includes/header.php';
include 'functions/account.php';
 ?>
 <style media="screen">
   form {
    box-shadow: 1px 2px 5px grey;
    padding: 20px;
   }
   p.error {
     color: red;
     font-style: italic;
    margin-top: 5px;
   }
 </style>

<div class="container">
    <h1 class="display-3">Create a new account!!!</h1>
    <?php if (isset($errorMsg)): ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $errorMsg; ?>
    </div>
  <?php endif; ?>
    <hr>
    <div class="row">
      <div class="col-md-6">
        <form class="" action="createAcc.php" method="post">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control" placeholder="Input your username..." value="<?php if (isset($username)) {
          echo htmlspecialchars($username);}?>">
          <p class="error"><?php if(isset($errors['create_username'])) {echo $errors['create_username'];} ?></p>
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" placeholder="Input your email..." value="<?php if (isset($email)) { echo htmlspecialchars($email);} ?>">
          <p class="error"><?php if(isset($errors['create_email'])) { echo $errors['create_email'];} ?></p>
          <label for="password1">Password</label>
          <input type="password" name="password1" class="form-control" placeholder="Input your password..."value="">
          <p class="error"></p>
          <label for="password2">Confirm Password</label>
          <input type="password" name="password2" class="form-control" placeholder="confirm your password..."value="">
          <p class="error"><?php if(isset($errors['create_password'])) { echo $errors['create_password'];} ?></p>
          <hr>
          <button type="submit" name="create" class="btn btn-outline-success">Create Account</button>

        </form>
      </div>
      <div class="col-md-6">
        <img src="https://worldofweirdthings.com/wp-content/uploads/false_relaxation_1200-600x450.jpg" alt="">
      </div>
    </div>

</div>


 <?php
 include 'includes/footer.php'
  ?>
