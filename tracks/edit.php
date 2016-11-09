<?php
define('SQL_DSN', 'mysql:host=localhost;dbname=Test;charset=utf8');
define('SQL_USER', 'root');
define('SQL_PASSWORD', 'admin');




$pdo = new PDO(SQL_DSN, SQL_USER, SQL_PASSWORD);
$select_track = $pdo->prepare('SELECT * FROM track WHERE id = :id');
$select_track->bindValue('id', $_GET['id']);
$select_track->execute();
$title = $select_track->fetch()['title'];
$select_track->execute();
$year = $select_track->fetch()['year'];
$select_track->execute();
$duration = $select_track->fetch()['duration'];
$select_track->execute();
$authorId = $select_track->fetch()['authorid'];
$select_track->execute();
$genreId = $select_track->fetch()['genreid'];
$select_track->execute();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="../master.css"/>
        <title>title</title>

    </head>
    <body>


        <form action="confirm_edit.php" method="post">

            <fieldset>
                <div class="formular">
                    <legend>Track <strong>edit </strong>formular</legend>
                    <div class="labelfield"> 
                        <label  for="title" >Title track</label>
                        <input value="<?php echo $title ?>" type="text" id="title" name="title" placeholder="Ex. Fear of the Dark" name="title">
                    </div>
                    <div class="labelfield">
                        <label  for="year">Year</label> 
                        <input value="<?php echo (int) $year ?>" type="number" id="year" name="year" placeholder="Ex. 2001">
                    </div>
                    <div class="labelfield">
                        <label  for="duration">Duration in seconds</label>
                        <input  value="<?php echo (int) $duration ?>" id="duration" type="number" name="duration" placeholder="Ex. 120">
                    </div>
                    <div class="labelfield">
                        <label for="author" >Artiste Name</label>
                        <select id="author" name="author">
                            <?php
                            $authors = $pdo->prepare('SELECT * FROM author');
                            $authors->execute();
                            while ($donnees = $authors->fetch()) {
                                if ($authorId == $donnees['id']) {
                                    echo '<option value="' . $donnees['id'] . '" selected="selected">';
                                } else {
                                    echo '<option value="' . $donnees['id'] . '">';
                                }
                                echo $donnees['name'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="labelfield">
                        <label for="genre" >Genre</label>
                        <select id="genre" name="genre">
                            <?php
                            $genres = $pdo->prepare('SELECT * FROM genre');
                            $genres->execute();
                            while ($donnees = $genres->fetch()) {
                                if ($genreId == $donnees['id']) {
                                    echo '<option value="' . $donnees['id'] . '" selected="selected">';
                                } else {
                                    echo '<option value="' . $donnees['id'] . '">';
                                }
                                echo $donnees['name'];
                                echo '</option>';                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <input  type="submit" value="Confirm edit track">
                    </div>  
                    <div class="labelfield"> 

                        <input value="<?php echo (int) $_GET['id'] ?>" type="number" id="title" name="id" hidden>
                    </div>
                </div>
            </fieldset>         
        </form>
    </body>
</html>    

<?php




    

