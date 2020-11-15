<html>
    <body>
        <div class="form">
            <form action="index.php?page=login" method="post">
                <h1>Log In</h1>
                Username <input type="text" name="login" value="<?php echo $_POST["login"]; ?>" placeholder="Username" />
                <br />
                <br />
                Password <input type="password" name="passwd" value="" placeholder="Password" />
                <br />
                <br />
                <input type="submit" name="submit" value="Log In" />
            </form>
            <a href="index.php?page=create">Create an Account</a>
<?php

function auth($login, $passwd, &$admin)
{
    $passwd = hash("whirlpool", $passwd);
    $users = unserialize(file_get_contents("private/passwd"));
    foreach ($users as $user)
    {
        if ($user["login"] === $login && $user["passwd"] === $passwd)
        {
            $admin = $user["admin"];
            return (TRUE);
        }
    }
    return (FALSE);
}

session_start();
if ($_POST["submit"] === "Log In")
{
    if (auth($_POST["login"], $_POST["passwd"], $admin))
    {
        $_SESSION["loggued_on_user"] = $_POST["login"];
        $_SESSION["admin"] = $admin;
        header("Location: index.php");
    }
    else
    {
        $_SESSION["loggued_on_user"] = "";
        echo "<br /><br />ERROR\n";
    }
}

?>
        </div>
    </body>
</html>
