<?php

function exit_error($str) {
	exit("ERROR: " . $str . "\n");
}

// connecting to the mysql database

$database = mysqli_connect('localhost:3307', 'root', 'rootroot');
if ($database == false) {
	exit("Connection error\n");
}
mysqli_query($database, "CREATE DATABASE IF NOT EXISTS rush00");
$database = mysqli_connect('localhost:3307', 'root', 'rootroot', 'rush00');
if ($database == false) {
	exit("Conenction error\n");
}
if (mysqli_connect_errno()) {
	echo "Connection failed: " . mysqli_connect_error();
	exit ();
}

// create table for available items on site, still need to check what info is needed

$sql_command = "CREATE TABLE IF NOT EXISTS items (
	itemId int(100) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	itemName varchar(100) NOT NULL,
	category varchar(100) NOT NULL,
	subcategory varchar(100) NOT NULL,
	itemDescription varchar(500) NOT NULL,
	price int(100) NOT NULL
	);";
mysqli_query($database, $sql_command) or exit_error(mysqli_error($database));

// create table for all user info, still need to check what info is needed

$sql_command = "CREATE TABLE IF NOT EXISTS users (
	userId int(100) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username varchar(100),
	passwd varchar(100)
	);";
mysqli_query($database, $sql_command) or exit_error(mysqli_error($database));

// create table for orders, still need to check what info is needed

$sql_command = "CREATE TABLE IF NOT EXISTS orders (
	orderId int(100) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	userId int(100) NOT NULL,
	username varchar(200),
	remoteAddr varchar(200),
	itemName varchar(200),
	itemPrice int (100),
	ordered int (5),
	orderDate timestamp
	);";
mysqli_query($database, $sql_command) or exit_error(mysqli_error($database));

?>