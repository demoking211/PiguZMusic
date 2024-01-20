<?php

declare(strict_types=1);

function is_input_empty($input)
{
    if(empty($input))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function is_username_registered(object $pdo, string $username)
{
    if(get_username($pdo, $username))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function is_email_invalid($email)
{
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function is_email_registered(object $pdo, string $email)
{
    if(get_email($pdo, $email))
    {
        return true;
    }
    else
    {
        return false;
    }
}

/*  Password Format:
    - at least 8 characters
    - at least one Upper case letter
    - at least one Lower case letter
    - at least one Number
    - at least one Special Character
*/
function is_password_invalid($password)
{
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) 
    {
        return true;
    }
    else
    {
        return false;
    }
}

function is_password_matched(string $password, string $confirm_password)
{
    if($password === $confirm_password)
    {
        return false;
    }
    else
    {
        return true;
    }
}

function create_user(object $pdo, string $username, string $password, string $email)
{
    set_user($pdo, $username, $password, $email);
}