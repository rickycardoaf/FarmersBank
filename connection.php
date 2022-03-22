<?php

$dbhost  = "localhost";
$dbuser  = "root";
$dbpass  = "root";
$dbname  = "login_user";

//$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

    die("Failed to connect!");
}

// if ($con->connect_error) {
//     die("Connection failed: " . $con->connect_error);
// }else{
// }