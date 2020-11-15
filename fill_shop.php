#!/usr/bin/php
<?php

$database = mysqli_connect('localhost:3307', 'root', 'rootroot', 'rush00');

if (mysqli_connect_errno()) {
	echo "Connection failed: " . mysqli_connect_error();
	exit ();
}

mysqli_query($database, "INSERT INTO rush00.items (itemName, category, subcategory, itemDescription, price) VALUES ('Dog treat','food', 'dogs', 'Yummy for your dog!', 8)");
mysqli_query($database, "INSERT INTO rush00.items (itemName, category, subcategory, itemDescription, price) VALUES ('Dog food','food', 'dogs', 'Help your dog stay strong and healthy!', 10)");
mysqli_query($database, "INSERT INTO rush00.items (itemName, category, subcategory, itemDescription, price) VALUES ('Cat food','food', 'cats', 'Your kitty will thank you for this!', 9)");
mysqli_query($database, "INSERT INTO rush00.items (itemName, category, subcategory, itemDescription, price) VALUES ('Dog collar','accessories', 'dogs', 'A cute collar for your best friend!, 15)");
mysqli_query($database, "INSERT INTO rush00.items (itemName, category, subcategory, itemDescription, price) VALUES ('Cat collar','accessories', 'cats', 'Your kitten will be happy to wear this!', 13)");
mysqli_query($database, "INSERT INTO rush00.items (itemName, category, subcategory, itemDescription, price) VALUES ('Litter box','accessories', 'cats', 'The litter box that will keep both you and your feline friend happy!', 35)");
mysqli_query($database, "INSERT INTO rush00.items (itemName, category, subcategory, itemDescription, price) VALUES ('Dog leash','accessories', 'dogs', 'Flex leash for happy walks!', 19)");
mysqli_query($database, "INSERT INTO rush00.items (itemName, category, subcategory, itemDescription, price) VALUES ('Dog squeeky toy','accessories', 'dogs', 'THE toy for your dog!', 6)");
mysqli_query($database, "INSERT INTO rush00.items (itemName, category, subcategory, itemDescription, price) VALUES ('Cat toy','accessories', 'cats', 'This will keep you kitty entertained!', 5)");

?>