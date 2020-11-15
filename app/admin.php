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
        echo "<div>Admin</div>\n";
    else
        echo "<div>Not an Admin</div>\n";
    echo "</div>\n<br />\n<br />\n";
}

?>
            <h2>Give/Take Admin Rights</h2>
            <form action="index.php?page=admin" method="post">
                Your Password <input type="password" name="passwd" value="" placeholder="Your Password" />
                <br />
                <br />
                User <select name="login">
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
                <input type="submit" name="submit" value="Give/Take Admin Rights" />
            </form>
<?php

session_start();
if ($_POST["submit"] === "Give/Take Admin Rights")
{
    $admin = array("login"=>$_SESSION["loggued_on_user"], "passwd"=>hash("whirlpool", $_POST["passwd"]));
    $correct_passwd = FALSE;
    foreach ($users as $key=>$user)
    {
        if ($user["login"] === $admin["login"] && $user["passwd"] === $admin["passwd"])
        {
            $correct_passwd = TRUE;
            break ;
        }
    }
    if ($correct_passwd)
    {
        foreach ($users as $key=>$user)
        {
            if ($user["login"] === $_POST["login"])
            {
                if ($_POST["admin_rights"] === "give")
                    $users[$key]["admin"] = TRUE;
                else
                    $users[$key]["admin"] = FALSE;
                file_put_contents("private/passwd", serialize($users)."\n");
                if ($user["login"] === $admin["login"])
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
        </div>
    </body>
</html>
