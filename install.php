<?php
// connecting to the mysql database
// got Warning: mysqli_connect(): (HY000/2002): No such file or directory when using "localhost"
// now getting: Warning: mysqli_connect(): (HY000/1045): Access denied for user... using password: YES
// UPDATE: finally managed to connect to the database!

function exit_error($str) {
	exit("ERROR: " . $str . "\n");
}

function connect_first() {
	$database = mysqli_connect('localhost:3307', 'root', 'rootroot');
	if(!mysqli_query($database, "CREATE DATABASE IF NOT EXISTS rush00")) {
		exit("Query error\n");
	}
	return ($database);
}

function connect() {
	$database = mysqli_connect('localhost:3307', 'root', 'rootroot', 'rush00');
	if (mysqli_connect_errno()) {
		echo "Connection failed: " . mysqli_connect_error();
		exit ();
	}
	return ($database);
}

$database = connect_first();
$database = connect();

// create table for available items on site, still need to check what info is needed
$sql_command = "CREATE TABLE IF NOT EXISTS items (
	itemId int(100) unsigned NOT NULL AUTO_INCREMENT,
	itemName varchar(100) NOT NULL,
	itemDescription varchar(500) NOT NULL,
	price int(100) NOT NULL,
	PRIMARY KEY (`id`)
);";
mysqli_query($database, $sql_command) or exit_error($mysqli_error($database));

// TO DO: investigate whether I need to connect again? Says $database is not defined/what it should be

// create table for all user info, still need to check what info is needed
/*
$database = connect();
$sql_command = "CREATE TABLE IF NOT EXISTS users (
	userId int(100) unsigned NOT NULL AUTO_INCREMENT,
	username varchar(100),
	passwd varchar(100)
	);";
mysqli_query($database, $sql_command) or exit_error($mysqli_error($database));

// create table for orders, still need to check what info is needed
$database = connect();
$sql_command = "CREATE TABLE IF NOT EXISTS orders (
	orderId int(100) unsigned NOT NULL AUTO_INCREMENT,
	userId int(100) NOT NULL,
	username varchar(200),
	remoteAddr varchar(200),
	itemName varchar(200),
	itemPrice int (100),
	ordered int (5),
	orderDate timestamp,
	);";
mysqli_query($database, $sql_command) or exit_error($mysqli_error($database));
*/
?>