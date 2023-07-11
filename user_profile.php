<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="node_modules/swiper/swiper-bundle.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
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

        <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Events</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-messages-tab" data-bs-toggle="pill" data-bs-target="#pills-messages" type="button" role="tab" aria-controls="pills-messages" aria-selected="false">Messages</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active py-5" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                <div id="user-info" style="text-align: center;"></div>

                <div class="user-action" style="text-align: center">
                   <!-- logout modal section -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#logoutEventModal">Log out</button>
                    <div class="modal fade" id="logoutEventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Log Out</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to log out?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                    <a href="./php/logout.php" type="button" id="logout-btn" class="btn btn-warning">Log Out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- logout modal section -->

                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Update profile info</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update profile info</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingEmail" placeholder="name@example.com">
                                            <label for="floatingEmail">Email address</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingName" placeholder="Your name">
                                            <label for="floatingName">Name</label>
                                        </div>

                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- update account section -->
                </div>
            </div>
          
            </div>
            <div class="tab-pane fade justify-content-center py-3" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                    <div class="created-by-user">

                    </div>
            </div>

            <div class="tab-pane fade justify-content-center" id="pills-messages" role="tabpanel" aria-labelledby="pills-messages-tab" tabindex="0">...</div>
        </div>
    </main>

    <footer id="user-profile-footer">
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
                    <a href="" type="button" id="delete-btn" class="btn btn-primary">Delete event</a>
                </div>
            </div>
        </div>
    </div>


    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="node_modules/swiper/swiper-bundle.min.js"></script>
    <script src="./script/swiper.js">

    </script>
    <script src="./script/fetchJSONFromServer.js"></script>
    <script>
        fetchUserJSON();
    </script>
<script>
    let listEventBtn = document.getElementById('pills-profile-tab');
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