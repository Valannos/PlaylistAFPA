<?php

session_start();
require_once (dirname(__FILE__) . '/dao/GenreStore.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* Filter input */
$genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_SPECIAL_CHARS);

GenreStore::save($genre);

header('location:list_genre_from_database.php');
