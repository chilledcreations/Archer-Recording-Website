<?php
$host = "feenix-mariadb.swin.edu.au";
$user = "cos20031_2"; // your user name
$pwd = ""; // Update with password :) 
$sql_db = "cos20031_2_db"; // your database


$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    echo "Connection failed!";
}
