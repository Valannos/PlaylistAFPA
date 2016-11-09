<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* Filter input */
$author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);


/* Driver definition for SQL request */

define('SQL_DSN', 'mysql:host=localhost;dbname=Test;charset=utf8');
define('SQL_USER', 'root');
define('SQL_PASSWORD', 'admin');

$pdo = new PDO(SQL_DSN, SQL_USER, SQL_PASSWORD);

/* Error message in case of empty field */



if (empty($author)) {
    $_SESSION['filled'] = false;
} else {
    $insert_track = $pdo->prepare('INSERT INTO author (name) VALUES (:author)');
    $insert_track->bindValue('author', $author);
    $insert_track->execute();
    $_SESSION['addOk'] = true;
}

header('location:accueil_author.php');