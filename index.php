<?php
session_start();
// run the install script --> connecting to database
include('install.php');

// checking get request --> which page to redirect to
if ($_GET['page'] == "home" || !isset($_GET['page'])) {
	$redirect = 'app/page/home.html';
} else if ($_GET['page'] == 'login') {
	$redirect = 'app/user_management/login.php';
} else if ($_GET['page'] == "create") {
	$redirect = 'app/user_management/create_user.php';
} else if ($_GET['page'] == "modify") {
	$redirect = 'app/user_management/modify_user.php';
} else if ($_GET['page'] == "logout") {
	$redirect = 'app/user_management/logout.php';
} else if ($_GET['page'] == "admin") {
	$redirect = 'app/admin.php';
} else if ($_GET['page'] == "basket") {
	$redirect = 'app/basket.php';
}  else if (($_GET['page'] == "all" || $_GET['page'] == "dogs" || $_GET['page'] == "cats" || $_GET['page'] == "food" || $_GET['page'] == "accessories") && $_SESSION['loggued_on_user'] == 'root') {
	$redirect = 'app/items/admin_items.php';
} else if ($_GET['page'] == "all" || $_GET['page'] == "dogs" || $_GET['page'] == "cats" || $_GET['page'] == "food" || $_GET['page'] == "accessories") {
	$redirect = 'app/items/all.php';
} else if ($_GET['page'] == "thanks") {
	$redirect = 'app/page/thanks.html';
}

if ($_SESSION['loggued_on_user']) {
	$login = $_SESSION['loggued_on_user'];
} else {
	$login = $_SERVER['REMOTE_ADDR'];
	if (strstr($login, "::")) {
		$login = trim(str_ireplace("::", " ", $login));
	}
}
?>

<div>
	<?php include 'app/page/header.php' ?>
</div>
<div>
	<?php include $redirect; ?>
</div>
<?php include 'app/page/footer.php' ?>
</body>
</html>