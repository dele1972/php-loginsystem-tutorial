<?php

$servername = "mysql:3306";
$dBUsername = "root";
$dBPassword = "docker";
$dBName = "loginsystemtut";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}