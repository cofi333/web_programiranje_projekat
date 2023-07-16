<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body id="login_body">
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
                    <a class="nav-link" href="sign_up.php">Create an event</a>
                </li>
                <li class="nav-item sign_up_btn">
                    <a class="nav-link" href="sign_up.php">Sign up</a>
                </li>
                <li class="nav-item log_in_btn">
                    <a class="nav-link" href="#">Log in</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

    <main>
        <section class="hero-login">
            <?php
            require_once './php/config.php';

            $l = 0;

            if (isset($_GET["l"]) and is_numeric($_GET['l'])) {
                $l = (int)$_GET["l"];

                if (array_key_exists($l, $messages)) {
                    echo '
                    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                        ' . $messages[$l] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
                }
            }
            ?>
        </section>
        <section class="login container d-flex justify-content-center gap-2">
            <div class="loginPic">
                <img src="./images/people.png" alt="peoplepng">
            </div>
            <form id="login-form" action="php/login_data.php" method="post">

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <p id="emailError"></p>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                  <p id="passwordError"></p>
                </div>
                <button type="submit" class="btn btn-primary">Log In</button>

                <span id="forgot-password">Forgot password?</span>
                <p>Don't have an account? <a href="./sign_up.php">Sing Up</a></p>
              </form>


            <div class="form" id="forgot_password_form">

                <form action="php/reset-password.php" method="post" id="forget-form">
                    <div class="form-group">
                        <label for="email-forgot">Email</label>
                        <input type="email" class="form-control" id="email-forgot" name="email-forgot" aria-describedby="emailHelp" placeholder="Your email">
                    </div>

                    <button type="submit" class="btn btn-primary">Reset password</button>
                </form>
            </div>
        </section>
    </main>

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
    <script src="./script/forgotPassword.js"></script>
    <script src="script/loginValidateForm.js"></script>
</body>
</html>