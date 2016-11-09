<?php
/* THIS PAGE DISPLAYS ALL PLAYLISTS BELONGING TO CURRENTLY LOGGED USER */

session_start();
//PREPARING DRIVER FOR SQL REQUEST


define('SQL_DSN', 'mysql:host=localhost;dbname=Test;charset=utf8');
define('SQL_USER', 'root');
define('SQL_PASSWORD', 'admin');
$pdo = new PDO(SQL_DSN, SQL_USER, SQL_PASSWORD);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="../master.css"/>
        <title>Genres</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <?php
                $genres = $pdo->prepare('SELECT g.id, g.name, count(t.id) n FROM genre g LEFT JOIN track t ON t.genreid = g.id GROUP BY g.id');
                $genres->execute();
                $i = 1;
                while ($donnees = $genres->fetch()) {
                    ?>
                    <div class="col-lg-4 text-center" >
                        <h3>Genre N°<?php echo $i . ' : ' . $donnees['name'] ?></h3>
                        <a class="btn btn-info" href="display_genre.php?id=<?php echo $donnees['id'] ?>">View the <?php echo $donnees['n'] ?> tracks</a>
                        <a class="btn btn-danger" href="remove_genre.php?id=<?php echo $donnees['id'] ?>">Remove genre</a>
                        <?php $i++ ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <a  class="btn btn-default" href="logon.php">Back to homepage</a>
    </body>
</html>
