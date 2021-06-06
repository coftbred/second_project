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
  .social-login {
    margin: 10px;
  }
  p.error {
    color: red;
   font-style: italic;
  }
</style>

<div class="container">
  <?php if (isset($errorMsg)): ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $errorMsg; ?>
    </div>
  <?php endif; ?>
  <div class="row">
    <div class="col-md-7">
      <div class="img-fluid">
          <img src="https://preview.colorlib.com/theme/bootstrap/login-form-07/images/undraw_remotely_2j6y.svg" alt="">
      </div>
    </div>
    <div class="col-md-5 mt-5 signin">
      <h3>Sign in</h3>
      <form action="" method="POST">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="username">Username</label>
            <input type="text" name="name" class="form-control" placeholder="" value="<?php if (isset($name)) { echo htmlspecialchars($name);} ?>">
            <p class="error"><?php if(isset($errors['login_username'])) {echo $errors['login_username'];} ?></p>
          </div>
          <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="" value="">
            <p class="error"><?php if(isset($errors['login_password'])) {echo $errors['login_password'];} ?></p>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
        <hr>
        <a href="createAcc.php"> <button type="button" class="btn btn-success btn-block mb-2" name="button">Create Account</button> </a>
        -Or login with-
      <div class="social-login">
        <a href="#" class="facebook mr-2"><i class="fab fa-facebook"></i></a>
        <a href="#" class="twitter mr-2"><i class="fab fa-twitter"></i></a>
        <a href="#" class="google"><i class="fab fa-google"></i></a>
      </div>
      </form>
    </div>
  </div>
</div>

 <?php
 include 'includes/footer.php'
  ?>
