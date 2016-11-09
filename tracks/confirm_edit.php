<?php
session_start();
define('SQL_DSN','mysql:host=localhost;dbname=Test;charset=utf8');
define('SQL_USER','root');
define('SQL_PASSWORD','admin');

/* Filter input */
$genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_NUMBER_INT);
    
$pdo = new PDO(SQL_DSN,SQL_USER,SQL_PASSWORD);
$update_track = $pdo->prepare('UPDATE track SET title = :title, authorid = :author, year = :year, duration = :duration, genreid = :genre WHERE id = :id');
$update_track->bindValue('id', (int) $_POST['id']);
$update_track->bindValue('author', (int) $_POST['author']);
$update_track->bindValue('year', (int) $_POST['year']);
$update_track->bindValue('title', $_POST['title']);
$update_track->bindValue('duration', (int) $_POST['duration']);
$update_track->bindValue('genre', (int) $genre);
$update_track->execute();
echo 'EDIT OVER </br>';
echo '<a href = "test_SQL.php">Revenir à la liste</a>';

