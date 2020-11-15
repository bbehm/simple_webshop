<?php

function refresh_page() {
	header("Location: " . $_SERVER['REQUEST_URI']);
	exit();
}

if ($_GET['page'] == 'all') {
	$query_result = mysqli_query($database, "SELECT * FROM items;");
} else if ($_GET['page'] == 'food') {
	$query_result = mysqli_query($database, "SELECT * FROM items WHERE category='food' or subcategory='food';");
} else if ($_GET['page'] == 'dogs') {
	$query_result = mysqli_query($database, "SELECT * FROM items WHERE category='dogs' or subcategory='dogs';");
} else if ($_GET['page'] == 'cats') {
	$query_result = mysqli_query($database, "SELECT * FROM items WHERE category='cats' or subcategory='cats';");
} else if ($_GET['page'] == 'accessories') {
	$query_result = mysqli_query($database, "SELECT * FROM items WHERE category='accessories' or subcategory='accessories';");
}

echo "<div class='body_area_two'><h1>You are viewing in admin mode!</h1>";
echo "<div class='box'>";
		$item_id = 0;
		foreach ($query_result as $item) {
			echo "<h2>" . $item['itemName'] . "</h2>";
			echo "<p>" . $item['itemDescription'] . "</p>";
			echo "<p>" . $item['price'] . "€</p>";
			echo "<a><form method='post'><input type='hidden' name='hidden' value='$item_id'><input type='submit' name='submit' value='Add to Basket'></form></a>";
			echo "<br />";
			$item_id = $item['itemId'];
			echo "<form action='' method='post'>";
			echo "<input type='hidden' name='item_id' value='{$item_id}'>";
			echo "<input type='submit' name='delete_item' value='Delete'>";
			echo "<input type='submit' name='modify_item' value='Edit'>";
			echo "</form>";
		}
echo "</div></div>";

if (isset($_POST['submit']) && $_POST['submit'] == 'Add to Basket') {
	$item_id = (int)$_POST['hidden'];

	$remote_addr = $_SERVER['REMOTE_ADDR'];
	if (strstr($remote_addr, "::")) {
		$remote_addr = trim(str_ireplace("::", " ", $remote_addr));
	}
	if ($_SESSION['loggued_on_user']) {
		$login = $_SESSION['loggued_on_user'];
	} else {
		$login = $remote_addr;
	}
	$index = 0;
	$ordered = 0;
	foreach ($query_result as $item) {
		if ($index == $item_id) {
			$item_name = $item['itemName'];
			$item_price = (int)$item['price'];
			$res = mysqli_query($database, "INSERT INTO `orders` (`username`, `remoteAddr`, `itemName`, `itemPrice`, `ordered`) VALUES ('$login', '$remote_addr', '$item_name', '$item_price', '$ordered');");
			break ;
		}
		$index++;
	}
}

$database = mysqli_connect('localhost:3307', 'root', 'rootroot', 'rush00');
$item_id = (int)$_POST['hidden'];
print_r($_POST);
if (isset($_POST['delete_item']) && $_POST['delete_item'] == 'Delete') {
	echo "hello";	   
	mysqli_query($database, "DELETE FROM items WHERE itemId=$item_id");
}

if (isset($_POST['modify_item']) && $_POST['modify_item'] == 'Edit') {
     if ($_POST['modify_item'] == 'Edit') {

        }
    }
?>