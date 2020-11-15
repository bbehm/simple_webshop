<?php
include '../../install.php';
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

echo "<h1>Happy shopping!</h1>";
echo "<div class='box'>";
		$item_id = 0;
		foreach ($query_result as $item) {
			echo "<h2>" . $item['itemName'] . "</h2>";
			echo "<p>" . $item['itemDescription'] . "</p>";
			echo "<p>" . $item['price'] . "€</p>";
			echo "<a><form method='post'><input type='hidden' name='hidden' value='$item_id'><input type='submit' name='submit' value='Add to Basket'></form></a>";
			echo "<br />";
			$item_id++;
		}
echo "</div>";

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
	refresh_page();
}
?>