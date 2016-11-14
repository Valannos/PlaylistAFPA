<?php
session_start();
define('SQL_DSN', 'mysql:host=localhost;dbname=Test;charset=utf8');
define('SQL_USER', 'root');
define('SQL_PASSWORD', 'admin');

//if (!(isset($_SESSION['add_success']))) {
//    $_SESSION['add_success'] = false;
//}
//if (!isset($_SESSION['remove_success'])) {
//    $_SESSION['remove_success'] = false;
//}


$pdo = new PDO(SQL_DSN, SQL_USER, SQL_PASSWORD);
$getUsers = $pdo->prepare('SELECT u.user_id, u.email, u.username, COUNT(pu.playlist_id) AS "playlist_number" 
FROM user u 
INNER JOIN playlist_user pu
ON pu.user_id = u.user_id
GROUP BY u.user_id
');

$getUsers->execute();

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="../master.css"/>
        <title>title</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" > 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

    </head>
    <body>



        <table class="table table bordered">

            <caption>Current registered users</caption>
            <thead>
                <tr >
                    <th class="text-center">User</th>
                    <th class="text-center">User email</th>
                    <th class="text-center">Number of playlists</th>
                    <th class="text-center">Edit user (admin)</th>
                    <th class="text-center">Delete user (admin)</th>
                    
                </tr>
            </thead>
            <tbody>

                <?php


                while ($donnees = $getUsers->fetch()) {
                    echo '<tr>';
                    echo '<td><strong>' . $donnees['username'] . '('.$donnees['user_id'].')</td>';
                    echo '<td>' . $donnees['email'] . '</td>';
                    echo '<td>' . $donnees['playlist_number'] . '</td>';
                   
                    ?>
                <td><a class="btn btn-warning" href="editUser.php?trckId=<?php echo $donnees['id'] ?>&AMP;plId=<?php echo $playlistId ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                </td>
                <td><a class="btn btn-danger" href="removeUser.php?userId=<?php echo $donnees['user_id'] ?>"><i class="fa fa-minus" aria-hidden="true"></i></a></td> 


                <?php
//                echo '</tr>';
////                    if ($_SESSION['already_present']) {
////                        echo '<h4 class="error">Already in playlist</h4>';
////                        $_SESSION['already_present'] = false;
////                    }
//                if ($_SESSION['add_success']) {
//                    echo '<h4>Track successfully added</h4>';
//                    $_SESSION['add_success'] = false;
//                }
//                if ($_SESSION['remove_success']) {
//                    echo '<h4>Track successfully removed from playlist</h4>';
//                    $_SESSION['remove_success'] = false;
//                }
            }
            ?>

        </tbody>
        <tfoot>
            <tr>


            </tr>
        </tfoot>
    </table>
    <a class="btn btn-success" href="playlist_list.php">back to playlist inventory</a>
</body>
</html>

