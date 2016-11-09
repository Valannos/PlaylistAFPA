<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* Filter input */
$genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_SPECIAL_CHARS);


/* Driver definition for SQL request */

define('SQL_DSN', 'mysql:host=localhost;dbname=Test;charset=utf8');
define('SQL_USER', 'root');
define('SQL_PASSWORD', 'admin');

$pdo = new PDO(SQL_DSN, SQL_USER, SQL_PASSWORD);

/* Error message in case of empty field */



if (empty($genre)) {
    $_SESSION['filled'] = false;
} else {
    $insert_track = $pdo->prepare('INSERT INTO genre (name) VALUES (:genre)');
    $insert_track->bindValue('genre', $genre);
    $insert_track->execute();
    $_SESSION['addOk'] = true;
}

header('location:accueil_genre.php');