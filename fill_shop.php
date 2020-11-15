#!/usr/bin/php
<?php

$database = mysqli_connect('localhost:3307', 'root', 'rootroot', 'rush00');

if (mysqli_connect_errno()) {
	echo "Connection failed: " . mysqli_connect_error();
	exit ();
}

mysqli_query($database, "INSERT INTO rush00.items (itemName, category, subcategory, itemDescription, price) VALUES ('Dog treat','food', 'treats', 'Yummy!', 10)");
mysqli_query($database, "INSERT INTO rush00.items (itemName, category, subcategory, itemDescription, price) VALUES ('Dog treat','food', 'treats', 'Yummy!', 10)");
mysqli_query($database, "INSERT INTO rush00.items (itemName, category, subcategory, itemDescription, price) VALUES ('Dog treat','food', 'treats', 'Yummy!', 10)");
mysqli_query($database, "INSERT INTO rush00.items (itemName, category, subcategory, itemDescription, price) VALUES ('Dog treat','food', 'treats', 'Yummy!', 10)");
mysqli_query($database, "INSERT INTO rush00.items (itemName, category, subcategory, itemDescription, price) VALUES ('Dog treat','food', 'treats', 'Yummy!', 10)");
mysqli_query($database, "INSERT INTO rush00.items (itemName, category, subcategory, itemDescription, price) VALUES ('Dog treat','food', 'treats', 'Yummy!', 10)");
mysqli_query($database, "INSERT INTO rush00.items (itemName, category, subcategory, itemDescription, price) VALUES ('Dog treat','food', 'treats', 'Yummy!', 10)");

?>