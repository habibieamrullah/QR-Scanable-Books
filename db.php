<?php

$unm = "admin";
$pwd = "admin";
$baseurl = "https://perpus.id";
$booksitetitle = "Perpus";

//Database connection
$host = "localhost";
$dbuser = "user";
$dbpassword = "password";
$databasename = "db";

$connection = mysqli_connect($host, $dbuser, $dbpassword, $databasename);
$connection->set_charset("utf8"); 
