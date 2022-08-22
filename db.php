<?php
// This function is making possible for us to connect with MySQL database
// To use it enter your Host, username, password, database below.
$connection = mysqli_connect("localhost","root","","restapi");
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}

?>