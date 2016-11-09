<?php
            
            session_start();
            //CHECK AND RETURN ERROR MESSAGE IF USERNAME IS ALREADY USED 
            define('SQL_DSN','mysql:host=localhost;dbname=Test;charset=utf8');
            define('SQL_USER','root');
            define('SQL_PASSWORD','admin');
            

            $pdo = new PDO(SQL_DSN,SQL_USER,SQL_PASSWORD);
            $hash_pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);

            $check_user = $pdo->prepare('SELECT * FROM user');
            $check_user->execute();
            while ($donnees = $check_user->fetch()) {
                if ($donnees['username'] === $_POST['username']) {
                     $_SESSION['usr_not_valid'] = true;
                     header('location:logon.php'); 
                }
                
                
               
                
            }
                
                if (empty($_POST['username'])) {
                $_SESSION['empty_username'] = true;    
                header("location:logon.php");
                    
                }
                if (empty($_POST['pass'])) {
                    $_SESSION['empty_password'] = true; 
                    header("location:logon.php");
}
            else {
                
                $addUser = $pdo->prepare('INSERT INTO user (username, password, email) VALUES (:username, :password, :email)');
                $addUser->bindValue('username', $_POST['username']);
                $addUser->bindValue('password', $hash_pass);
                $addUser->bindValue('email', 'none');
                $addUser->execute();
                
                echo '<p> New user has been registered</p>';
                echo '<a href = "logon.php">Retour</a>';

            }
            
            
            
            
   ?>
