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
        <title>Sing Up</title>
        <script type="text/javascript">
            function Check() {
                var Username = "";
                Username = document.getElementById("username").value;
                if (Username == "")
                    alert("Enter Username and Password");
                var r = confirm("Are you sure you entered the information correctly?");
                if (r == true) {
                    document.register.submit();
                }
            }
        </script>
    </head>

    <body>
        <div class="wrapper">
            <h1>Sing Up</h1>
            <form action="action_sing_up.php" method="post">
                <input type="text" placeholder="name" name="name" id="name">
                <input type="text" placeholder="lastname" name="lastname" id="lastname">
                <input type="text" placeholder="username" name="username" id="username">
                <input type="Password" placeholder="passwoed" name="password" id="password">
                <input type="Password" placeholder="repassword" name="re_password" id="re_password">
                <input type="email" placeholder="email" name="email" id="email">
                <div class="trems">
                    <input type="checkbox" name="checkbox" id="checkbox">
                    <Label for="checkbox"> I agree with these <a href="#"> terms and condition </a></Label>
                </div>
                <input class="Button" type="submit" value="Sing Up" onclick="Check()" ;>
                <input type="submit" class="Button" formaction="index.php" value="Exit">
            </form>
            <div class="member">
                You are member <a href="sing_in.php">
                    Login</a>
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
