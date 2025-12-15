<?php
// Detect if running on localhost or production server
$is_localhost = ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1' || $_SERVER['HTTP_HOST'] === 'localhost:80' || $_SERVER['HTTP_HOST'] === 'localhost:8080');

if ($is_localhost) {
    // Localhost configuration
    $mysql_hostname = "localhost";
    $mysql_user = "root";
    $mysql_password = "Uts@v1907";
    $mysql_database = "cms";
} else {
    // Hostinger (Production) configuration
    $mysql_hostname = "localhost";  // Change this to your Hostinger database host
    $mysql_user = "u221873998_utsav";       // Change this to your Hostinger database user
    $mysql_password = "Uts@v1907";   // Change this to your Hostinger database password
    $mysql_database = "u221873998_cms";   // Change this to your Hostinger database name
}

$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or die("Could not connect database");

?>