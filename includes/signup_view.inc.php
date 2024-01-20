<?php

declare(strict_types=1);

function signup_inputs()
{
    if(isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["errors_signup"]["empty_username"]) && !isset($_SESSION["errors_signup"]["username_taken"]))
    {
        echo '<input type="text" name="username" placeholder="Username" value="' . $_SESSION["signup_data"]["username"] . '">';
    }
    else
    {
        echo '<input type="text" name="username" placeholder="Username">';
        if(isset($_SESSION["errors_signup"]["empty_username"]))
        {
            echo '<p>' . $_SESSION['errors_signup']['empty_username'] . '</p>';
        }
        else if(isset($_SESSION["errors_signup"]["username_taken"]))
        {
            echo '<p>' . $_SESSION['errors_signup']['username_taken'] . '</p>';
        }
    }

    echo '<input type="password" name="password" placeholder="Password">';
    if(isset($_SESSION["errors_signup"]["empty_password"]))
    {
        echo '<p>' . $_SESSION['errors_signup']['empty_password'] . '</p>';
    }
    else if(isset($_SESSION["errors_signup"]["invalid_password"]))
    {
        echo '<p>' . $_SESSION['errors_signup']['invalid_password'] . '</p>';
    }

    echo '<input type="password" name="confirm_password" placeholder="Confirm Password">';
    if(isset($_SESSION["errors_signup"]["empty_confirm_password"]))
    {
        echo '<p>' . $_SESSION['errors_signup']['empty_confirm_password'] . '</p>';
    }
    else if(isset($_SESSION["errors_signup"]["not_matched_password"]))
    {
        echo '<p>' . $_SESSION['errors_signup']['not_matched_password'] . '</p>';
    }

    if(isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["errors_signup"]["empty_email"]) && !isset($_SESSION["errors_signup"]["email_taken"]) && !isset($_SESSION["errors_signup"]["invalid_email"]))
    {
        echo '<input type="text" name="email" placeholder="E-mail" value="' . $_SESSION["signup_data"]["email"] . '">';
    }
    else
    {
        echo '<input type="text" name="email" placeholder="E-mail">';
        if(isset($_SESSION["errors_signup"]["empty_email"]))
        {
            echo '<p>' . $_SESSION['errors_signup']['empty_email'] . '</p>';
        }
        else if(isset($_SESSION["errors_signup"]["email_taken"]))
        {
            echo '<p>' . $_SESSION['errors_signup']['email_taken'] . '</p>';
        }
        else if(isset($_SESSION["errors_signup"]["invalid_email"]))
        {
            echo '<p>' . $_SESSION['errors_signup']['invalid_email'] . '</p>';
        }
    }

    unset($_SESSION["signup_data"]);
    unset($_SESSION['errors_signup']);
}