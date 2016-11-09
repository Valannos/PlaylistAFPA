<?php
/* THIS PAGE ALLOWS USER TO CREATE A NEW PLAYLIST
  FILLING NAME FIELD IS MANDATORY */

session_start();
define('SQL_DSN', 'mysql:host=localhost;dbname=Test;charset=utf8');
define('SQL_USER', 'root');
define('SQL_PASSWORD', 'admin');

$pdo = new PDO(SQL_DSN, SQL_USER, SQL_PASSWORD);
?>

<html>
    <head>
        <title>Create a new Playlist</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../master.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>


        <form action="playlist_creation_successful.php" method="post" class="col-lg-4 well" enctype="multipart/form-data">

            <fieldset>
                <legend>Playlist information</legend>
                <div class="form-group">
                    <label for="playlist_name">Name your playlist : </label>
                    <input class="form-control "type="text" name="playlist_name" placeholder="My PlayList" id="playlist_name">
                </div>
                <div class="form-group">
                    <label for="comments">Comments : </label>
                    <textarea class="form-control" id="comments" name="comments"  rows="3" cols="9"></textarea>
                </div>
                <div class="form-group">
                    <label for="image_upload">Select a picture to customize your playlist</label>
                    <input class="btn btn-default" name="image_upload" id="image_upload" type="file">
                </div>
                <button class="btn btn-primary" type="submit" name="submit">Create playlist</button>


                <a class="btn btn-default" href="logon.php">Back to homepage</a>

            </fieldset>


        </form>



    </body>
</html>
