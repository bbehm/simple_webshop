<?php
session_start();
// run the install script --> connecting to database
include('install.php');
// checking get request --> which page to redirect to

if ($_GET['page'] == "home" || !isset($_GET['page'])) {
	$redirect = 'app/page/home.html';
}
if ($_GET['page'] == 'login') {
	$redirect = '/app/user_management/login.php';
} else if ($_GET['page'] == "create") {
	$redirect = 'app/user_management/create_user.php';
} else if ($_GET['page'] == "modify") {
	$redirect = 'app/user_management/modify_user.php';
} else if ($_GET['page'] == "logout") {
	$redirect = 'app/user_management/logout.php';
} else if ($_GET['page'] == "admin") {
	header("location: app/admin.php");
} else if ($_GET['page'] == "basket") {
	$redirect = 'app/basket.php';
} else if ($_GET['page'] == "all") {
	$redirect = 'app/items/all.php';
}
// still need to add item options (we need to choose what our webshop will be)
// checks if there's an ongoing session - otherwise..
if ($_SESSION['loggued_on_user']) {
	$login = $_SESSION['loggued_on_user'];
} else {
	// what happens if not?
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