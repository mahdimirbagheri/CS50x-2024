<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/styles2.css" type="text/css">
        <title>Sing In</title>
    </head>

    <body>
        <div class="wrapper">
            <h1>Login</h1>
            <form action="action_login.php" method="post">
                <input type="text" placeholder="username" name="username" id="username">
                <input type="Password" placeholder="password" name="password" id="password">
                <input class="Button" type="submit" value="Login">
                <input type="submit" class="Button" formaction="index.php" value="Exit">
            </form>
            <div class="member">
                You are member <a href="sing_up.php">
                    Sing Up</a>
            </div>
        </div>
        <?php
        if (isset($_SESSION["state_login"]) && $_SESSION["state_login"]===true)
        {
        ?>
        <script type="text/javascript">
        <!--
        location.replace("index.php");
        -->
        </script>
        <?php
        }
        ?>
    </body>
</html>
