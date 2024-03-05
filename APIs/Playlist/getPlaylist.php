<?php

if ($_SERVER["REQUEST_METHOD"] === "GET")
{
    try
    {
        require_once '../ErrorHandler.php';
        require_once '../../includes/dbh.inc.php';

        $playlistId = isset($_GET["playlistId"]) ? $_GET["playlistId"] : "";
        $modules = isset($_GET["modules"]) ? $_GET["modules"] : "";
    
        $query = "SELECT * FROM `playlists` WHERE `id` = :playlist_id";
    
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":playlist_id", $playlistId);
    
        $stmt->execute();

        $data["playlist"] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            if(!empty($modules))
            {
                if(in_array("track", $modules))
                {
                    foreach ($data["playlist"] as &$playlist) {
                        $query2 = "SELECT track.* FROM `playlists` AS playlist INNER JOIN `playlisttracks` AS playlisttrack ON playlist.id = playlisttrack.playlist_id INNER JOIN `tracks` AS track ON track.id = playlisttrack.track_id WHERE playlist.id = :playlist_id";
        
                        $stmt = $pdo->prepare($query2);
        
                        $stmt->bindParam(":playlist_id", $playlist["id"]);
        
                        $stmt->execute();
        
                        $tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                        $playlist["tracks"] = $tracks;
                    }
                    unset($track); // Unset the reference to avoid issues
                }
                if(in_array("user", $modules))
                {
                    foreach ($data["playlist"] as &$playlist) {
                        $query2 = "SELECT user.* FROM `playlists` AS playlist INNER JOIN `userplaylists` AS userplaylist ON playlist.id = userplaylist.playlist_id INNER JOIN `users` AS user ON user.id = userplaylist.user_id WHERE playlist.id = :playlist_id";
        
                        $stmt = $pdo->prepare($query2);
        
                        $stmt->bindParam(":playlist_id", $playlist["id"]);
        
                        $stmt->execute();
        
                        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                        $playlist["users"] = $users;
                    }
                    unset($track); // Unset the reference to avoid issues
                }
            }
        }

        $errorController = new ErrorController();

        if(!empty($data["playlist"]))
        {
            echo $errorController->index(200, $data);
        }
        else
        {
            echo $errorController->index(404, [], ["Playlist not found."]);
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