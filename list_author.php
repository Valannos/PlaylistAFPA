<?php
/* THIS PAGE DISPLAYS ALL PLAYLISTS BELONGING TO CURRENTLY LOGGED USER */

session_start();
//PREPARING DRIVER FOR SQL REQUEST



include_once (dirname(__FILE__) . '/dao/AuthorStore.php');
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
                $author = AuthorStore::getAllAuthors();
                for ($i = 0; $i < count($author); $i++) {
                    ?>
                    <div class="col-lg-4 text-center" >
                        <h3>Author N°<?php echo $i+1 . ' : ' . AuthorStore::getAuthorNameById($author[$i]) ?></h3>
                        <a class="btn btn-info" href="display_author.php?id=<?php //echo $author[$i] ?>">View the <?php //echo $donnees['n'] ?> tracks</a>
                        <a class="btn btn-danger" href="remove_author_from_database.php?id=<?php echo $author[$i] ?>">Remove author</a>

                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <a  class="btn btn-default" href="homepage.php">Back to homepage</a>
    </body>
</html>
