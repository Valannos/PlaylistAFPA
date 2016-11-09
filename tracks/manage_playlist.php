<?php
session_start();
define('SQL_DSN', 'mysql:host=localhost;dbname=Test;charset=utf8');
define('SQL_USER', 'root');
define('SQL_PASSWORD', 'admin');

if (!(isset($_SESSION['add_success']))) {
    $_SESSION['add_success'] = false;
}
if (!isset($_SESSION['remove_success'])) {
    $_SESSION['remove_success'] = false;
}

$playlistId = filter_input(INPUT_GET, 'id');
$pdo = new PDO(SQL_DSN, SQL_USER, SQL_PASSWORD);
$getPlaylist = $pdo->prepare('SELECT playlist_name FROM `playlist_user` WHERE playlist_id = :playlistId');
$getPlaylist->bindValue('playlistId', $playlistId);
$getPlaylist->execute();
$playlistName = $getPlaylist->fetch()['playlist_name'];
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="../master.css"/>
        <title>title</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" > 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

    </head>
    <body>



        <table class="table table bordered">

            <caption>Select tracks you want to add to "<?php echo $playlistName ?>"</caption>
            <thead>
                <tr >
                    <th class="text-center">Track Name</th>
                    <th class="text-center">Author</th>
                    <th class="text-center">Year</th>
                    <th class="text-center">Duration</th>
                    <th class="text-center">Add track</th>
                    <th class="text-center">Remove track</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $reponse = $pdo->prepare("SELECT t.duration, t.title, t.year, t.authorid, a.name 
FROM track t 
INNER JOIN author a
ON a.id = t.authorid");
                $reponse->bindValue("year", 0000);
                $reponse->execute();

                while ($donnees = $reponse->fetch()) {
                    echo '<tr>';
                    echo '<td><strong>' . $donnees['title'] . '</td>';
                    echo '<td>' . $donnees['name'] . '</td>';
                    echo '<td>' . $donnees['year'] . '</td>';
                    echo '<td>' . $donnees['duration'] . '</td>';
                    ?>
                <td><a class="btn btn-primary" href="addTrack_to_playlist.php?trckId=<?php echo $donnees['id'] ?>&AMP;plId=<?php echo $playlistId ?>"><i class="fa fa-plus" aria-hidden="true"></i></a> 
                </td>
                <td><a class="btn btn-danger" href="remove_track_from_playlist.php?trckId=<?php echo $donnees['id'] ?>&AMP;plId=<?php echo $playlistId ?>"><i class="fa fa-minus" aria-hidden="true"></i></a></td> 


                <?php
                echo '</tr>';
//                    if ($_SESSION['already_present']) {
//                        echo '<h4 class="error">Already in playlist</h4>';
//                        $_SESSION['already_present'] = false;
//                    }
                if ($_SESSION['add_success']) {
                    echo '<h4>Track successfully added</h4>';
                    $_SESSION['add_success'] = false;
                }
                if ($_SESSION['remove_success']) {
                    echo '<h4>Track successfully removed from playlist</h4>';
                    $_SESSION['remove_success'] = false;
                }
            }
            ?>

        </tbody>
        <tfoot>
            <tr>


            </tr>
        </tfoot>
    </table>
    <a class="btn btn-success" href="playlist_list.php">back to playlist inventory</a>
</body>
</html>

