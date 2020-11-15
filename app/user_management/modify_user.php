<html>
    <body>
        <div class="form">
            <h1>Chage Your Password</h1>
            <form action="index.php?page=modify" method="post">
                Username <input type="text" name="login" value="<?php echo $_POST["login"]; ?>" placeholder="Username" />
                <br />
                <br />
                Password <input type="password" name="oldpw" value="" placeholder="Password" />
                <br />
                <br />
                New Password: <input type="password" name="newpw" value="" placeholder="New Password" />
                <br />
                <br />
                <input type="submit" name="submit" value="Change Your Password" />
            </form>
<?php

if ($_POST["submit"] === "Change Your Password")
{
    $error = "<br /><br />ERROR\n";
    if ($_POST["newpw"] === "")
        exit ($error);
    $modif_user = array("login"=>$_POST["login"], "passwd"=>hash("whirlpool", $_POST["oldpw"]));
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

?>
        </div>
    </body>
</html>
