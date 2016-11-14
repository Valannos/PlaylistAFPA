<?php
session_start();

include(dirname(__FILE__) . '/dao/TrackStore.php');
include(dirname(__FILE__) . '/dao/AuthorStore.php');
include(dirname(__FILE__) . '/dao/GenreStore.php');
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="../master.css"/>
        <title>title</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

    </head>
    <body>
        <table class="table table-striped ">
            <caption><h2 class="text-center">Tracklist</h2></caption>
            <thead>
                <tr class="info ">
                    <th class="text-center">Track Name</th>
                    <th class="text-center">Author</th>
                    <th class="text-center">Year</th>
                    <th class="text-center">Duration</th>
                    <th class="text-center">Genre</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $Alltrack = TrackStore::getAllTracks();
                foreach ($Alltrack as $track) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $track->getTitle() ?> </td>
                        <td class="text-center"><?php echo AuthorStore::getAuthorNameById($track->getAuthorId()) ?></td>
                        <td class="text-center"><?php echo $track->getYear() ?> </td>
                        <td class="text-center"><?php echo $track->getDuration() ?> </td>
                        <td class="text-center"><?php echo GenreStore::getGenreNameById($track->getGenreId()) ?> </td>

                        <td class="text-center"><a class="btn btn-danger" href="remove_track_from_database.php?id=<?php echo $track->getId() ?>">Remove Track</a></td>
                        <td class="text-center"><a class="btn btn-warning" href="form_edit_track.php?id=<?php echo $track->getId() ?>">Edit</a></td> 



                    </tr>
                    <?php
                }
                ?>


            </tbody>
        </table>
        <?php
        if ($_SESSION['currentUser'] === 'admin') {
            ?>
        <a class="btn btn-primary" href="form_track.php"><i class="fa fa-user-md" aria-hidden="true"></i> Back to formular</a>
            <?php
        }
        ?>
        <a class="btn btn-default" href="homepage.php"><i class="fa fa-home" aria-hidden="true"></i> Back to homepage</a>
    </body>
</html>



