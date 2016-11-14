<?php
/* THIS PAGE DISPLAYS ALL PLAYLISTS BELONGING TO CURRENTLY LOGGED USER */

session_start();
include_once (dirname(__FILE__) . '/dao/PlaylistStore.php');
include_once (dirname(__FILE__) . '/dao/UserStore.php');
include_once (dirname(__FILE__) . '/dao/AuthorStore.php');
include_once (dirname(__FILE__) . '/dao/GenreStore.php');
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="../master.css"/>
        <title>Playlist of <?php echo $_SESSION['currentUser'] ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" > 

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <?php
                $currentUserPlaylists = PlaylistStore::getUserPlaylists($_SESSION['currentUser']);

                for ($i = 0; $i < count($currentUserPlaylists); $i++) {
                    ?>
                    <div    class="col-lg-4 text-center" >
                        <div class="row">
                            <h3 class = >Playlist N° <?php echo $i + 1 . ' : ' . $currentUserPlaylists[$i]->getName() ?></h3>

                            <img class="img-circle" width="152" height="113" src="playlists_img/<?php echo $currentUserPlaylists[$i]->getImgUrl() ?>" alt="img_playlist"> <br/>

                        </div>
                        <div  class="row">
                            <table class = "table table-hover">

                                <?php
                                $currentPlaylistTracks = PlaylistStore::getTracksFromPlaylist($currentUserPlaylists[$i]->getId());

                                for ($j = 0; $j < count($currentPlaylistTracks); $j++) {
                                    ?>
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Year</th>
                                            <th>Genre</th>
                                        </tr>
                                    </thead>
                                    <tbody>



                                        <tr>
                                            <td><?php echo $currentPlaylistTracks[$j]->getTitle() ?></td>
                                            <td><?php echo AuthorStore::getAuthorNameById($currentPlaylistTracks[$j]->getAuthorId()) ?></td>
                                            <td><?php echo $currentPlaylistTracks[$j]->getYear() ?></td>
                                            <td><?php echo GenreStore::getGenreNameById($currentPlaylistTracks[$j]->getGenreId()) ?></td>
                                            <td><a class="btn btn-danger" href="remove_track_from_playlist.php?trckId=<?php echo $currentPlaylistTracks[$j]->getId() ?>&AMP;plId=<?php echo $currentUserPlaylists[$i]->getId() ?>"><i class="fa fa-minus" aria-hidden="true"></i></a></td>

                                        </tr>




                                    </tbody>
                                    <?php
                                }
                                ?>
                            </table>

                        </div>
                        <div class="row">
                           
                            <a class="btn btn-success" href="manage_playlist.php?id=<?php echo $currentUserPlaylists[$i]->getId() ?>">Manage playlist</a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <a  class="btn btn-default" href="homepage.php">Back to homepage</a>
    </body>
</html>


