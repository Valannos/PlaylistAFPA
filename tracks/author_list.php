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
        <title>Authors</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <?php
                $authors = $pdo->prepare('SELECT a.id, a.name, count(t.id) n FROM author a LEFT JOIN track t ON t.authorid = a.id GROUP BY a.id');
                $authors->execute();
                $i = 1;
                while ($donnees = $authors->fetch()) {
                    ?>
                    <div class="col-lg-4 text-center" >
                        <h3>Author N°<?php echo $i . ' : ' . $donnees['name'] ?></h3>
                        <a class="btn btn-info" href="display_author.php?id=<?php echo $donnees['id'] ?>">View the <?php echo $donnees['n'] ?> tracks</a>
                        <a class="btn btn-danger" href="remove_author.php?id=<?php echo $donnees['id'] ?>">Remove author</a>
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
