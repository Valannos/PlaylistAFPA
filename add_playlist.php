


<?php
/* THIS PAGE APPEARS WHEN USER SUBMIT NEW PLAYLIST PROVIDING ALL FIELDS HAVE BEEN FILLED */


session_start();

require_once (dirname(__FILE__) . '/config.inc.php');
require_once (dirname(__FILE__) . '/model/Playlist.class.php');
require_once (dirname(__FILE__) . '/dao/DB.php');
require_once (dirname(__FILE__) . '/dao/UserStore.php');
require_once (dirname(__FILE__) . '/dao/PlaylistStore.php');

$name = filter_input(INPUT_POST, 'playlist_name', FILTER_SANITIZE_STRING);






if (empty($name)) {
    header('location:form_playlist.php');
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
            $img_url = "default.png";
        }
    }


    /* NEWLY CREATED PLAYLIST IS ADDED TO PLAYLIST_USER TABLE AND AN ID AS PRIMARY KEY WILL BE CREATED */

    if (!isset($_SESSION['currentUser'])) {
        $_SESSION['currentUser'] = 'admin';
    }


    $pl = new Playlist($id = NULL, $userId = UserStore::getIdFromUserName($_SESSION['currentUser']), $name, $img_url);
    PlaylistStore::save($pl);
}
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
            <img class="img-responsive" width="152" height="113" src="<?php echo $target_dir . $img_url ?>">
            <h1>PLaylist successfully created</h1>
        </div>




        <a class="btn btn-default" href="homepage.php">Back to homepage</a>







    </body>
</html>
