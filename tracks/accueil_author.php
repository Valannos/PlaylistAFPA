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
        <title>Add Author</title>


    </head>
    <body>
        <div class="container">

            <form class="well form-horizontal" action="add_author.php" method="post">



                <h1 class="text-center">Author data formular</h1>

                <div class="form-group"> 

                <div class="form-group">
                    <label class="control-label col-md-offset-2 col-md-2" for="author" >Artiste Name</label>
                    <div class="col-md-4">
                        <input class= "form-control" type="text" id="author" name="author" placeholder="Ex. Iron Maiden">
                    </div>
                </div>
                <div class="text-center">
                    <input  type="text" value="true" name="form_yes" hidden>
                    
                    <input class="btn btn-success"  type="submit" value="Submit author to database">
                  
                </div>  


            </form>
        </div>
        <footer>
            <a class="btn btn-danger" href="logout.php">Logout</a>
            <a class="btn btn-primary" href="author_list.php">Access authorlist</a>
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