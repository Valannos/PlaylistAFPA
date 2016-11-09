<?php

session_start();
            //CHECK AND RETURN ERROR MESSAGE IF USERNAME IS ALREADY USED 
            define('SQL_DSN','mysql:host=localhost;dbname=Test;charset=utf8');
            define('SQL_USER','root');
            define('SQL_PASSWORD','admin');
            

            $pdo = new PDO(SQL_DSN,SQL_USER,SQL_PASSWORD);
          
        

            $check_user = $pdo->prepare('SELECT username FROM user WHERE username= :usr');
            $check_user->bindValue('usr', $_POST['username']);
            $check_user->execute();
            
            
          
                if (!(isset($check_user->fetch()['username']))) {
                     $_SESSION['usr_not_found'] = true;
                     header('location:logon.php'); 
                }
                else   {
                       $checkPass = $pdo->prepare('SELECT password FROM user WHERE username = :usr');
            $checkPass->bindValue('usr', $_POST['username']);
            $checkPass->execute();
            if (password_verify($_POST['pass'], $checkPass->fetch()['password'])) {
                    
                $_SESSION['currentUser'] = $_POST['username'];
                
                header('location:logon.php'); 
                
                
            }
            else 
            {
                $_SESSION['wrongPassword'] = true;
                header('location:logon.php'); 
            }
                }
                    
               
                    
                
            
         


