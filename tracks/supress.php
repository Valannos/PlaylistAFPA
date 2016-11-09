<?php

define('SQL_DSN','mysql:host=localhost;dbname=Test;charset=utf8');
define('SQL_USER','root');
define('SQL_PASSWORD','admin');
$idSupress = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$pdo = new PDO(SQL_DSN,SQL_USER,SQL_PASSWORD);
$supp = $pdo->prepare('DELETE FROM track WHERE id = :id');
$supp->bindValue('id', $idSupress);
$supp->execute();
echo 'track has been removed from database...'
?> </br>
<a href="test_SQL.php">Back to tracklist</a>
