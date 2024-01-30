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

function is_user_exist($result)
{
    if(!(is_bool($result) || is_array($result)))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function is_password_wrong(string $passowrd, string $hashedPassowrd)
{
    if(!password_verify($passowrd, $hashedPassowrd))
    {
        return true;
    }
    else
    {
        return false;
    }
}