<?php
session_start();

define('SQL_DSN', 'mysql:host=localhost;dbname=Test;charset=utf8');
define('SQL_USER', 'root');
define('SQL_PASSWORD', 'admin');
$pdo = new PDO(SQL_DSN, SQL_USER, SQL_PASSWORD);
$getPlaylistId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$tracks = $pdo->prepare('SELECT  p.playlist_name, t.title, t.author, t.year FROM user u INNER JOIN playlist_user p INNER JOIN playlist_track pt INNER JOIN track t ON u.user_id = p.user_id AND p.playlist_id = pt.playlist_id AND t.id = pt.track_id WHERE pt.playlist_id = :currentPlaylist');
$tracks->bindValue('currentPlaylist', $getPlaylistId);
$tracks->execute();
$playlistName = $tracks->fetch()['playlist_name'];
?>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="../master.css"/>
    </head>
    <body>

        <table class="table table-hover">
            <caption><?php
if (empty($playlistName)) {
    echo 'No track in this playlist, yet.';
} else
    {
    echo 'tracks from '.$playlistName;
}
?></caption>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Year</th>
                </tr>
            </thead>
            <tbody>

<?php
$tracks->execute();

while ($data = $tracks->fetch()) {
    echo '<tr>';
    echo "<td>" . $data['title'] . "</td>";
    echo "<td>" . $data['author'] . "</td>";
    echo "<td>" . $data['year'] . "</td>";
    echo '</tr>';
}
?>


            </tbody>
        </table>


        <a class="btn btn-success" href="playlist_list.php">Back to playlists</a>
        <a class="btn btn-default" href="logon.php">Back to homepage</a>








    </body>
</html>
