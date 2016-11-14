<?php
session_start();

if (!isset($_SESSION['usr_not_found'])) {
    $_SESSION['usr_not_found'] = false;
}

if (!(isset($_SESSION['usr_not_valid']))) {
    $_SESSION['usr_not_valid'] = false;
}
if (!(isset($_SESSION['empty_username']))) {
    $_SESSION['empty_username'] = false;
}
if (!(isset($_SESSION['empty_password']))) {
    $_SESSION['empty_password'] = false;
}
if (!(isset($_SESSION['wrongPassword']))) {
    $_SESSION['wrongPassword'] = false;
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>title</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="../master.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" > 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>

        <!--CAROUSEL-->
        <div class="carousel slide" id="main-carousel" data-ride="carousel">

            <ol class="carousel-indicators">
                <li data-target="#main-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#main-carousel" data-slide-to="1"></li>
                <li data-target="#main-carousel" data-slide-to="2"></li>

            </ol>

            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="playlists_img/rock_img.jpg" alt="rock">
                </div>
                <div class="item">
                    <img src="playlists_img/classic_img.png" alt="classic">

                </div>
                <div class="item">
                    <img src="playlists_img/metal_img.gif" alt="metal">

                </div>
            </div>
            <a class="left carousel-control" href="#main-carousel" role="button" data-slide="prev">
                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>


            </a>
            <a class="right carousel-control" href="#main-carousel" role="button" data-slide="next">

                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                <span class="sr-only">Next</span>

            </a>



        </div>

        <nav class ="container">

            <div class="row">

                <div class="col-lg-12 text-capitalize"><h1>Welcome to tracklist !</h1></div>

            </div>


<?php
/* STRATING FROM THIS POINT, ALL FIELDS, BUTTONS ETC... WILL BE DISPLAYED ONLY 
 * IF !!!NO!!!! VALID USER IS LOGGED
 */


if (!isset($_SESSION['currentUser'])) {
    $_SESSION['userLogged'] = false;
    echo '<h3 class = "row">Your are currently not logged</h3>';
    ?>
                <!--LOGIN FORMULAR-->

                <form class="col-lg-4 well" action="login_user.php" method="post">
                    <legend><i class="fa fa-user" aria-hidden="true"></i> Please login...</legend>
                    <div    class="form-group">
                        <label  for="username">Username</label>
                        <input class="form-control" type="text" id="username" name="username" </input>
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input class="form-control" type="password" id="pass" name="pass" </input>
                    </div>


                    <button class="btn btn-primary" type="submit">Connect</button>
                    <button class="btn btn-default" type="reset">Reset</button>

    <?php
    if ($_SESSION['usr_not_found'] == true) {

        $_SESSION['usr_not_found'] = false;

        echo '<div class = "error" >USER DOESN\'T EXIST</div>';
    }
    if ($_SESSION['wrongPassword'] == true) {

        $_SESSION['wrongPassword'] = false;
        echo '<div class = "error" >USERNAME AND PASSWORD DON\'T MATCH.</div>';
    }
    ?>

                </form>

                <!--REGISTER FORMULAR-->

                <form class="col-lg-offset-2 col-lg-4 well" action="add_user.php" method="post">
                    <legend><i class="fa fa-user-plus" aria-hidden="true"></i> ...or register</legend>
                    <div class="form-group">
                        <label  for="username"> Username</label>
                        <input class="form-control" type="text" id="username" name="username" required</input>
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input class="form-control" type="password" id="pass" name="pass" required</input>
                    </div>

                    <button class="btn btn-primary" type="submit">Register</button>
                    <button class="btn btn-default" type="reset">Reset</button>

    <?php
    if ($_SESSION['usr_not_valid'] == true) {

        $_SESSION['usr_not_valid'] = false;

        echo '<div class = "error" >USERNAME ALREADY USED</div>';
    }

    if ($_SESSION['empty_username'] == true) {

        $_SESSION['empty_username'] = false;
        echo '<div class = "error" >USERNAME FIELD IS EMPTY</div>';
    }



    if ($_SESSION['empty_password'] == true) {

        $_SESSION['empty_password'] = false;


        echo '<div class = "error" >PASSWORD FIELD IS EMPTY</div>';
    }
    ?>

                </form>

    <?php
    /* STRATING FROM THIS POINT, ALL FIELDS, BUTTONS ETC... WILL BE DISPLAYED ONLY 
     * IF A VALID USER IS LOGGED
     */
} else {

    echo '<div class="row"><h3>Your are currently logged as ' . $_SESSION['currentUser'] . '.</h3></div>'
    . '<div class="row">';

    if ($_SESSION['currentUser'] === 'admin') {
        ?>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="btn-group btn-group-justified">
                                <a class="btn btn-primary" href="form_author.php"> <i class="fa fa-users" aria-hidden="true"></i> Add author</a>
                                <a class="btn btn-info" href="form_genre.php"> <i class="fa fa-tag" aria-hidden="true"></i> Add genre</a>
                                <a class="btn btn-primary" href="form_track.php"> <i class="fa fa-music" aria-hidden="true"></i> Add track</a>
                                <a class="btn btn-success" href="form_playlist.php"><i class="fa fa-list-alt" aria-hidden="true"></i> Create playlist</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="btn-group btn-group-justified">
                                <a class="btn btn-warning" href="manage_user.php"> <i class="fa fa-user-md" aria-hidden="true"></i> Manage users</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-offset-2 col-md-4">
        <?php
    } else {
        ?>
                        <div class="col-md-offset-2 col-md-8">
                        <?php
                    }
                    ?>                    

                        <div class="row">
                            <div class="btn-group  btn-group-justified">
                                <a class="btn btn-primary" href="list_author_from_database.php"><i class="fa fa-users" aria-hidden="true"></i> Open authorlist</a>
                                <a class="btn btn-info" href="list_genre_from_database.php"><i class="fa fa-tag" aria-hidden="true"></i> Open genrelist</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="btn-group  btn-group-justified">
                                <a class="btn btn-info"  href="list_track_from_database.php"><i class="fa fa-music" aria-hidden="true"></i> Open tracklist</a>
                                <a class="btn btn-success" data-toggle="tooltip" title="Displays your current playlists and their tracks" href="list_playlist_from_database.php"><i class="fa fa-list-alt" aria-hidden="true"></i> Open playlist</a>
                            </div>
                        </div>
                    </div>
    <?php
    echo '</div><br/>';
}
?>
                <div class="row">
                <?php
                if (isset($_SESSION['currentUser'])) {
                    ?>
                        <a class = "btn btn-danger btn-block" data-toggle="tooltip" title="Goodbye !" href="logout.php"><i class="fa fa-user-times" aria-hidden="true"></i> Click here to disconnect</a>
                        <?php
                        if ($_SESSION['currentUser'] != 'admin') {
                            echo '<a class="btn btn-warning btn-block" href="edit_current_user_profile.php"><i class="fa fa-user-circle" aria-hidden="true"></i> Edit your profile</a>';
                        }
                    }
                    ?>
                </div>
        </nav>

    </body>
</html>
