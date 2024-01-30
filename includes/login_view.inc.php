<?php

declare(strict_types=1);

function login_inputs()
{
    echo '<input type="text" name="username" placeholder="Username/E-mail">';
    if(isset($_SESSION["errors_login"]))
    {
        if(isset($_SESSION["errors_login"]["empty_username"]))
        {
            echo '<p>' . $_SESSION['errors_login']['empty_username'] . '</p>';
        }
    }
    echo '<input type="password" name="password" placeholder="Password">';
    if(isset($_SESSION["errors_login"]))
    {
        if(isset($_SESSION["errors_login"]["empty_password"]))
        {
            echo '<p>' . $_SESSION['errors_login']['empty_password'] . '</p>';
        }
    }
    if(isset($_SESSION["errors_login"]))
    {
        if(isset($_SESSION["errors_login"]["login_incorrect"]) && !isset($_SESSION["errors_login"]["empty_username"]) && !isset($_SESSION["errors_login"]["empty_password"]))
        {
            echo '<p>' . $_SESSION['errors_login']['login_incorrect'] . '</p>';
        }
    }
    if(isset($_GET['login']) && $_GET['login'] === "success")
    {
        echo "Login successfully.";
    }

    unset($_SESSION['errors_login']);
}