<?php
session_start();
include_once (dirname(__FILE__).'/dao/TrackStore.php');


/* Filter input */
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$genre = filter_input(INPUT_POST, 'genre', FILTER_VALIDATE_INT);
$year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
$duration = filter_input(INPUT_POST, 'duration', FILTER_VALIDATE_INT);
$author = filter_input(INPUT_POST, 'author', FILTER_VALIDATE_INT);
echo $id;
$track = new Track($title, $year, $duration, $author, $genre);
var_dump($track);
$track->setId($id);
var_dump($track);
TrackStore::update($track);
    


echo 'EDIT OVER </br>';
echo '<a href = "list_track_from_database.php">Revenir à la liste</a>';

