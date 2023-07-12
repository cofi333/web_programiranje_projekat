<?php
require_once '../config.php';


if(isset($_POST['request'])) {
    $request = $_POST['request'];
}

if(isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
}



$sql = $pdo->prepare("SELECT guests.guest_id, guests.guest_name, guests.guest_mail, guests.is_coming, wish_list.wish_gift_name FROM guests LEFT JOIN wish_list ON guests.wish_id=wish_list.wish_id WHERE is_coming=". $request. " AND guests.event_id=".$event_id);
$sql->execute();
$result = $sql->fetchAll();

?>

<table class="table table-primary table-striped">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Mail</th>
        <th scope="col">Response</th>
        <th scope="col">Gift item</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $number = 1;
        foreach($result as $data) {
                if($data['is_coming'] === 0 ) {
                    $is_coming = 'Not coming';
                }
                else {
                    $is_coming = 'Coming';
                }
            echo  '<tr>
                     <th scope="row">' . $number . '</th>
                     <td>' . $data['guest_name'] . '</td>
                     <td>' . $data['guest_mail'] . '</td>
                     <td>' . $is_coming. '</td>
                     <td>' . $data['wish_gift_name'] .'</td>
                     <td> <a class="btn btn-warning update-event" onclick="getId('.$data['guest_id'].')" data-bs-toggle="modal" data-bs-target="#update-guest-modal" role="button">Update guest</a>
                           <a id="delButton" class="btn btn-danger" onclick="getId('.$data['guest_id'].')" data-bs-toggle="modal" data-bs-target="#delete-guest-modal" role="button">Delete guest</a></td>
                   </tr> ';
            $number++;
        }

        ?>
    </tbody>
</table>





