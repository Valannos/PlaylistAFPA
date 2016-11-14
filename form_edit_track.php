<?php
include(dirname(__FILE__) . '/dao/TrackStore.php');
include(dirname(__FILE__) . '/dao/AuthorStore.php');
include(dirname(__FILE__) . '/dao/GenreStore.php');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$track = TrackStore::getTrackById($id);
var_dump($track);

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="../master.css"/>
        <title>title</title>

    </head>
    <body>


        <form action="edit_track.php" method="post">

            <fieldset>
                <div class="formular">
                    <legend>Track <strong>edit </strong>formular</legend>
                    <div class="labelfield"> 
                        <label  for="title" >Title track</label>
                        <input value="<?php echo $track->getTitle() ?>" type="text" id="title" name="title" placeholder="Ex. Fear of the Dark" name="title">
                    </div>
                    <div class="labelfield">
                        <label  for="year">Year</label> 
                        <input value="<?php echo $track->getYear() ?>" type="number" id="year" name="year" placeholder="Ex. 2001">
                    </div>
                    <div class="labelfield">
                        <label  for="duration">Duration in seconds</label>
                        <input  value="<?php echo $track->getDuration() ?>" id="duration" type="number" name="duration" placeholder="Ex. 120">
                    </div>
                    <div class="labelfield">
                        <label for="author" >Artiste Name</label>
                        <select id="author" name="author">
                            <?php
                            $allAuthors = AuthorStore::getAllAuthors();
                            echo var_dump($allAuthors);
                            foreach ($allAuthors as $author) {
                                if ($author == $track->getAuthorId()) {
                                    echo '<option value="' . $author . '" selected="selected">';
                                } else {
                                    echo '<option value="' . $author . '">';
                                }
                                echo AuthorStore::getAuthorNameById($author);
                                
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="labelfield">
                        <label for="genre" >Genre</label>
                        <select id="genre" name="genre">
                            <?php
                            $allGenres = GenreStore::getAllGenres();
                            foreach ($allGenres as $genre) {
                                if ($genre == $track->getGenreId()) {
                                    echo '<option value="' . $genre . '" selected="selected">';
                                } else {
                                    echo '<option value="' . $genre . '">';
                                }
                                echo GenreStore::getGenreNameById($genre);
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <input  type="submit" value="Confirm edit track">
                    </div>  
                    <div class="labelfield"> 

                        <input value="<?php echo $id ?>" type="number" id="title" name="id" hidden>
                    </div>
                </div>
            </fieldset>         
        </form>
    </body>
</html>    

<?php




    

