<?php

$dbhost  = "localhost";
$dbuser  = "root";
$dbpass  = "root";
$dbname  = "login_user";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

    die("Failed to connect!");
}
