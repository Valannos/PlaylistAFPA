<?php
/* THIS PAGE TREATS THE REMOVE REQUEST SENT BY LOGGED USER OF SELECTED TRACK */

session_start();
//PREPARING DRIVER FOR SQL REQUEST


define('SQL_DSN', 'mysql:host=localhost;dbname=Test;charset=utf8');
define('SQL_USER', 'root');
define('SQL_PASSWORD', 'admin');
$pdo = new PDO(SQL_DSN, SQL_USER, SQL_PASSWORD);
$playlistId = filter_input(INPUT_GET, 'plId');
$trackId = filter_input(INPUT_GET, 'trckId');
$add_track_to_playlist = $pdo->prepare('DELETE FROM playlist_track WHERE playlist_id = :playlist_id AND track_id = :track_id');
$add_track_to_playlist->bindValue('playlist_id', $playlistId);
$add_track_to_playlist->bindValue('track_id', $trackId);
$add_track_to_playlist->execute();


echo 'Track removed';
$_SESSION['remove_success'] = true;
header('location:manage_playlist.php?id='.$playlistId);

