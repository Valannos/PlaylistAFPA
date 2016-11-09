<?php
session_start();

/* Driver definition for SQL request */

define('SQL_DSN', 'mysql:host=localhost;dbname=Test;charset=utf8');
define('SQL_USER', 'root');
define('SQL_PASSWORD', 'admin');

$pdo = new PDO(SQL_DSN, SQL_USER, SQL_PASSWORD);


if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = 1;
    $_SESSION['filled'] = true;
}

if ($_SESSION['id'] == 1) {
    $_SESSION['trackList'] = array();
}
if (!(isset($_SESSION['addOK']))) {
    $_SESSION['addOK'] = false;
}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="../master.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" > 
        <title>title</title>


    </head>
    <body>
        <div class="container">

            <form class="well form-horizontal" action="add_track.php" method="post">



                <h1 class="text-center">Track data formular</h1>

                <div class="form-group"> 

                    <label class="control-label col-md-2 col-md-offset-2" for="title" >Title track</label>
                    <div    class="col-md-4">
                        <input class= "form-control " type="text" id="title" name="title" placeholder="Ex. Fear of the Dark">
                    </div>
                </div>

                <div class="form-group">

                    <label class="control-label col-md-offset-2 col-md-2" for="year">Year</label> 
                    <div class="col-md-4">
                        <input class= "form-control" type="number" id="year" name="year" placeholder="Ex. 2001">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-offset-2 col-md-2" for="duration">Duration in seconds</label>
                    <div class="col-md-4">
                        <input class= "form-control" id="duration" type="number" name="duration" placeholder="Ex. 120">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-offset-2 col-md-2" for="author" >Artiste Name</label>
                    <div class="col-md-4">
                        <select class="form-control" id="author" name="author">
                            <?php
                            $authors = $pdo->prepare('SELECT * FROM author');
                            $authors->execute();
                            while ($donnees = $authors->fetch()) {
                                echo '<option value="' . $donnees['id'] . '">' . $donnees['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-offset-2 col-md-2" for="genre" >Genre</label>
                    <div class="col-md-4">
                        <select class="form-control" id="genre" name="genre">
                            <?php
                            $genres = $pdo->prepare('SELECT * FROM genre');
                            $genres->execute();
                            while ($donnees = $genres->fetch()) {
                                echo '<option value="' . $donnees['id'] . '">' . $donnees['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <input  type="text" value="true" name="form_yes" hidden>

                    <input class="btn btn-success"  type="submit" value="Submit track to database">

                </div>  


            </form>
        </div>
        <footer>
            <a class="btn btn-danger" href="logout.php">Logout</a>
            <a class="btn btn-primary" href="test_SQL.php">Access tracklist</a>
            <a class="btn btn-default" href="logon.php">Back to homepage</a>

            <?php
            if (!($_SESSION['filled'])) {
                echo '<div class = "error" >SOME FIELDS ARE EMPTY</div>';
                $_SESSION['filled'] = true;
            }
            if ($_SESSION['addOK'] == true) {
                echo '<div class = "success">NEW TRACK SUCCESSFULY ADD</div>';
                $_SESSION['addOK'] = false;
            }
            ?>
        </footer>
    </body>
</html>