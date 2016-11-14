<?php

session_start();
include(dirname(__FILE__) . '/dao/UserStore.php');
$name = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);


if (!(UserStore::checkUserName($name))) {
    $_SESSION['usr_not_found'] = true;
    header('location:homepage.php');
} else {

    if (UserStore::checkUserPass($name, $password)) {

        $_SESSION['currentUser'] = $name;

        header('location:homepage.php');
    } else {
        $_SESSION['wrongPassword'] = true;
        header('location:homepage.php');
    }
}
                    
               
                    
                
            
         


