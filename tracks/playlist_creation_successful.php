


<?php
/* THIS PAGE APPEARS WHEN USER SUBMIT NEW PLAYLIST PROVIDING ALL FIELDS HAVE BEEN FILLED */


session_start();
define('SQL_DSN', 'mysql:host=localhost;dbname=Test;charset=utf8');
define('SQL_USER', 'root');
define('SQL_PASSWORD', 'admin');

$pdo = new PDO(SQL_DSN, SQL_USER, SQL_PASSWORD);




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
        $img_url = "default.png";
    } else {
        $newFileName = uniqid('img_play_') . $imageFileType;
        if (move_uploaded_file($_FILES["image_upload"]["tmp_name"], $target_dir . $newFileName)) {
            echo "The file " . basename($_FILES["image_upload"]["name"]) . " has been uploaded under the name of " . $newFileName . ".";
            $img_url = $newFileName;
        } else {
            echo "Error. Default image loaded";
            $img_url =  "default.png";
        }
    }


    /* NEWLY CREATED PLAYLIST IS ADDED TO PLAYLIST_USER TABLE AND AN ID AS PRIMARY KEY WILL BE CREATED */


    $getUserId = $pdo->prepare('SELECT user_id FROM `user` WHERE username = :currentUser');
    $getUserId->bindValue('currentUser', $_SESSION['currentUser']);
    $getUserId->execute();
    $user_id = $getUserId->fetch()['user_id'];
    $addPlaylist = $pdo->prepare('INSERT INTO playlist_user (user_id, playlist_name, img_url) VALUES (:user_id, :playlistName, :img_url)');
    $addPlaylist->bindValue('user_id', $user_id);
    $addPlaylist->bindValue('img_url', $img_url);
    $addPlaylist->bindValue('playlistName', $playlistName);
    $addPlaylist->execute();

    $getPlaylistId = $pdo->prepare('SELECT playlist_id FROM playlist_user WHERE playlist_name = :playlistName');
    $getPlaylistId->bindValue('playlistName', $playlistName);
    $getPlaylistId->execute();
}






//$transfertId = prepare('INSERT INTO playlist_track (user_id, playlist_id) VALUES (:user_id, SELECT playlist');


/* FOLLOWING CODE DISPLAYS TRACK IMPORTED FROM TRACK TABLE AND ALLOW LOGGED USER TO ADD OR REMOVE TRACK IN HIS/HER PLAYLIST.
 * 
  THIS RESULT IN ADDING NEW LINE IN PLAYLIST_TRACK TABLE ---- !!!! TO BE CODED !!!! -----

 * PLEASE NOTE THAT ADDING TRACKS IS NOT MANDATORY AND AN EMPTY PLAYLIST IS ACCEPTABLE */
?>



<html>
    <head>
        <title>Confirmation</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        
        <link rel="stylesheet" href="../master.css"/>



    </head>
    <body>
        <div class="col-lg-4">
<?php
if ($uploadOk == 0) {
    echo "<h3>No valid image detected, default loaded</h3>";
}
?>
            <img class="img-responsive" width="152" height="113" src="<?php echo $target_dir.$img_url ?>">
            <h1>PLaylist successfully created</h1>
        </div>




        <a class="btn btn-default" href="logon.php">Back to homepage</a>







    </body>
</html>
