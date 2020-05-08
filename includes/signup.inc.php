<?php
    // handles the signup form

    // avoid direct access to this file, only by click signup-submit
    if (isset($_POST['signup-submit'])) {

        require 'dbh.inc.php';

        $username = $_POST['uid'];
        $email = $_POST['mail'];
        $password = $_POST['pwd'];
        $passwordRepeat = $_POST['pwd-repeat'];

        if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
            # code...
            header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        }
        
    }