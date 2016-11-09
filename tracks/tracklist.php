<?php
include('Track.php');

session_start();
?>
<html>
    <head>
        <title>title</title>
        <link rel="stylesheet" href="../master.css"/>
    </head>
    <body>




<?php
if (empty($_POST['title']) || empty($_POST['year']) || empty($_POST['author'])) {
    header('location:accueil.php');
    $_SESSION['filled'] = false;
}
else {
    

        $t = new Track($_SESSION['id'], $_POST['title'], $_POST['year'], $_POST['duration'], $_POST['author']);
        array_push($_SESSION['trackList'], $t);

        $_SESSION['id']++;
        echo 'You have currently '.count(($_SESSION['trackList'])).' track(s) in your list.';
        
        echo "<table>";
        echo "<caption>Track List</caption>";
        for ($i=0; $i < count($_SESSION['trackList']); $i++) {
                 $_SESSION['trackList'][$i]->currentTrackDisplay();
                }
        echo '</table>';
        if ($_SESSION['filled'] == false) {
            $_SESSION['filled'] = true;
        }
    }
?>

<a href="accueil.php">Add track</a>

<a href="logout.php">Logout</a>






    </body>
</html>