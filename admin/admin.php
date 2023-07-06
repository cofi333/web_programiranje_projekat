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
    <link rel="stylesheet" href="../css/style.css"/>
    <title>admin-panel</title>
</head>
<body>
    <header>
        <nav class="mt-3 d-flex justify-content-around">
            <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
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
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">...</div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">...</div>
        </div>

    </main>
</body>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="script/fetchAllData.js"></script>
    <script>
        fetchUsers();
        fetchEvents();
        fetchAdminInfo();
    </script>
</html>

