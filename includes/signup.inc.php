<?php
    // handles the signup form

    // avoid direct access to this file, only by click signup-submit button
    if (isset($_POST['signup-submit'])) {

        require 'dbh.inc.php';  # our own db handler

        $username = $_POST['uid'];
        $email = $_POST['mail'];
        $password = $_POST['pwd'];
        $passwordRepeat = $_POST['pwd-repeat'];

        # check if input(s) empty
        if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
            # go back to signup form with error header
            header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);

            # prevent running further code on this file 
            exit();
        }# check correct uid AND correct mail
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zAZ0-9]*$/", $username)) {
            header("Location: ../signup.php?error=invalidmailuid&uid=".$username."&mail=".$email);
            exit();
        }# check if email valid
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?error=invalidmail&uid=".$username."&mail=".$email);
            exit();
        }# check if valid name (regex searchpattern)
        elseif (!preg_match("/^[a-zAZ0-9]*$/", $username)) {
            header("Location: ../signup.php?error=invaliduid&uid=".$username."&mail=".$email);
            exit();
        }# check password eq password repeat
        elseif ($password !== $passwordRepeat) {
            header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
            exit();
        }# check if username is already used
        else {
            $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
            $stmt = mysqli_stmt_init($conn);
            # rule: allways check for errors first when you create php code :)
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../signup.php?error=sqlerror&uid=".$username."&mail=".$email);
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "s", $username); // s=string, one string
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);

                # check if user exist
                if ($resultCheck > 0) {
                    header("Location: ../signup.php?error=usertaken&uid=".$username."&mail=".$email);
                    exit();
                }# sign in user
                else {
                    $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../signup.php?error=sqlerror&uid=".$username."&mail=".$email);
                        exit();
                    }
                    else {

                        $hashedPwd = password_hash($password, PASSWORD_DEFAULT); // method more secure than md5 etc. because this method will be updated by php

                        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd); // three strings
                        mysqli_stmt_execute($stmt);
                        header("Location: ../signup.php?signup=success");
                        exit();
                    }
                }
            }

            mysqli_stmt_close($stmt);
            mysql_close($conn);

        }
        
    }# send back if no postvars set (where are you coming from?)
    else {
        header("Location: ../signup.php");
        exit();
}