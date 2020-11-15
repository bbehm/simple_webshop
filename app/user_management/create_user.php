<html>
    <body>
        <div class="form">
            <h1>Create an Account</h1>
            <form action="index.php?page=create" method="post">
                Username <input type="text" name="login" value="<?php echo $_POST["login"]; ?>" placeholder="Username" />
                <br />
                <br />
                Password <input type="password" name="passwd" value="" placeholder="Password" />
                <br />
                <br />
                <input type="submit" name="submit" value="Create an Account" />
            </form>
<?php

$error = "<br /><br />ERROR\n";
if ($_POST["submit"] === "Create an Account")
{
    if ($_POST["login"] !== "" && $_POST["passwd"] !== "")
    {
        $new_user = array("login"=>$_POST["login"], "passwd"=>hash("whirlpool", $_POST["passwd"]), "admin"=>FALSE);
        if (file_exists("private/passwd"))
        {
            $users = unserialize(file_get_contents("private/passwd"));
            $free_login = TRUE;
            foreach ($users as $user)
            {
                if ($user["login"] === $new_user["login"])
                {
                    $free_login = FALSE;
                    break ;
                }
            }
            if ($free_login)
            {
                $users[] = $new_user;
                file_put_contents("private/passwd", serialize($users)."\n");
                header("Location: index.php?page=login");
            }
            else
                echo $error;
        }
        else
        {
            if (!file_exists("private"))
                mkdir("private");
            $users = array($new_user);
            file_put_contents("private/passwd", serialize($users)."\n");
            header("Location: index.php?page=login");
        }
    }
    else
        echo $error;
}

?>
        </div>
    </body>
</html>
