<?php
// TiDB Cloud Connection parameters
$host = "gateway01.ap-southeast-1.prod.aws.tidbcloud.com";
$username = "y3exJBsV1ruN9mw.root";
$password = "Ip3OFyXAqV7huuR8";
$dbname = "test";
$port = 4000;

// Initialize connection with SSL
$con = mysqli_init();
mysqli_ssl_set($con, NULL, NULL, NULL, NULL, NULL);
mysqli_real_connect($con, $host, $username, $password, $dbname, $port, NULL, MYSQLI_CLIENT_SSL);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
