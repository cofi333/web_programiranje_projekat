<?php
require_once 'config.php';
if (isset($_GET['token'])) {
    $token = trim($_GET['token']);
}
else {
    redirection('../index.php?l=0');
    exit();
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Reset your password</title>
</head>
<body id="center_form">
<section class="center_form container-lg">
    <div class="content">
        <div class="form">

            <?php
            $rf = 0;

            if (isset($_GET["rf"]) and is_numeric($_GET['rf'])) {
                $rf = (int)$_GET["rf"];

                if (array_key_exists($rf, $messages)) {
                    echo '
                    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                        ' . $messages[$rf] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
                }
            }
            ?>

            <form action="forget.php" method="post" id="form">
                <div class="form-group">
                    <label for="reset-email">Email</label>
                    <input type="email" class="form-control" id="reset-email" name="reset-email" aria-describedby="emailHelp" placeholder="Your email">
                    <span class="error" id="reset-email_error"></span>
                </div>
                <div class="form-group">
                    <label for="new-password">Password</label>
                    <input type="password" class="form-control" id="new-password" name="new-password" placeholder="Enter your new password">
                    <span class="error" id="reset-password_error"></span>
                </div>
                <div class="form-group">
                    <label for="repeat-new-password">Repeat password</label>
                    <input type="password" class="form-control" id="repeated-new-password" name="repeat-new-password" placeholder="Repeat your new password">
                    <span class="error" id="reset-repeat_password_error"></span>
                </div>

                <div class="sign_up">
                    <input type="hidden" name="token" value="<?php echo $token ?>">
                    <input type="submit" name="btnSubmit" class="btn" />
                </div>
            </form>
        </div>

    </div>




</section>

</body>

<script src="../script/resetPasswordValidateForm.js"></script>
<script src="../node_modules\bootstrap\dist\js\bootstrap.bundle.min.js"></script>
</html>