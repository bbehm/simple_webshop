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

$query_res = mysqli_query($link, "SELECT * FROM orders WHERE username='$login' AND ordered='0'");
?>

<html>
	<!-- Adding information on items in shopping basket -->
	<div>
		<table>
			<?php
			$item_id = 0;
			$sum = 0;
				foreach ($query_res as $item) {
					echo "<tr>";
					echo "<td>" . $item['name'] . "</td>";
					echo "<td>" . $item['price'] . "</td>";
					echo "<td><form method='post'><input type='hidden' name='hidden' value='$item_id'><input type='submit' name='submit' value='Delete'></form></td>";
					echo "</tr>";
					$sum = $sum + (int)$item['price'];
					$item_id++;
				}
			?>
			<tr><td>Total: </td><td><?= $total ?></td><td><form type='submit' name='order' value='Order'></form></td></tr>
		</table>
	</div>
</html>

<?php

// checking if items need to be deleted
if ($_POST['submit'] == "Delete") {
	$item_id = (int)$_POST['hidden'];
	$search = 0;
	foreach ($query_res as $item) {
		if ($search == $item_id) {
			$mysql_id = $item['itemId'];
			mysqli_query($database, "DELETE FROM orders WHERE itemId='$mysql_id';");
			refresh_page();
		}
		$search++;
	}
}

// checking if items are ordered


?>