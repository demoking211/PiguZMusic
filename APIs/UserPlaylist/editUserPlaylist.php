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
        $playlist_id = trim(isset($_POST["playlistId"]) ? $_POST["playlistId"] : "");
        $user_id = trim(isset($_POST["userId"]) ? $_POST["userId"] : "");

        $query = "SELECT * FROM `userplaylists` WHERE `id` = :userPlaylist_id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":userPlaylist_id", $userPlaylist_id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(empty($result))
        {
            echo $errorController->index(404, [], ["UserPlaylist not found."]);
            die();
        }

        if(empty($playlist_id))
        {
            $playlist_id = $result["playlist_id"];
        }
        if(empty($user_id))
        {
            $user_id = $result["user_id"];
        }

        $session_user_id = $_SESSION['user_id'];

        $query2 = "UPDATE `userplaylists` SET `playlist_id` = :playlist_id, `user_id` = :user_id, `updated_by` = :session_user_id, `updated_datetime` = :currentDateTime WHERE `id` = :userPlaylist_id";

        $stmt = $pdo->prepare($query2);

        $stmt->bindParam(":userPlaylist_id", $userPlaylist_id);
        $stmt->bindParam(":playlist_id", $playlist_id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":session_user_id", $session_user_id);
        $stmt->bindParam(":currentDateTime", $datetime_utc8);

        $stmt->execute();

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":userPlaylist_id", $userPlaylist_id);

        $stmt->execute();

        $data["userplaylist"] = $stmt->fetch(PDO::FETCH_ASSOC);

        echo $errorController->index(200, $data);
    
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