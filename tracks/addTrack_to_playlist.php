<?php
/* THIS PAGE DISPLAYS ALL PLAYLISTS BELONGING TO CURRENTLY LOGGED USER */

session_start();
//PREPARING DRIVER FOR SQL REQUEST


define('SQL_DSN', 'mysql:host=localhost;dbname=Test;charset=utf8');
define('SQL_USER', 'root');
define('SQL_PASSWORD', 'admin');
$pdo = new PDO(SQL_DSN, SQL_USER, SQL_PASSWORD);
$playlistId = filter_input(INPUT_GET, 'plId');
$trackId = filter_input(INPUT_GET, 'trckId');


$add_track_to_playlist = $pdo->prepare('INSERT INTO playlist_track (playlist_id, track_id) VALUES ( :playlist_id, :track_id)');
$add_track_to_playlist->bindValue('playlist_id', $playlistId);
$add_track_to_playlist->bindValue('track_id', $trackId);
$add_track_to_playlist->execute();
$_SESSION['add_success'] = true;
echo 'Track added';

header('location:manage_playlist.php?id='.$playlistId);




