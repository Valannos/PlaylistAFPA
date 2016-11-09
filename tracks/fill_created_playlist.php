


<?php
/* THIS PAGE APPEARS WHEN USER SUBMIT NEW PLAYLIST PROVIDING ALL FIELDS HAVE BEEN FILLED */


session_start();
define('SQL_DSN', 'mysql:host=localhost;dbname=Test;charset=utf8');
define('SQL_USER', 'root');
define('SQL_PASSWORD', 'admin');

$pdo = new PDO(SQL_DSN, SQL_USER, SQL_PASSWORD);
if (!(isset($_SESSION['already_present']))) {
    $_SESSION['already_present'] = false;
}


$playlistName = filter_input(INPUT_POST, 'playlist_name');
if (empty($playlistName)) {
    header('location:create_playlist.php');
} else {
    /* UPLOADING IMAGE - CODED IS INSPIRED BY W3SCHOOLS PROCEDURE */

    $target_dir = "playlists_img/";
    $target_file = $target_dir . basename($_FILES['image_upload']['name']);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    if (isset($_POST['submit'])) {

        $check = getimagesize($_FILES['image_upload']['tmp_name']);
        if ($check !== false) {
            echo "file is an image - " . $check['mime'] . ".";
            $uploadOk = 1;
        } else {
            echo "file is not an image";
            $uploadOk = 0;
        }
    }
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    if ($_FILES["image_upload"]["size"] > 500000) {
        echo "<p class = 'error'>Image is too large and has therefore not been uploaded</p>";
        $uploadOk = 0;
    }
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo "<p class = 'error'>Image format is not valid</p>";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded. Default image loaded";
        $img_url = $target_dir . "default.png";
    } else {
        $newFileName = uniqid('img_play_') . $imageFileType;
        if (move_uploaded_file($_FILES["image_upload"]["tmp_name"], $target_dir . $newFileName)) {
            echo "The file " . basename($_FILES["image_upload"]["name"]) . " has been uploaded under the name of " . $newFileName . ".";
            $img_url = $target_dir . $newFileName;
        } else {
            echo "Error. Default image loaded";
            $img_url = $target_dir . "default.png";
        }
    }


    /* NEWLY CREATED PLAYLIST IS ADDED TO PLAYLIST_USER TABLE AND AN ID AS PRIMARY KEY WILL BE CREATED */

    $getUserId = $pdo->prepare('SELECT user_id FROM `user` WHERE username = :currentUser');
    $getUserId->bindValue('currentUser', $_SESSION['currentUser']);
    $getUserId->execute();
    $user_id = $getUserId->fetch()['user_id'];
    $addPlaylist = $pdo->prepare('INSERT INTO playlist_user (user_id, playlist_name, img_url) VALUES (:user_id, :playlistName, :img_url)');
    $addPlaylist->bindValue('user_id', $user_id);
     $addPlaylist->bindValue('img_url', $newFileName);
    $addPlaylist->bindValue('playlistName', $playlistName);
    $addPlaylist->execute();
//$transfertId = prepare('INSERT INTO playlist_track (user_id, playlist_id) VALUES (:user_id, SELECT playlist');


    /* FOLLOWING CODE DISPLAYS TRACK IMPORTED FROM TRACK TABLE AND ALLOW LOGGED USER TO ADD OR REMOVE TRACK IN HIS/HER PLAYLIST.
     * 
      THIS RESULT IN ADDING NEW LINE IN PLAYLIST_TRACK TABLE ---- !!!! TO BE CODED !!!! -----

     * PLEASE NOTE THAT ADDING TRACKS IS NOT MANDATORY AND AN EMPTY PLAYLIST IS ACCEPTABLE */
    ?>



    <html>
        <head>
            <title>Add tracks</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="../master.css"/>



        </head>
        <body>
            <div class="col-lg-4">
                <?php
                if ($uploadOk == 0) {
                    echo "<h3>No valid image detected, default loaded</h3>";
                }
                ?>
                <img class="img-responsive" width="152" height="113" src="<?php echo $img_url ?>">
            </div>

            <table>

                <caption>Select tracks you want to add to "<?php echo $playlistName ?>"</caption>
                <thead>
                    <tr>
                        <th>Track Name</th>
                        <th>Author</th>
                        <th>Year</th>
                        <th>Duration</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $reponse = $pdo->prepare("SELECT * FROM track WHERE year > :year");
                    $reponse->bindValue("year", 0000);
                    $reponse->execute();

                    while ($donnees = $reponse->fetch()) {
                        echo '<tr>';
                        echo '<td><strong>' . $donnees['title'] . '</td>';
                        echo '<td>' . $donnees['author'] . '</td>';
                        echo '<td>' . $donnees['year'] . '</td>';
                        echo '<td>' . $donnees['duration'] . '</td>';
                        if ($_SESSION['already_present']) {
                            echo '<h4 class="error">Already in playlist</h4>';
                            $_SESSION['already_present'] = false;
                        }
                        ?>
                    <td><a href="addTrack_to_playlist.php?id=<?php echo $donnees['id'] ?>"><i class="fa fa-plus" aria-hidden="true"></i></a></td>
                    <td><a href="removeTrack_to_playlist.php?id=<?php echo $donnees['id'] ?>"><i class="fa fa-minus" aria-hidden="true"></i></a></td> 


                    <?php
                    echo '</tr>';
                }
            }
            ?>

        </tbody>
        <tfoot>
            <tr>


            </tr>
        </tfoot>
    </table>


    <a  href="logon.php">Back to homepage</a>







</body>
</html>
