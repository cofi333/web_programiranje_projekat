<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body id="index_body">

    <nav class="navbar navbar_index navbar-expand-lg">
        <div class="container-fluid container">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 links">
              <li class="nav-item logo">
                <a class="nav-link" aria-current="page" href="#">createEvent</a>
              </li>
            </ul>

            <ul class="navbar-nav buttons">

                <?php
                session_start();
                require_once 'php/config.php';
                require_once 'php/functions.php';
                if (!isset($_SESSION['username']) OR !isset($_SESSION['id_user']) OR !is_int($_SESSION['id_user'])) {
                    echo '<li class="nav-item create_event_btn">';
                    echo '<a class="nav-link" href="./login.php">Create an event</a>';
                    echo '</li>';

                    echo '<li class="nav-item sign_up_btn">';
                    echo '<a class="nav-link" href="./sign_up.php">Sign Up</a>';
                    echo '</li>';

                    echo '<li class="nav-item log_in_btn">';
                    echo '<a class="nav-link" href="./login.php">Log in</a>';
                    echo '</li>';
                }

                else{
                    echo '<li class="nav-item create_event_btn">';
                    echo '<a class="nav-link" href="./event.php">Create an event</a>';
                    echo '</li>';
                    echo '</ul>';

                    echo '<div class="user">';
                    echo '<a href="user_profile.php"><img src="./images/user_image.png" id="user_image"></a>';
                    echo '</div>';
                }
                ?>


          </div>
        </div>
      </nav>

      <header>
          <img src="./images/index_background_image.png" alt="background">
      </header>

      <section class="events">
          <h2 class="index-header">New Events</h2>
          <div class="swiper mySwiper"> <!-- tbody -->
              <div class="swiper-wrapper"> <!-- tr -->
              </div>
          </div>

          <div class="swiper-buttons">
              <img id="leftClick" src="./images/iconLeft.svg" alt="leftClick">
              <img id="rightClick" src="./images/iconRight.svg" alt="rightClick">
          </div>
          <div class="swiper-pagination"></div>

      </section>

      <footer>
        <div class="container">
          <div class="row">
            <div class="categories col-md-9">
              <h6>createEvent.com</h6>
              <ul class="type">
                <li><a href="./event.php">Host your event</a></li>
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
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src=""></script>
<script src="./script/swiper.js"></script>


<script src="./script/fetchJSONFromServer.js"></script>
<script>
    fetchEventJSON();
</script>
</html>