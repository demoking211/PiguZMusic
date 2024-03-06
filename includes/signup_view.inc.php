<?php

declare(strict_types=1);

function signup_inputs()
{
    echo '<div class="form_block col-12 col-lg-6 ps-1">';
    if(isset($_GET["signup"]) && isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["errors_signup"]["empty_username"]) && !isset($_SESSION["errors_signup"]["username_taken"]))
    {
        echo '<input type="text" id="reg_username" name="username" placeholder="Username" value="' . $_SESSION["signup_data"]["username"] . '">';
    }
    else
    {
        echo '<input type="text" id="reg_username" name="username" placeholder="Username">';
    }
    echo '</div>';

    echo '<div class="form_block col-12 col-lg-6 ps-1">';
    if(isset($_GET["signup"]) && isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["errors_signup"]["empty_email"]) && !isset($_SESSION["errors_signup"]["email_taken"]) && !isset($_SESSION["errors_signup"]["invalid_email"]))
    {
        echo '<input type="email" id="email" name="email" placeholder="Email" value="' . $_SESSION["signup_data"]["email"] . '">';
    }
    else
    {
        echo '<input type="email" id="email" name="email" placeholder="Email">';
    }
    echo '</div>';

    echo '<div class="form_block col-12 col-lg-6 ps-1">
    <input type="password" id="reg_password" name="password" placeholder="Password">
    </div>';

    echo '<div class="form_block col-12 col-lg-6 ps-1">
    <input type="password" id="cpassword" name="confirm_password" placeholder="Confirm Password">
    </div>';

    unset($_SESSION["signup_data"]);
}

function signup_errors()
{
    
    if(isset($_SESSION["errors_signup"]))
    {
        echo '<div id="signup-error-area" class="alert alert-danger fade d-flex align-items-center show" role="alert">
        <i class="fa fa-exclamation-triangle me-2" aria-hidden="true"></i>';
        if(isset($_SESSION["errors_signup"]["empty_username"]))
        {
            echo '<div id="signup-error-messages">' . $_SESSION['errors_signup']['empty_username'];
        }
        else if(isset($_SESSION["errors_signup"]["username_taken"]))
        {
            echo '<div id="signup-error-messages">' . $_SESSION['errors_signup']['username_taken'];
        }
        if(isset($_SESSION["errors_signup"]["empty_email"]))
        {
            echo '<div id="signup-error-messages">' . $_SESSION['errors_signup']['empty_email'];
        }
        else if(isset($_SESSION["errors_signup"]["email_taken"]))
        {
            echo '<div id="signup-error-messages">' . $_SESSION['errors_signup']['email_taken'];
        }
        else if(isset($_SESSION["errors_signup"]["invalid_email"]))
        {
            echo '<div id="signup-error-messages">' . $_SESSION['errors_signup']['invalid_email'];
        }
        if(isset($_SESSION["errors_signup"]["empty_password"]))
        {
            echo '<div id="signup-error-messages">' . $_SESSION['errors_signup']['empty_password'];
        }
        else if(isset($_SESSION["errors_signup"]["invalid_password"]))
        {
            echo '<div id="signup-error-messages">' . $_SESSION['errors_signup']['invalid_password'];
        }
        if(isset($_SESSION["errors_signup"]["empty_confirm_password"]))
        {
            echo '<div id="signup-error-messages">' . $_SESSION['errors_signup']['empty_confirm_password'];
        }
        else if(isset($_SESSION["errors_signup"]["not_matched_password"]))
        {
            echo '<div id="signup-error-messages">' . $_SESSION['errors_signup']['not_matched_password'];
        }
    }
    else
    {
        echo '<div id="signup-error-area"  class="alert alert-danger fade d-flex align-items-center error-area" role="alert">
        <i class="fa fa-exclamation-triangle me-2" aria-hidden="true"></i>
        <div id="signup-error-messages"></div>';
    }
    echo '</div>';

    unset($_SESSION['errors_signup']);
}