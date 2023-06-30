<?php
require_once 'config.php';
if (isset($_GET['event_id'])) {
    $event_id = trim($_GET['event_id']);
}

$sql = $pdo->prepare("SELECT event_id, event_title FROM events WHERE event_id=" .$event_id);
$sql->execute();
$result = $sql->fetch();


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body id="center_form">
<h2 class="invitation-header">Send an invitation for <?php echo $result['event_title'] ?></h2>
<section class="center_form container">
    <div class="content">
        <div class="form">
            <form action="./send-invitation-data.php" method="post" id="form">
                <div class="form-group">
                    <label for="guest-email">Guest email:</label>
                    <input type="email" class="form-control" id="guest-email" name="guest-email" aria-describedby="emailHelp">
                    <span class="error" id="email-error"></span>
                </div>
                <div class="form-group">
                    <label for="guest-name">Guest name:</label>
                    <input type="text" class="form-control" id="guest-name" name="guest-name">
                    <span class="error" id="name-error"></span>
                </div>

                <div class="btn-form">
                    <input type="hidden" name="event_id" value="<?php echo $result['event_id'] ?>"/>
                    <input type="submit" name="btnSubmit" class="btn btn-primary" value="Send" />
                </div>

            </form>
        </div>

    </div>

</section>

</body>

<script src="../script/invitationValidateForm.js"></script>
<script src="../node_modules\bootstrap\dist\js\bootstrap.bundle.min.js"></script>
</html>
