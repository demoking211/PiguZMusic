<?php

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    try
    {
        require_once '../ErrorHandler.php';
        require_once '../../includes/config.php';
        require_once '../../includes/dbh.inc.php';

        $errorController = new ErrorController();

        $user_role = $_SESSION['user_role_id'];
        if($user_role != 1)
        {
            echo $errorController->index(403, [], ["Forbidden: You don't have permission to access this resource."]);
            die();
        }
    
        $user_id = $_SESSION['user_id'];
        
        $playlist_id = trim(isset($_POST["playlistId"]) ? $_POST["playlistId"] : "");
        $user_id = trim(isset($_POST["userId"]) ? $_POST["userId"] : "");

        $query = "SELECT * FROM `playlists` WHERE `id` = :id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":id", $playlist_id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(empty($result))
        {
            echo $errorController->index(404, [], ["Playlist Not Found."]);
            die();
        }

        $query = "SELECT * FROM `users` WHERE `id` = :id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":id", $user_id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(empty($result))
        {
            echo $errorController->index(404, [], ["User Not Found."]);
            die();
        }
    
        $query = "INSERT INTO `userplaylists`(`user_id`, `playlist_id`, `created_by`, `created_datetime`) VALUES (:user_id, :playlist_id, :user_id, :currentDateTime)";
    
        $stmt = $pdo->prepare($query);
    
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":playlist_id", $playlist_id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":currentDateTime", $datetime_utc8);
    
        $stmt->execute();

        $query2 = "SELECT * FROM `userplaylists` WHERE `user_id` = :user_id AND `playlist_id` = :playlist_id";
    
        $stmt = $pdo->prepare($query2);
    
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":playlist_id", $playlist_id);
    
        $stmt->execute();

        $data["userplaylist"] = $stmt->fetch(PDO::FETCH_ASSOC);

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