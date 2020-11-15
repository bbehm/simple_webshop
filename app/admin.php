<html>
    <body>
        <div class="form">
            <h1>Admin</h1>
            <h2>Users</h2>
            <div class="divs_two">
                <div><h3>Username</h3></div>
                <div><h3>Admin</h3></div>
            </div>
<?php

$users = unserialize(file_get_contents("private/passwd"));
foreach ($users as $user)
{
    echo "<div class=\"divs_two\">\n";
    echo "<div>".$user["login"]."</div>\n";
    if ($user["admin"])
        echo "<div>Yes</div>\n";
    else
        echo "<div>No</div>\n";
    echo "</div>\n";
}

?>
            <br />
            <h2>Give/Take Admin Rights</h2>
            <form action="index.php?page=admin" method="post">
                Your Password <input type="password" name="passwd1" value="" placeholder="Your Password" />
                <br />
                <br />
                User <select name="login1">
<?php

foreach ($users as $user)
{
    if ($user["login"] !== "root")
        echo "<option value=\"".$user["login"]."\">".$user["login"]."</option>\n";
}

?>
                </select>
                <br />
                <br />
                Give/Take Admin Rights <select name="admin_rights">
                    <option value="give" selected>Give Admin Rights</option>
                    <option value="take">Take Admin Rights</option>
                </select>
                <br />
                <br />
                <input type="submit" name="admin" value="Give/Take Admin Rights" />
            </form>
            <br />
            <h2>Delete a User</h2>
            <form action="index.php?page=admin" method="post">
                Your Password <input type="password" name="passwd2" value="" placeholder="Your Password" />
                <br />
                <br />
                User <select name="login2">
<?php

foreach ($users as $user)
{
    if ($user["login"] !== "root")
        echo "<option value=\"".$user["login"]."\">".$user["login"]."</option>\n";
}

?>
                </select>
                <br />
                <br />
                <input type="submit" name="del" value="Delete a User" />
            </form>
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
if ($_POST["admin"] === "Give/Take Admin Rights")
{
    if (auth($_SESSION["loggued_on_user"], $_POST["passwd1"], $admin))
    {
        foreach ($users as $key=>$user)
        {
            if ($user["login"] === $_POST["login1"])
            {
                if ($_POST["admin_rights"] === "give")
                    $users[$key]["admin"] = TRUE;
                else
                    $users[$key]["admin"] = FALSE;
                file_put_contents("private/passwd", serialize($users)."\n");
                if ($_POST["login1"] === $_SESSION["loggued_on_user"])
                {
                    $_SESSION["loggued_on_user"] = "";
                    $_SESSION["admin"] = FALSE;
                    header("Location: index.php?page=login");
                }
                break ;
            }
        }
    }
    else
        echo "<br /><br />ERROR\n";
}
if ($_POST["del"] === "Delete an User")
{
    if (auth($_SESSION["loggued_on_user"], $_POST["passwd2"], $admin))
    {
        foreach ($users as $key=>$user)
        {
            if ($user["login"] === $_POST["login2"])
            {
                unset($users[$key]);
                $users = array_values($users);
                file_put_contents("private/passwd", serialize($users)."\n");
                if ($_POST["login2"] === $_SESSION["loggued_on_user"])
                {
                    $_SESSION["loggued_on_user"] = "";
                    $_SESSION["admin"] = FALSE;
                    header("Location: index.php?page=login");
                }
                break ;
            }
        }
    }
    else
        echo "<br /><br />ERROR\n";
}

?>
        <br />
        <br />
        <br />
        <br />
        <br />
        </div>
    </body>
</html>
