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
        <title>Playlist of <?php echo $_SESSION['currentUser'] ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <?php
                $playlists = $pdo->prepare('SELECT  p.img_url, p.playlist_name, p.playlist_id FROM playlist_user p INNER JOIN user u ON u.user_id = p.user_id WHERE u.username = :currentUser');
                $playlists->bindValue('currentUser', $_SESSION['currentUser']);
                $playlists->execute();
                $i = 1;
                while ($donnees = $playlists->fetch()) {
                    ?>
                    <div    class="col-lg-4 text-center" >
                        <h3><?php echo 'Playlist N°' . $i . ' : ' . $donnees['playlist_name'] ?></h3>
                        <img class="img-circle" width="152" height="113" src="playlists_img/<?php echo $donnees['img_url'] ?>" alt="img_playlist"> <br/>
                        <a class="btn btn-info" href="display_playlist.php?id=<?php echo $donnees['playlist_id'] ?>">View tracks</a>
                        <a class="btn btn-success" href="manage_playlist.php?id=<?php echo $donnees['playlist_id'] ?>">Manage playlist</a>
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


