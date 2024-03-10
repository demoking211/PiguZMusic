<?php

if ($_SERVER["REQUEST_METHOD"] === "GET")
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

        $userPlaylist_id = trim(isset($_GET["userPlaylistId"]) ? $_GET["userPlaylistId"] : "");
        $playlist_id = trim(isset($_GET["playlistId"]) ? $_GET["playlistId"] : "");
        $user_id = trim(isset($_GET["userId"]) ? $_GET["userId"] : "");

        if(empty($userPlaylist_id) && empty($playlist_id) && empty($user_id))
        {
            echo $errorController->index(404, [], ["404 Not Found"]);
            die();
        }
    
        $query = "SELECT * FROM `userplaylists`";

        if(!empty($userPlaylist_id))
        {
            $query .= " WHERE `id` = :userPlaylist_id";
        }
        else if(!empty($playlist_id) && !empty($user_id))
        {
            echo $errorController->index(404, [], ["Either playlist_id OR user_id ONLY."]);
            die();
        }
        else if(!empty($playlist_id))
        {
            $query .= " WHERE `playlist_id` = :playlist_id";
        }
        else if(!empty($user_id))
        {
            $query .= " WHERE `user_id` = :user_id";
        }
    
        $stmt = $pdo->prepare($query);

        if(!empty($userPlaylist_id))
        {
            $stmt->bindParam(":userPlaylist_id", $userPlaylist_id);
        }
        else if(!empty($playlist_id))
        {
            $stmt->bindParam(":playlist_id", $playlist_id);
        }
        else if(!empty($user_id))
        {
            $stmt->bindParam(":user_id", $user_id);
        }
    
        $stmt->execute();

        $data["userplaylists"] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($data["userplaylists"]))
        {
            foreach ($data["userplaylists"] as &$userplaylist) {
                $query2 = "SELECT * FROM `playlists` WHERE `id` = :playlist_id";

                $stmt = $pdo->prepare($query2);

                $stmt->bindParam(":playlist_id", $userplaylist["playlist_id"]);

                $stmt->execute();

                $playlist = $stmt->fetch(PDO::FETCH_ASSOC);

                $userplaylist["playlist"] = $playlist;
            }

            echo $errorController->index(200, $data);
        }
        else
        {
            echo $errorController->index(404, [], ["Userplaylist not found."]);
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