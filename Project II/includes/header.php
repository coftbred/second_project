<!doctype html>
<html lang="en">
  <head>
    <title>Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="/your-path-to-fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="/your-path-to-fontawesome/css/brands.css" rel="stylesheet">
    <link href="/your-path-to-fontawesome/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <!-- fixed-top | sticky-top | fixed-bottom -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php"><i class="fas fa-pen"></i> Create Post</a>
                    </li>
                </ul>
                <ul class="navbar-nav float-right">
                  <?php if ($_SESSION['loggedin'] == true): ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="user.php"><i class="fa fa-user"></i> Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?> | <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="logout.php"><i class="fa fa-door"></i>Logout<span class="sr-only">(current)</span></a>
                    </li>
                  <?php else: ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="login.php"><i class="fa fa-user"></i>Login<span class="sr-only">(current)</span></a>
                    </li>
                  <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
