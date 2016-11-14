<?php


session_start();
include_once (dirname(__FILE__) . '/dao/PlaylistStore.php');


$playlistId = filter_input(INPUT_GET, 'plId');
$trackId = filter_input(INPUT_GET, 'trckId');

PlaylistStore::removeTrackFromPlay($playlistId, $trackId);



$_SESSION['remove_success'] = true;
header('location:manage_playlist.php?id='.$playlistId);

