
    <div class="login-page">

        <div class="form" >
<!--          <div id="loading-img"></div>-->
          <img src="img/sme_analytics_logo.png" a?lt="logo" />
          <hr>
            <form class="login-form" role="form" method="post">

                    <div class="form-group">
        <!--                <label for="username_input">User Name</label>-->
                        <input type="text" class="form-control" id="username_input" name="username" placeholder="Enter User Name" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password_input" name="password" placeholder="Enter Password" required>
                    </div>
        <!--                <div class="col-sm-6"><button type="button" class="btn pull-left" onclick="window.location.href='index.php'">Back</button></div>-->

                <button id="button" type="submit" name="submit" class="btn btn-primary pull-right">Login</button>

            </form>

        <!--            <p class="message">Forgotten Password? <a href="#">Click Here</a></p>-->
                    <p class="text-center" style="margin-top:90px"><a href="index" class="button"><font color="white">Return Home</font></a></p>

        </div>

    </div>

    <?php

        //When submit button is pressed, run the following code
        if(isset($_POST['submit'])) {

                $username            = mysqli_real_escape_string($conn, $_POST['username']);
                $password            = mysqli_real_escape_string($conn, $_POST['password']);


                $user_success        = mysqli_query($conn, "SELECT user_id, password, role_id,
                                                            RAND()*user_id as rand_user_id
                                                            FROM user_login
                                                            WHERE status = 1
                                                            AND UPPER(username) = UPPER('$username')
                                                            ;");
                $sess_user_id        = 0;

                $server              = $_SERVER['SERVER_NAME'];

                if(mysqli_num_rows($user_success)==0) {
                     ?> <script>
                                alert("Email address or Password not recognised, please try again!!");
                                location.href =  'index.php';
                        </script> <?php
                }

                else {

                    while ($data = mysqli_fetch_array($user_success)) {

                                $sess_user_id           = mysqli_real_escape_string($conn, $data['user_id']);
                                $rand_user_id           = mysqli_real_escape_string($conn, $data['rand_user_id']);
                                $hashed_password        = mysqli_real_escape_string($conn, $data['password']);
                                $role_id                = mysqli_real_escape_string($conn, $data['role_id']);

                        }

                    if(password_verify($password, $hashed_password)) {

                                        $active_session                 = md5($rand_user_id);
                                        $_SESSION['active_session']     = $active_session;
                                        $_SESSION['role_id']            = $role_id;
                                        setcookie("active_session",$_SESSION["active_session"],time()+86400*30);

                                        mysqli_query($conn, "UPDATE user_login SET active_session = '$active_session' WHERE user_id = $sess_user_id;");
    //                                    echo $active_session;
                                        ?><script>  location.href = 'index.php'; </script> <?php
                    }

                    else {
                        ?>
                            <script>
                                alert("Username or Password not recognised, please try again!!");
                                session_destroy(); //destroy the session
                                location.href =  'index.php';
                            </script>
                        <?php

                    }


                }

        }

    ?>
