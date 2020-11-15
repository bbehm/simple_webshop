<?php
session_start();
include '../install.php';
function refresh_page() {
	header("Location: " . $_SERVER['REQUEST_URI']);
	exit();
}
// checks if person is logged on, otherwise uses remote address

$remote_addr = $_SERVER['REMOTE_ADDR'];
if (strstr($remote_addr, "::")) {
	$remote_addr = trim(str_ireplace("::", " ", $login));
}
if ($_SESSION['loggued_on_user]']) {
	$login = $_SESSION['loggued_on_user]'];
} else {
	$login = $remote_addr;
}

// to fetch items in basket when logged in after filling basket

if ($_SESSION['loggued_on_user'] == $login) {
	$remote_addr = $_SERVER['REMOTE_ADDR'];
	if (strstr($remote_addr, "::")) {
		$remote_addr = trim(str_ireplace("::", " ", $remote_addr));
	}

	$query_res = mysqli_query($database, "SELECT * FROM orders WHERE remoteAddr='$remote_addr' AND ordered='0'");

   if (mysqli_fetch_array($query_res)) {
		$query_res = mysqli_query($database, "UPDATE orders SET username='$login' WHERE remoteAddr='$remote_addr' AND ordered='0'");
	}
}

$query_res = mysqli_query($database, "SELECT * FROM orders WHERE username='$login' AND ordered='0'");

// Adding information on items in shopping basket
echo "<div class='body_area'>";
echo "<h1>Your Basket</h1>";
echo "<table id='shopping_basket'>";
	$item_id = 0;
	$sum = 0;
	foreach ($query_res as $item) {
		echo "<tr>";
		echo "<td>" . $item['itemName'] . "</td>";
		echo "<td>" . $item['itemPrice'] . "€</td>";
		echo "<td><form method='post'><input type='hidden' name='hidden' value='$item_id'><input type='submit' name='delete' value='Delete'></form></td>";
		echo "</tr>";
		$sum = $sum + (int)$item['itemPrice'];
		$item_id++;
	}

echo "<tr><td>Total: </td><td>".$sum."€</td><td><form method='post'><input type='submit' name='order' value='Order'></form></td></tr>";
echo "</table></div>";

// checking if items need to be deleted

if (isset($_POST['delete']) && $_POST['delete'] == 'Delete') {
	$item_id = (int)$_POST['hidden'];
	$search = 0;
	foreach ($query_res as $item) {
		if ($search == $item_id) {
			$mysql_id = $item['orderId'];
			mysqli_query($database, "DELETE FROM orders WHERE orderId='$mysql_id';");
			refresh_page();
		}
		$search++;
	}
}


// checking if items are ordered, if ordered --> thank you greeting

if (isset($_POST['order']) && $_POST['order'] == 'Order') {
	if (!$_SESSION['loggued_on_user']) {
		header("location: index.php?page=login");
	} else {
		mysqli_query($database, "UPDATE orders SET ordered = '1' WHERE username='$login' AND ordered='0'");
		header("location: index.php?page=thanks");
	}
}
?>
