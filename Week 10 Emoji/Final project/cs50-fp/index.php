<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <link href="css/styles.css" rel="stylesheet">
        <title>My Webpage</title>
    </head>

    <body>
        <header class="header">
            <nav class="navbar">
                <h2 class="logo"><a href="index.html">Smahdimirbagheri</a> <span class="badge bg-secondary">
                    <?php if (isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true)
                    {
                    ?>
                    <a href="logout.php">Sing Out
                    <?php echo ("({$_SESSION["name"]})")?>
                    <?php
                    } // if
                    ?>
            </span></h2>
                <input type="checkbox" id="menu-toggle" />
                <label for="menu-toggle" id="hamburger-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                        <path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </label>
                <ul class="links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="handout.php">Handouts</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
                <div class="buttons">
                    <form>
                        <button formaction="sing_in.php" type="submit" class="btn btn-info">Sign In</button>
                        <button formaction="sing_up.php" type="submit" class="btn btn-outline-info">Sign Up</button>
                    </form>
                </div>
            </nav>
        </header>
        <section class="hero-section">
            <div class="hero">
                <h2>Seyed Mahdi Mirbagheri</h2>
                <p>
                    Join us in the exciting world of programming and turn your ideas into
                    reality. Unlock the world of endless possibilities - learn to code and
                    shape the digital future with us.
                </p>
                <div class="buttons">
                    <form>
                        <button formaction="sing_up.php" type="submit" class="btn btn-info">Join Now</button>
                        <button formaction="handout.php" type="submit" class="btn btn-outline-info">Learn More</button>
                    </form>
                </div>
            </div>
            <div class="img">
                <img src="img/msammi.jpg" alt="hero image" />
            </div>
        </section>

    </body>

</html>
