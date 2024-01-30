<?php

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $username = $_POST["username"];
    $password = $_POST["password"];

    try
    {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_controller.inc.php';

        $errors = [];

        if(is_input_empty($username))
        {
            $errors["empty_username"] = "Username cannot be empty.";
        }
        if(is_input_empty($password))
        {
            $errors["empty_password"] = "Password cannot be empty.";
        }

        if(!$errors)
        {
            $result = get_username($pdo, $username);

            if(is_user_exist($result))
            {
                $errors["login_incorrect"] = "Incorrect Username or Password.";
            }
            if(!is_user_exist($result) && is_password_wrong($password, $result["passwordHash"]))
            {
                $errors["login_incorrect"] = "Incorrect Username or Password.";
            }
        }

        require_once 'config.php';

        if($errors)
        {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../login.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);

        $_SESSION["last_regeneration"] = time();

        header("Location: ../login.php?login=success");

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
    header("Location: ../login.php");
    die();
}