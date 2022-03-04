<?php

$dbhost  = "127.0.0.1:3307";
$dbuser  = "root";
$dbpass  = "";
$dbname  = "login_user";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

    die("Failed to connect!");
}
