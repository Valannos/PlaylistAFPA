<?php

session_start();

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* Filter input */
$author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);

include(dirname(__FILE__).'/dao/AuthorStore.php');

/* Error message in case of empty field */



if (empty($author)) {
    $_SESSION['filled'] = false;
} else {
    AuthorStore::save($author);
    $_SESSION['addOk'] = true;
}

header('location:list_author.php');