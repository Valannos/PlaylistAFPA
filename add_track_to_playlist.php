<?php


session_start();
include_once (dirname(__FILE__) . '/dao/PlaylistStore.php');



$playlistId = filter_input(INPUT_GET, 'plId');
$trackId = filter_input(INPUT_GET, 'trckId');
PlaylistStore::addTrackToPlaylist($playlistId, $trackId);


$_SESSION['add_success'] = true;


header('location:manage_playlist.php?id='.$playlistId);




