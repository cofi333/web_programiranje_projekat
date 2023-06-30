<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Your Profile</title>
</head>
<body>

    <header class="heading">
        <nav class="navbar navbar_index navbar-expand-lg">
            <div class="container-fluid container">
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
                            <a class="nav-link" href="./event.php">Create an event</a>
                        </li>

                    </ul>

                    <div class="user">
                        <a href="#"><img src="./images/user_image.png" id="user_image"></a>
                    </div>
                </div>
            </div>
        </nav>

        <?php
        session_start();
        require_once 'php/config.php';
        require_once 'php/functions.php';
        if (!isset($_SESSION['username']) OR !isset($_SESSION['id_user']) OR !is_int($_SESSION['id_user'])) {
            redirection('index.php?l=0');
        }

        ?>
    </header>


    <main class="main-user-section">

        <?php echo "WELCOME ". $_SESSION['username']; ?>
        <img src="./images/user_image.png" alt="user">
        <a href="./php/logout.php">Log out</a>

        <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</button>
                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>
                <button class="nav-link" id="v-pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#v-pills-disabled" type="button" role="tab" aria-controls="v-pills-disabled" aria-selected="false" disabled>Disabled</button>
                <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</button>
                <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
            </div>
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">...</div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">...</div>
                <div class="tab-pane fade" id="v-pills-disabled" role="tabpanel" aria-labelledby="v-pills-disabled-tab" tabindex="0">...</div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">...</div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">...</div>
            </div>
        </div>


        <button id="listEvents" type="button" class="btn btn-success">Success</button>



        <section class="events">

        </section>
    </main>

    <footer id="user-footer">
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

    <div class="modal fade" id="deleteEventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete event</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete event?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="./script/fetchJSONFromServer.js"></script>
<script>
    let listEventBtn = document.getElementById('listEvents');
    let alreadyFetched = false;
    listEventBtn.addEventListener("click", function (e){
        if(!alreadyFetched) {
            fetchUserEvents();
            alreadyFetched = true;
        } else{
            e.preventDefault();
        }
    });
</script>

</body>
</html>