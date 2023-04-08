<?php

$unm = "admin";
$pwd = "admin";
$baseurl = "https://website.com";
$booksitetitle = "Scan Buku";

//Database connection
$host = "localhost";
$dbuser = "user";
$dbpassword = "password";
$databasename = "db";

$connection = mysqli_connect($host, $dbuser, $dbpassword, $databasename);
$connection->set_charset("utf8"); 
