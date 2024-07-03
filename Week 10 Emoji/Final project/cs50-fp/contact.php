<!doctype html>
<html lang="en">
<?php
session_start();
if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true)) {
?>
<script type="text/javascript">
<!--
location.replace("index.php");	 // منتقل شود index.php به صفحه
-->
</script>
<?php
} // if پایان
$link = mysqli_connect("localhost", "root", "", "cs50");

if (mysqli_connect_errno())
    exit("خطاي با شرح زير رخ داده است :" . mysqli_connect_error());

$query = "SELECT * FROM users WHERE username='{$_SESSION['username']}'";
$result = mysqli_query($link, $query);
if ($row = mysqli_fetch_array($result)) {

    $name = $row['name'];
    $email = $row['email'];
}

?>
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <link href="css/styles5.css" rel="stylesheet" type="text/css">
        <title>Contact Us</title>
    </head>
    <body>
        <form name="contact" action="action_contact.php"  method="POST">
            <div class="contact-in">
                <div class="contact-map"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11790.010731145765!2d-71.1182488!3d42.3744368!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e377427d7f0199%3A0x5937c65cee2427f0!2sHarvard%20University!5e0!3m2!1sen!2s!4v1719661994362!5m2!1sen!2s" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="contact-form">
                    <h1>Contact Us</h1>
                    <form name="contact" action="action_contact.php"  method="POST"  >
                        <input class="contact-form-input" type="text" id="realname" name="realname" value="<?php echo ($name) ?>"/>
                        <input class="contact-form-input" type="text" id="email" name="email" value="<?php echo ($email) ?>"/>
                        <textarea name="detail" id="detail" placeholder="message" class="contact-form-message"></textarea>
                        <input type="submit" name="Submit" class="contact-form-btn">
                        <br>
                        <br>
                        <input name="Exit" type="submit" class="contact-form-btn" formaction="index.php" value="Exit">
  <br/>
                    </div>
                </form>
            </div>
        </body>
    </html>
