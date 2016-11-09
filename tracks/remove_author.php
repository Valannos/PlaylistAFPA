<?php
/* THIS PAGE DISPLAYS ALL PLAYLISTS BELONGING TO CURRENTLY LOGGED USER */

session_start();
//PREPARING DRIVER FOR SQL REQUEST

define('SQL_DSN', 'mysql:host=localhost;dbname=Test;charset=utf8');
define('SQL_USER', 'root');
define('SQL_PASSWORD', 'admin');
$pdo = new PDO(SQL_DSN, SQL_USER, SQL_PASSWORD);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {
    $insert = $pdo->prepare('DELETE FROM author WHERE id = :id');
    $insert->bindValue(":id", (int) $id);
    $insert->execute();
}
header('location: author_list.php');
