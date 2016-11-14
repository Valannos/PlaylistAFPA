<?php
session_start();

require_once (dirname(__FILE__) . '/dao/UserStore.php');



$name = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
$hash_pass = password_hash($pass, PASSWORD_BCRYPT);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


$user = new User($id = NULL, $name, $hash_pass, $email);

$addUser = UserStore::save($user);
if (!$addUser) {
    header("location:homepage.php");
}
?>
<html>
    <head>
        <title>title</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="../master.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" > 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>

        <p> New user has been registered</p>
        <a class="btn btn-default" href = "homepage.php">Retour</a>
    </body>
</html>

