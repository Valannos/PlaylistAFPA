<?php

require_once (dirname(__FILE__).'/dao/GenreStore.php');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
GenreStore::delete($id);
header('location: list_genre_from_database.php');
