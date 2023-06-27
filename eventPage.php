<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event Page</title>
</head>
<body>
    <h2>Clicked from event card</h2>

    <?php

    require_once './php/config.php';
     if(isset($_GET['id'])){
         $event_id = $_GET['id'];
     }

     $sql = "SELECT * FROM events WHERE event_id = " . $event_id;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($result);
    ?>
</body>
</html>
