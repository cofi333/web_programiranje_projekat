<?php
session_start();
require_once 'php/config.php';
require_once 'php/functions.php';
if (!isset($_SESSION['username']) OR !isset($_SESSION['id_user']) OR !is_int($_SESSION['id_user'])) {
    redirection('index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Create event</title>
</head>
<body id="create_event_page">
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



                    <div class="user">
                        <a href="user_profile.php"><img src="./images/user_image.png" id="user_image"></a>
                    </div>

                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="container basic-info">
            <form action="./php/create-event.php" method="post">
                <div class="row">
                    <div class="bi-info col-md-12">
                        <h1>Basic info</h1>
                        <p>Name your event and tell event-goers why they should come. Add details that highlight what makes it unique.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="bi-input">
                        <div class="mb-3">
                            <label for="event-title" class="form-label">Event title</label>
                            <input type="text" class="form-control" name="event-title" id="event-title">
                        </div>

                        <div class="mb-3">
                            <label for="organizer" class="form-label">Organizer</label>
                            <input type="text" class="form-control" name="event-organizer" id="organizer">
                        </div>
                    </div>
                </div>

                <div class="row event_type">
                    <div class="col-md-3">
                        <select class="form-select" name="event-category" aria-label="Default select example">
                            <option selected>Category</option>
                           <?php

                            $sql = "SELECT ec_id,category FROM event_category";
                            $q = $pdo -> query($sql);
                            $q -> setFetchMode(PDO::FETCH_ASSOC);

                            while($row = $q -> fetch()) {
                           ?>
                            <option value="<?php echo ($row['ec_id'])?>"><?php echo htmlspecialchars($row['category'])?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="location">
                    <h1>Location</h1>
                    <p>Help people in the area discover your event and let attendees know where to show up.</p>

                    <div class="row">
                        <div class="col-md-2">
                            <button type="button" id="venue_button" class="location_buttons btn">Venue</button>
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="online_button" class="location_buttons btn"">Online event</button>
                        </div>
                    </div>

                    <div id="location_input_venue">
                        <label for="organizer" class="form-label">Venue location</label>
                        <input type="text" class="form-control" id="venue_location" name="venue-location">
                    </div>

                    <div id="location_input_online">
                        <label for="organizer" class="form-label">Online event</label>
                        <input type="text" class="form-control" id="online_location" name="online-location">
                    </div>

                </div>

                <div class="date_time">
                    <h1>Date and time</h1>
                    <p>Tell event-goers when your event starts and ends so they can make plans to attend.</p>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="organizer" class="form-label">Date</label>
                            <input type="text" class="form-control" name="event-date" placeholder="YYYY-MM-DD">
                        </div>
                        <div class="col-md-6">
                            <label for="organizer" class="form-label">Time</label>
                            <input type="text" class="form-control" name="event-time" placeholder="HH:MM:SS">
                        </div>
                    </div>
                </div>

                <div class="description">
                    <h1>Description</h1>
                    <p>Please describe more about your event.</p>

                    <label for="organizer" class="form-label">Description</label>
                    <input type="text" class="form-control" name="event-description">
                </div>

                <div class="sign_up">
                    <input type="submit" name="btnSubmit" class="btn" value="Save & continue"/>
                </div>
            </form>
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



      <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="./script/eventLocation.js"></script>
</body>
</html>