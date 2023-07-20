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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/style.css">
    <title>Create event</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body id="create_event_page">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 links">
                        <li class="nav-item logo">
                            <a class="nav-link" aria-current="page" href="index.php">createEvent</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav buttons">
                        <li class="nav-item create_event_btn">
                            <a class="nav-link" href="#">Create an event</a>
                        </li>
                    </ul>

                    <div class="user">
                        <a href="user_profile.php"><img src="./images/user_image.png" id="user_image" alt="user-profile"></a>
                    </div>
                </div>
            </div>
        </nav>

    <main>
        <section class="container basic-info">
            <?php
            require_once './php/config.php';
            $e = 0;

            if (isset($_GET["e"]) and is_numeric($_GET['e'])) {
                $e = (int)$_GET["e"];

                if (array_key_exists($e, $messages)) {
                    echo '
                    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                        ' . $messages[$e] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
                }
            }

            if(isset($_SESSION['event_errors'])) {
                foreach($_SESSION['event_errors'] as $value) {
                    echo '
                    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                        ' . $value . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
                }

                unset($_SESSION['event_errors']);
            }

            ?>
            <form action="./php/create-event.php" method="post" id="form">
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
                            <span class="error" id="event-title_error"></span>
                        </div>

                        <div class="mb-3">
                            <label for="organizer" class="form-label">Organizer</label>
                            <input type="text" class="form-control" name="event-organizer" id="event-organizer">
                            <span class="error" id="event-organizer_error"></span>
                        </div>
                    </div>
                </div>

                <div class="row event_type">
                    <div class="col-md-3">
                        <select class="form-select" name="event-category" id="event-category" aria-label="Default select example">
                            <option selected value="default">Category</option>
                           <?php

                            $sql = "SELECT ec_id,category FROM event_category";
                            $q = $pdo -> query($sql);
                            $q -> setFetchMode(PDO::FETCH_ASSOC);

                            while($row = $q -> fetch()) {
                           ?>
                            <option value="<?php echo ($row['ec_id'])?>"><?php echo htmlspecialchars($row['category'])?></option>
                            <?php } ?>
                        </select>
                        <span class="error" id="event-category_error"></span>
                    </div>
                </div>

                <div class="location">
                    <h1>Location</h1>
                    <p>Help people in the area discover your event and let attendees know where to show up.</p>



                    <div id="location_input">
                        <label for="event-location" id="location_input_label" class="form-label">Location</label>
                        <input type="text" class="form-control" id="event-location" name="event-location">
                    </div>

                    <span class="error" id="event-location_error"></span>

                </div>

                <div class="date_time">
                    <h1>Date and time</h1>
                    <p>Tell event-goers when your event starts and ends, so they can make plans to attend.</p>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="organizer" class="form-label">Date</label>
                            <input type="date" id="event-date" class="form-control" name="event-date">
                            <span class="error" id="event-date_error"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="organizer" class="form-label">Time</label>
                            <input type="text" id="event-time" class="form-control" name="event-time" placeholder="HH:MM:SS">
                            <span class="error" id="event-time_error"></span>
                        </div>
                    </div>
                </div>

                <div class="description">
                    <h1>Description</h1>
                    <p>Please describe more about your event.</p>

                    <label for="organizer" class="form-label">Description</label>
                    <input type="text" id="event-description" class="form-control" name="event-description">
                    <span class="error" id="event-description_error"></span>
                </div>

                <div class="event_comments">
                    <div class="switch">
                        <h1>Comments</h1>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="event-comments" role="switch" id="flexSwitchCheckChecked" checked>
                        </div>
                    </div>
                    <p>You can enable or disable the option to comment. Only invited guests can comment the event. </p>
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



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./script/createEventValidateForm.js"></script>
</body>
</html>