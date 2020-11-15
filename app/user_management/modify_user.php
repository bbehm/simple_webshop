<html>
    <body>
        <div class="form">
            <h1>Hello, <?php echo $_SESSION["loggued_on_user"]; ?>!</h1>
            <h2>Chage Your Password</h2>
            <form action="index.php?page=modify" method="post">
                Password <input type="password" name="oldpw" value="" placeholder="Password" />
                <br />
                <br />
                New Password: <input type="password" name="newpw" value="" placeholder="New Password" />
                <br />
                <br />
                <input type="submit" name="submit_modif" value="Change Your Password" />
            </form>
            <br />
            <form action="index.php?page=modify" method="post">
                <h2>Delete Your Account</h2>
                Password <input type="password" name="pw" value="" placeholder="Password" />
                <br />
                <br />
                <input type="submit" name="submit_del" value="Delete Your Account" />
            </form>
<?php

$error = "<br /><br />ERROR\n";
session_start();
if ($_POST["submit_modif"] === "Change Your Password")
{
    if ($_POST["newpw"] === "")
        exit ($error);
    $modif_user = array("login"=>$_SESSION["loggued_on_user"], "passwd"=>hash("whirlpool", $_POST["oldpw"]));
    $users = unserialize(file_get_contents("private/passwd"));
    foreach ($users as $key=>$user)
    {
        if ($user["login"] === $modif_user["login"] && $user["passwd"] === $modif_user["passwd"])
        {
            $users[$key]["passwd"] = hash("whirlpool", $_POST["newpw"]);
            file_put_contents("private/passwd", serialize($users)."\n");
            header("Location: index.php?page=login");
        }
    }
    echo $error;
}
if ($_POST["submit_del"] === "Delete Your Account")
{
    $modif_user = array("login"=>$_SESSION["loggued_on_user"], "passwd"=>hash("whirlpool", $_POST["pw"]));
    $users = unserialize(file_get_contents("private/passwd"));
    foreach ($users as $key=>$user)
    {
        if ($user["login"] === $modif_user["login"] && $user["passwd"] === $modif_user["passwd"])
        {
            unset($users[$key]);
            $users = array_values($users);
            file_put_contents("private/passwd", serialize($users)."\n");
            $_SESSION["loggued_on_user"] = "";
            header("Location: index.php?page=login");
        }
    }
    echo $error;
}

?>
        </div>
    </body>
</html>
