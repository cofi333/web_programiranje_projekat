<?php
require_once 'functions.php';

const HOST = "localhost";
const USER = "root";
const PASSWORD = "";
const DB = "programatori";
const CHARSET = "utf8mb4";

$pdoOptions = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

$dsn = "mysql:host=" . HOST  . ";dbname=" . DB . ";charset=". CHARSET;

$pdo = connectDatabase($dsn, $pdoOptions);

const SITE = "http://localhost/web_programiranje_projekat/";

$messages = [
    0 => 'No direct access!',
    1 => 'Unknown user!',
    2 => 'User with this name already exists, choose another one!',
    3 => 'Check your email to active your account!',
    4 => 'Fill all the fields!',
    5 => 'You are logged out!!',
    6 => 'Your account is activated, you can login now!',
    7 => 'Passwords are not equal!',
    8 => 'Format of e-mail address is not valid!',
    9 => 'Password is too short! It must be minimum 8 characters long!',
    10 => 'Password is not enough strong!' . '<br/>' . '(min 8 characters, at least 1 lowercase character, 1 uppercase character, 1 number, and 1 special character',
    11 => 'Something went wrong with mail server. We will try to send email later!',
    12 => 'Your account is already activated!',
    13 => 'Your event is created!',
    14 => 'If you have account on our site, email with instructions for reset password is sent to you.',
    15 => 'Your password has been updated. You can log in now.',
    16 => 'Token or other data are invalid!',
    17 => 'Your event is deleted.',
    18 => 'Check your credentials and try again',
    19 => 'You already sent an invitation to this guest!',
    20 => 'You already sent comment about this event. Thank you!',
    21 => 'Your response is saved.',
    22 => 'Your response is updated.',
    23 => 'Your account is active, but its banned. Contact admin form more information.',
    24 => 'Your comment has been sent.',
    25 => 'User has been successfully banned.',
    26 => 'Something went wrong, please try again.',
    27 => 'User ban has been revoked.',
    28 => 'Event banned.',
    29 => 'Event ban revoked.',
    30 => 'Event is deleted, message has been sent to the user.',
    31 => 'The invitation has been sent.',
    32 => 'Gift is updated.',
    33 => 'Gift is deleted.',
    34 => 'Gift is added.',
    35 => 'Event is updated!',
    36 => 'Check params down below, then submit update form again.',
    37 => 'Event name does not match, please enter valid name.',
    38 => 'Guest is deleted.',
    39 => 'Guest is updated.',
    40 => 'Event is updated.',
    41 => 'Name must me at least 3 characters long and it can not be numeric.',
    42 => 'Please set your new name',
    43 => 'Fill update password form!',
    44 => 'New password does not match with repeated password!',
    45 => 'Password updated!',
    46 => 'Your current password is not valid'
];

$emailMessages = [
    'register' => [
        'subject' => 'Register on web site',
        'altBody' => 'This is the body in plain text for non-HTML mail clients'
    ],
    'forget' => [
        'subject' => 'Forgotten password - create new password',
        'altBody' => 'This is the body in plain text for non-HTML mail clients'
    ],
    'invitation' => [
        'subject' => 'You are invited to event!',
        'altBody' => 'This is the body in plain text for non-HTML mail clients'
    ]
];
