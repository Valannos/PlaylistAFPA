<?php
session_start();


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
        <title>Add Genre</title>


    </head>
    <body>
        <div class="container">

            <form class="well form-horizontal" action="add_genre.php" method="post">



                <h1 class="text-center">Genre data formular</h1>

                <div class="form-group"> 

                <div class="form-group">
                    <label class="control-label col-md-offset-2 col-md-2" for="genre" >Genre</label>
                    <div class="col-md-4">
                        <input class= "form-control" type="text" id="genre" name="genre" placeholder="Ex. Classical">
                    </div>
                </div>
                <div class="text-center">
                    <input  type="text" value="true" name="form_yes" hidden>
                    
                    <input class="btn btn-success"  type="submit" value="Submit genre to database">
                  
                </div>  


            </form>
        </div>
        <footer>
            <a class="btn btn-danger" href="logout.php">Logout</a>
            <a class="btn btn-primary" href="genre_list.php">Open genrelist</a>
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