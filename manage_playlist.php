<?php
session_start();
include_once (dirname(__FILE__) . '/dao/PlaylistStore.php');
include_once (dirname(__FILE__) . '/dao/TrackStore.php');
include_once (dirname(__FILE__) . '/dao/AuthorStore.php');

if (!(isset($_SESSION['add_success']))) {
    $_SESSION['add_success'] = false;
}
if (!isset($_SESSION['remove_success'])) {
    $_SESSION['remove_success'] = false;
}

$playlistId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$playlistName = PlaylistStore::getPlaylistNameFromId($playlistId);
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
                $allTracks = TrackStore::getAllTracks();

                for ($i = 0; $i < count($allTracks); $i++) {
                    ?>
                    <tr>
                        <th><?php echo $allTracks[$i]->getTitle() ?></th>
                        <td><?php echo AuthorStore::getAuthorNameById($allTracks[$i]->getAuthorId()) ?></td>
                        <td><?php echo $allTracks[$i]->getYear() ?></td>
                        <td><?php echo $allTracks[$i]->getDuration() ?></td>
                        <td><a class="btn btn-primary" href="add_track_to_playlist.php?trckId=<?php echo $allTracks[$i]->getId() ?>&AMP;plId=<?php echo $playlistId ?>"><i class="fa fa-plus" aria-hidden="true"></i></a> 
                        </td>



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

        </table>
        <a class="btn btn-success" href="list_playlist_from_database.php">back to playlist inventory</a>
    </body>
</html>

