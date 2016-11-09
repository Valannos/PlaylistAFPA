<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* Filter input */
$genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_NUMBER_INT);

/* Driver definition for SQL request */

define('SQL_DSN', 'mysql:host=localhost;dbname=Test;charset=utf8');
define('SQL_USER', 'root');
define('SQL_PASSWORD', 'admin');

$pdo = new PDO(SQL_DSN, SQL_USER, SQL_PASSWORD);

/* Error message in case of empty field */



if (empty($_POST['title']) || empty($_POST['year']) || empty($_POST['author']) || empty($_POST['duration']) || empty($genre)) {
    $_SESSION['filled'] = false;
    header('location:accueil.php');
} else {
    $insert_track = $pdo->prepare('INSERT INTO track (title, authorid, year, duration, genreid) VALUES (:title, :authorid, :year, :duration, :genreid)');
    $insert_track->bindValue('title', $_POST['title']);
    $insert_track->bindValue('authorid', (int) $_POST['author']);
    $insert_track->bindValue('year', (int) $_POST['year']);
    $insert_track->bindValue('duration', (int) $_POST['duration']);
    $insert_track->bindValue('genreid', (int) $genre);
    $insert_track->execute();
    $_SESSION['addOk'] = true;
    header('Location:' . $_SERVER['PHP_SELF']);
}



header('location:accueil.php');
?>