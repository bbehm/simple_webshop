#!/usr/bin/php
<?php
// connecting to the mysql database
// got Warning: mysqli_connect(): (HY000/2002): No such file or directory when using "localhost"
// now getting: Warning: mysqli_connect(): (HY000/1045): Access denied for user... using password: YES
// UPDATE: finally managed to connect to the database!

$database = mysqli_connect('localhost:3307', 'root', 'rootroot');
if(!mysqli_query($database, "CREATE DATABASE IF NOT EXISTS rush00")) {
	exit("Query error\n");
}
$database = mysqli_connect('localhost:3307', 'root', 'rootroot', 'rush00');
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
}

// create table for available items on site

// create table for an order (of current user)

// create table for all user info

?>