<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="This is a php login Project by working a tutorial">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Login System Tutorial</title>

    </head>
    <body>

        <header>
            <nav>
                <a href="#">
                    LOGO
                </a>
                <ul>
                    <li><a href="index.php"></a>Home</li>
                    <li><a href="#"></a>Portfolio</li>
                    <li><a href="#"></a>About me</li>
                    <li><a href="#"></a>Contact</li>
                </ul>
                <div>
                    <?php
                        if (isset($_SESSION['userId'])) {
                            echo '
                                <form action="includes/logout.inc.php" method="post">
                                    <button type="submit" name="logout-submit">Logout</button>
                                </form>';
                        }
                        else {
                            echo '
                            <form action="includes/login.inc.php" method="post">
                                <input type="text" name="mailuid" placeholder="Username/E-mail...">
                                <input type="password" name="pwd" placeholder="Password...">
                                <button type="submit" name="login-submit">Login</button>
                            </form>
                            <a href="signup.php">Signup</a>';
                        }
                    ?>
                    
                </div>
            </nav>
        </header>
