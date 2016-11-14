<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once (dirname(__FILE__) . '/config.inc.php');
require (dirname(__FILE__) . '/model/Track.class.php');
require (dirname(__FILE__.'/dao/DB.php'));


/* Error message in case of empty field */


$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
$author_id = filter_input(INPUT_POST, 'author_id', FILTER_VALIDATE_INT);
$duration = filter_input(INPUT_POST, 'duration', FILTER_VALIDATE_INT);
$genre_id = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING);


if (empty($title) || empty($year) || empty($author_id) || empty($duration) || empty($genre_id)) {
    $_SESSION['filled'] = false;
    
    
    header('location:accueil.php');
} else {
    
    $track = new Track($title, $year, $duration, $author_id, $genre_id);
    TrackStore::save($track);
    
    header('Location:' . $_SERVER['PHP_SELF']);
}



header('location:accueil.php');
?>