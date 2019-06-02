<?php

$con = mysqli_connect("localhost","root","", "quiz_app");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>