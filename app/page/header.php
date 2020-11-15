<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/forms.css">
    <title>Shop</title>
</head>
<body>
    <header>
        <div class="header_div">
        <nav>
        <ul>
                <li><a href="index.php?page=home">Home</a></li>
                <li><a href="" class="down">Category</a>
                    <ul class="submenu">
                        <li><a href="">Category 1</a>
                            <ul class="subsubmenu">
                                <li><a href="">2</a></li>
                                <li><a href="">3</a></li>
                            </ul>
                        </li>
                        <li><a href="">Category 2</a>
                            <ul class="subsubmenu">
                                <li><a href="">1</a></li>
                                <li><a href="">2</a></li>
                                <li><a href="">3</a></li>
                            </ul>
                        </li>
                        <li><a href="">Category 3</a>
                            <ul class="subsubmenu">
                                <li><a href="">1</a></li>
                                <li><a href="">2</a></li>
                            </ul>
                        </li>
                        <li><a href="">Category 4</a>
                            <ul class="subsubmenu">
                                <li><a href="">1</a></li>
                                <li><a href="">2</a></li>
                            </ul>
                        </li>
                        <li><a href="index.php?page=all">All</a></li>
                    </ul>
                </li>
                <li><a href="index.php?page=basket">Shopping Basket</a></li>
                <li><a href="index.php?page=create">Create an Account</a></li>
                <?php
                    if ($_SESSION['loggued_on_user'] == "") {
                        echo "<li><a href=\"index.php?page=login\">Log In</a></li>";
                    } else {
                        echo "<li><a href=\"index.php?page=modify\">" . $_SESSION['loggued_on_user']."</a></li>";
                        echo "<li><a href=\"index.php?page=logout\">Log Out</a></li>";
                    }
                ?>
            </ul>
        </nav>
        </div>
    </header>