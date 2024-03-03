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
    if(!empty($result))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function is_password_wrong(string $passowrd, string $hashedPassword)
{
    if(!password_verify($passowrd, $hashedPassword))
    {
        return true;
    }
    else
    {
        return false;
    }
}