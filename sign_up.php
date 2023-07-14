<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Sign Up</title>
</head>
<body id="sign_up_body">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid  container">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 links">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Home</a>
                </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">Music</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Nightlife</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Culture</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Food</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Sport</a>
              </li>
            </ul>

            <ul class="navbar-nav buttons">
                <li class="nav-item create_event_btn">
                    <a class="nav-link" href="#">Create an event</a>
                </li>
                <li class="nav-item sign_up_btn">
                    <a class="nav-link" href="#">Sign up</a>
                </li>
                <li class="nav-item log_in_btn">
                    <a class="nav-link" href="login.php">Log in</a>
                </li>
            </ul>
           
          </div>
        </div>
      </nav>

      <section class="hero_sign_up container">
          <?php
          require_once './php/config.php';
          $r = 0;

          if (isset($_GET["r"]) and is_numeric($_GET['r'])) {
              $r = (int)$_GET["r"];

              if (array_key_exists($r, $messages)) {
                  echo '
                    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                        ' . $messages[$r] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
              }
          }
          ?>
        <div class="content">
          <div class="picture">
            <img src="./images/microphone.png" alt="Microphone picture">
          </div>

          <div class="form">
            <form action="./php/registration.php" method="post" id="form">



              <div class="form-group">
                  <p class="error" id="error-messages"></p>
                <label for="name">Name</label>
                <input  type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Your name">
                  <span class="error" id="name-error"></span>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Your email">
                  <span class="error" id="mail-error"></span>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Your password">
                  <span class="error" id="password-error"></span>
              </div>
              <div class="form-group">
                <label for="repeat-password">Repeat password</label>
                <input type="password" class="form-control" id="repeated-password" name="repeat-password" placeholder="Repeat your password">
                  <span class="error" id="repeat-password-error"></span>
              </div>
             
              <div class="sign_up">
                <input type="submit" name="btnSubmit" class="btn" />
              </div>

              <div class="log_in">
                <span>You have an account?</span>
                <a href="login.php">Log in</a>
              </div>

            </form>
          </div>


        </div>


      </section>

      <footer>
        <div class="container">
          <div class="row">
            <div class="categories col-md-9">
              <h6>Categories</h6>
              <ul class="type">
                <li><a href="#">Music</a></li>
                <li><a href="#">Nightlife</a></li>
                <li><a href="#">Culture</a></li>
                <li><a href="#">Food</a></li>
                <li><a href="#">Sport</a></li>
              </ul>
            </div>
            
            <div class="social-medias col-md-3">
              <h6>Follow us</h6>
              <div class="icons">
                <a href="#"><img src="./images/facebook_icon.png" alt="Facebook"></a>
                <a href="#"><img src="./images/twitter_icon.png" alt="Twitter"></a>
                <a href="#"><img src="./images/instagram_icon.png" alt="Instagram"></a>
              </div>
            </div>
          </div>
        </div>
      </footer>


      <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <script src="script/registrationValidateForm.js"></script>
</body>



</html>