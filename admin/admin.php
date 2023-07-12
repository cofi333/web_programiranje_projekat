<!doctype html>
<?php
    session_start();

    $username = '';
    $sessionID = '';

    if(isset($_SESSION['admin-username']) && $_SESSION['admin-id']){
        $username = $_SESSION['admin-username'];
        $sessionID = $_SESSION['admin-id'];
    } else{
        header("Location: a-login.php?m=0");
        exit();
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css"/>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>admin-panel</title>
</head>
<body>
    <header class="mt-3 position-sticky top-0 start-0">
        <nav class=" d-flex justify-content-around position-sticky">
            <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-admin-tab" data-bs-toggle="pill" data-bs-target="#pills-admin" type="button" role="tab" aria-controls="pills-admin" aria-selected="false">Admin profile</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Users</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Events</button>
                </li>
            </ul>

            <div class="logo">
                <h2>creteEvent/admin</h2>
            </div>

            <div class="bs-modal">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Log Out
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>You are about to log out, are you sure?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <a href="./php/logout.php" type="button" class="btn btn-primary">Yes</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
            </div>
        </nav>
    </header>

    <main>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-admin" role="tabpanel" aria-labelledby="pills-admin-tab" tabindex="0">
                <?php
                //session_start();
                require_once '../php/config.php';

                $redirectionMessage = '';
                if(isset($_GET['m'])){
                    $redirectionMessage = $messages[$_GET['m']];
                    if($_GET['m'] === 26){
                        echo '<div class="alert alert-danger fade show p-3" role="alert">';
                    }
                    else{
                        echo '<div class="alert alert-success fade show p-3" role="alert">';
                    }
                    echo $redirectionMessage;
                    echo '</div>';
                } else{
                    echo '<span>';
                    echo 'Howdy admin';
                    echo '</span>';
                }



                ?>
            </div>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">

            </div>

            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                <div class="admin-v-events"> <!-- Admin view events -->

                </div>
            </div>
        </div>

        <!-- Admin events modals -->
        <div class="modal fade" id="restrictUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">User actions</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p> Allow / ban user </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Exit</button>
                        <a href="" id="banUser" type="button" class="btn btn-danger">Ban user</a>
                        <a href="" id="allowUser" type="button" class="btn btn-primary">Allow user</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="updateEvent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Event</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="php/update-event.php" class="form-floating">
                            <input name="eventID" type="hidden" value="" class="form-control admin-event-id">
                            <div class="form-floating mb-3">
                                <input name="eventName" type="text" class="form-control admin-event-name" value="" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Event Name: </label>
                            </div>

                            <div class="form-floating mb-3">
                                <input name="userID" type="text" class="form-control admin-event-owner disabled" id="floatingInput" placeholder="name@example.com" disabled>
                                <label for="floatingInput">Even owner: </label>
                            </div>

                            <div class="form-floating mb-3">
                                <input name="eventDescription" type="text" class="form-control admin-event-desc" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Event description: </label>
                            </div>

                            <div class="form-floating mb-3">
                                <input name="eventLocation" type="text" class="form-control admin-event-location" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Event location: </label>
                            </div>

                            <div class="form-floating mb-3">
                                <input name="eventDate" type="text" class="form-control admin-event-date" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Event date: </label>
                            </div>

                            <div class="form-floating mb-3">
                                <input name="eventTime" type="text" class="form-control admin-event-time" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Event Time: </label>
                            </div>
                            <input type="submit" class="btn btn-success" value="Update Event" id="updateEventButton">
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Exit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteEvent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Event</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="php/delete-event.php" class="form-floating" id="deleteForm">
                            <div class="form-floating">
                                <input type="hidden" value="" name="id_event" id="deleteEventAdmin">
                                <input type="hidden" value="" name="id_user" id="deleteEventUser">
                            </div>
                            <div class="form-floating">
                                <textarea name="deleteMessage" class="form-control deleteMessage" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Message</label>
                            </div>
                            <p id="errorMsg"></p>
                            <input type="submit" id="sumbitDeleteForm" class="btn btn-danger" value="Delete Event">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="banEventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Event actions</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Ban / Allow event</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="" id="banEvent" type="button" class="btn btn-primary">Ban event</a>
                        <a href="" id="allowEvent" type="button" class="btn btn-primary">Allow event</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin events modals -->

        <section class="admin-actions">

        </section>
    </main>
</body>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="./script/event-check.js"></script>
    <script src="script/fetchAllData.js"></script>
    <script>
        fetchUsers();
        fetchEvents();
    </script>
</html>

