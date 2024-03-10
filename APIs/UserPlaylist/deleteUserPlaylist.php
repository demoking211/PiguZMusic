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
        
        $userPlaylist_id = trim(isset($_POST["userPlaylistId"]) ? $_POST["userPlaylistId"] : "");

        $query = "SELECT * FROM `userplaylists` WHERE `id` = :id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":id", $userPlaylist_id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(empty($result))
        {
            echo $errorController->index(404, [], ["Userplaylist Not Found."]);
            die();
        }

        $query2 = "DELETE FROM `userplaylists` WHERE `id` = :userPlaylist_id";

        $stmt = $pdo->prepare($query2);

        $stmt->bindParam(":userPlaylist_id", $userPlaylist_id);

        $stmt->execute();

        echo $errorController->index(200);
    
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