<html>
    <body>
        <div class="form">
            <h1>Log Out</h1>
            <form action="index.php?page=logout" method="post">
                <input type="submit" name="submit" value="Log Out" />
            </form>
<?php

session_start();
if ($_POST["submit"] === "Log Out")
{
    $_SESSION["loggued_on_user"] = "";
    $_SESSION["admin"] = FALSE;
    header("Location: index.php?page=login");
}

?>
        </form>
    </body>
</html>
