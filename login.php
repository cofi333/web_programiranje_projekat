<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body id="login_body">
    <header>
        <nav class="navbar navbar-expand-lg container">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 links">
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
                        <a class="nav-link" href="./sign_up.php">Sign up</a>
                    </li>
                    <li class="nav-item log_in_btn">
                        <a class="nav-link" href="#">Log in</a>
                    </li>
                </ul>
               
              </div>
            </div>
          </nav>
    </header>

    <main>
        <section class="login">
            <div class="loginPic">
                <img src="./images/people.png" alt="peoplepng">
            </div>
            <form id="login-form" action="php/login_data.php" method="post">
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
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Log In</button>
        
                <p>Don't have an account? <a href="./sign_up.php">Sing Up</a></p>
              </form>
        </section>
    </main>
    
    <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.min.js"></script>
</body>
</html>