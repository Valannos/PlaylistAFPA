<form class="col-lg-4" action="login_confirm.php" method="post">
            <legend>Please login...</legend>
            <label  for="username">Username</label>
            <input class="form-control" type="text" id="username" name="username" </input>
            <label for="pass">Password</label>
            <input class="form-control" type="password" id="pass" name="pass" </input>
            <hr/>
            <button class="btn btn-primary" type="submit">Connect</button>
            <button class="btn btn-default" type="reset">Reset</button>
            <?php if ($_SESSION['usr_not_found'] == true) {
                   
                $_SESSION['usr_not_found'] = false;
                
                echo '<div class = "error" >USER DOESN\'T EXIST</div>';
            } 
            if ($_SESSION['wrongPassword'] == true) {
                
                 $_SESSION['wrongPassword'] = false;
                echo '<div class = "error" >USERNAME AND PASSWORD DON\'T MATCH.</div>';
            }
            
            ?>
            
            
            
            
            
            
        </form>