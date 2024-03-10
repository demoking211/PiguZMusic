<?php

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    try
    {
        require_once 'ErrorHandler.php';
        require_once '../includes/config.php';
        require_once '../includes/dbh.inc.php';

        $errorController = new ErrorController();

        $user_role = $_SESSION['user_role_id'];
        if($user_role != 1)
        {
            echo $errorController->index(403, [], ["Forbidden: You don't have permission to access this resource."]);
            die();
        }

        $user_id = $_SESSION['user_id'];
        
        $username = trim(isset($_POST['username']) ? $_POST["username"] : "");
        $password = trim(isset($_POST["password"])? $_POST["password"] : "");
        $confirm_password = trim(isset($_POST["confirmPassword"])? $_POST["confirmPassword"] : "");
        $email = trim(isset($_POST["email"])? $_POST["email"] : "");

        if(!empty($email))
        {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                echo $errorController->index(400, [], ["Invalid e-mail address."]);
                die();
            }
        }

        $query = "SELECT username FROM users WHERE username = :username;";
        $stmt = $pdo->prepare($query);
    
        $stmt->bindParam(":username", $username);
    
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($result))
        {
            echo $errorController->index(400, [], ["Username has already been taken."]);
            die();
        }

        $query = "SELECT email FROM users WHERE email = :email;";
        $stmt = $pdo->prepare($query);
    
        $stmt->bindParam(":email", $email);
    
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!empty($result))
        {
            echo $errorController->index(400, [], ["E-mail has already been registered."]);
            die();
        }

        if(!empty($password))
        {
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);
        
            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) 
            {
                echo $errorController->index(400, [], ["Wrong Password Format"]);
                die();
            }
        }

        if(!empty($password) && !empty($confirm_password))
        {
            if($password != $confirm_password)
            {
                echo $errorController->index(400, [], ["The Confirm Password confirmation does not match."]);
                die();
            }
        }

        $id = GUIDv4();
    
        $query = "INSERT INTO `users`(`id`, `username`, `passwordHash`, `email`, `created_by`, `created_datetime`) VALUES (:id, :username, :pwd, :email, :user_id, :currentDateTime)";
    
        $stmt = $pdo->prepare($query);

        $options = [
            'cost' => 12
        ];
    
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
        
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $hashedPassword);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":currentDateTime", $datetime_utc8);
        
        $stmt->execute();

        $role_id = 3;

        $query2 = "INSERT INTO `userroles` (`user_id`, `role_id`) VALUES (:user_id, :role_id);";
        $stmt = $pdo->prepare($query2);

        $stmt->bindParam(":user_id", $id);
        $stmt->bindParam(":role_id", $role_id);

        $stmt->execute();

        $query2 = "SELECT * FROM `users` WHERE `id` = :id";
    
        $stmt = $pdo->prepare($query2);
    
        $stmt->bindParam(":id", $id);
    
        $stmt->execute();

        $data["user"] = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($data))
        {
            echo $errorController->index(200, $data);
        }
    
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
    echo "Request failed.";
    die();
}