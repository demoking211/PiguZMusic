<?php

declare(strict_types=1);



function login_errors()
{
    if(isset($_SESSION["errors_login"]))
    {
        echo '<div id="login-error-area" class="alert alert-danger fade d-flex align-items-center show" role="alert">
        <i class="fa fa-exclamation-triangle me-2" aria-hidden="true"></i>';
        if(isset($_SESSION["errors_login"]["empty_username"]))
        {
            echo '<div id="login-error-messages">' . $_SESSION['errors_login']['empty_username'];
        }
        if(isset($_SESSION["errors_login"]["empty_password"]))
        {
            echo '<div id="login-error-messages">' . $_SESSION['errors_login']['empty_password'];
        }
        if(isset($_SESSION["errors_login"]["login_incorrect"]) && !isset($_SESSION["errors_login"]["empty_username"]) && !isset($_SESSION["errors_login"]["empty_password"]))
        {
            echo '<div id="login-error-messages">' . $_SESSION['errors_login']['login_incorrect'];
        }
    }
    else
    {
        echo '<div id="login-error-area"  class="alert alert-danger fade d-flex align-items-center error-area" role="alert">
        <i class="fa fa-exclamation-triangle me-2" aria-hidden="true"></i>
        <div id="login-error-messages"></div>';
    }
    echo '</div>';

    if(isset($_GET['login']) && $_GET['login'] === "success")
    {
        echo "Login successfully.";
    }

    
    unset($_SESSION['errors_login']);
}