<?php
    require "header.php";
?>

    <main>
        <h1>Signup</h1>
        <?php
            if (isset($_GET['error'])) {

                if ($_GET['error'] == "emptyfields") {

                    echo '<p class="signuperror">Fill in all fields!</p>';

                }# print error if username and e-mail is invalid

                elseif ($_GET['error'] == "invalidmailuid") {

                    echo '<p class="signuperror">Invalid username and e-mail!</p>';

                }# print error if email invalid

                elseif ($_GET['error'] == "invalidmail") {

                    echo '<p class="signuperror">Invalid e-mail!</p>';

                }# print error if invalid name

                elseif ($_GET['error'] == "invaliduid") {

                    echo '<p class="signuperror">Invalid username!</p>';

                }# print error is passwords not matches

                elseif ($_GET['error'] == "passwordcheck") {

                    echo '<p class="signuperror">Your passwordes do not match!</p>';

                }# print error if sql error happens

                elseif ($_GET['error'] == "sqlerror") {

                    echo '<p class="signuperror">Ups - Database error!</p>';

                }# print error is username is already taken

                elseif ($_GET['error'] == "usertaken") {

                    echo '<p class="signuperror">Username is already taken!</p>';

                }

            }# print succeed message

            elseif (isset($_GET['signup'])) {

                if ($_GET['signup'] == "success") {

                    echo '<p class="signupsuccess">Signup successful!</p>';

                }

            }

        ?>
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username">
            <input type="text" name="mail" placeholder="E-Mail">
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwd-repeat" placeholder="Repeat password">
            <button type="submit" name="signup-submit">Signup</button>
        </form>
    </main>

<?php
    require "footer.php";
?>
