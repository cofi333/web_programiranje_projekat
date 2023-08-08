<?php
session_start();

require_once './php/config.php';
if(isset($_GET['id'])){
    $event_id = $_GET['id'];
    $_SESSION['event_id'] = $event_id;
} else{
    redirection('index.php');
    exit();
}

try {
    $sql = "SELECT * FROM events WHERE event_id = " . $event_id;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    throw new \PDOException($e->getMessage());
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css">
    <title>Event Page</title>
</head>
<body id="event_page">
<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 links">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">Home</a>
                </ul>

                <ul class="navbar-nav buttons">

                    <?php
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
</header>

<section class="about_event container">
    <h2><?php echo $result['event_title'] ?></h2>
    <p><?php echo $result['event_description']?></p>
    <div class="event_date">
        <h2>Date:</h2>
        <p><?php echo $result['event_date']?></p>
    </div>
    <div class="event_time">
        <h2>Time:</h2>
        <p><?php echo $result['event_time']?></p>
    </div>
    <div class="event_location">
        <h2>Location:</h2>
        <p><?php echo $result['event_location']?></p>
    </div>
</section>

<section class="event_comments">

    <div class="container">
        <div class="swiper-comments">
            <div class="swiper-wrapper">
                <h2 class="invitation-header">When the event is over, check out guest comments!</h2>
            </div>
            <div class="swiper-buttons">
                <img id="leftClick" src="./images/iconLeft.svg" alt="leftclick">
                <img id="rightClick" src="./images/iconRight.svg" alt="rightClick">
            </div>
            <div class="swiper-pagination"></div>
        </div>


    </div>


</section>

<footer id="user-footer">
    <div class="container">
        <div class="row">
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
<script src="./script/swiper.js"></script>
<script src="./script/fetchJSONFromServer.js"></script>
<script src="https://kit.fontawesome.com/ac55437ec8.js" crossorigin="anonymous"></script>
<script>
    fetchComments();
</script>
</html>


