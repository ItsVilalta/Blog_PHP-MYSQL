<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "blog";

$db = mysqli_connect($host, $user, $password, $database);

mysqli_query($db, "SET NAMES 'utf8'");

?>