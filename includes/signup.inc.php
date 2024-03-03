<?php

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);
    $email = trim($_POST["email"]);

    try
    {
        require_once 'config.php';
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_controller.inc.php';

        // Validation
        $errors = [];

        // Check for empty input validation
        if(is_input_empty($username))
        {
            $errors["empty_username"] = "Username cannot be empty.";
        }
        if(is_input_empty($password))
        {
            $errors["empty_password"] = "Password cannot be empty.";
        }
        if(is_input_empty($confirm_password))
        {
            $errors["empty_confirm_password"] = "Confirm Password cannot be empty.";
        }
        if(is_input_empty($email))
        {
            $errors["empty_email"] = "E-mail cannot be empty.";
        }

        // Check username validation
        if(is_username_registered($pdo, $username))
        {
            $errors["username_taken"] = "Username has already been taken.";
        }

        // Check email validation
        if(is_email_invalid($email))
        {
            $errors["invalid_email"] = "Invalid e-mail address.";
        }
        if(is_email_registered($pdo, $email))
        {
            $errors["email_taken"] = "E-mail has already been registered.";
        }

        // Check password validation
        if(is_password_invalid($password))
        {
            $errors["invalid_password"] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
        }
        if(is_password_matched($password, $confirm_password))
        {
            $errors["not_matched_password"] = "The Confirm Password confirmation does not match.";
        }

        require_once 'config.php';

        if($errors)
        {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "username" => $username,
                "email" => $email,
            ];
            $_SESSION["signup_data"] = $signupData;

            header("Location: ../signup.php");
            die();
        }

        create_user($pdo, $username, $password, $email);

        header("Location: ../signup.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();
    }
    catch(PDOException $e)
    {
        die("Query failed: " . $e->getMessage());
    }
}
else
{
    header("Location: ../signup.php");
    die();
}