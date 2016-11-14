<?php
/* THIS PAGE DISPLAYS ALL PLAYLISTS BELONGING TO CURRENTLY LOGGED USER */

session_start();
//PREPARING DRIVER FOR SQL REQUEST

include_once (dirname(__FILE__) . '/dao/AuthorStore.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

AuthorStore::delete($id);

header('location:list_author.php');

