<?php

if ($_SERVER["REQUEST_METHOD"] === "GET")
{
    try
    {
        require_once '../ErrorHandler.php';
        require_once '../../includes/dbh.inc.php';

        $name = isset($_GET["name"]) ? '%' . $_GET["name"] . '%' : "";
        $mode = isset($_GET["mode"]) ? $_GET["mode"] : "standard";
        $modules = isset($_GET["modules"]) ? $_GET["modules"] : "";
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $limit = 10;

        // Calculate the offset based on the page number
        $offset = ($page - 1) * $limit;
    
        $query = "SELECT * FROM `playlists`";

        // Append conditions based on request parameters
        $conditions = [];
        
        if (!empty($name)) {
            $conditions[] = "`name` LIKE :title";
        }
        
        if (!empty($mode)) {
            if($mode == "standard" || $mode == "user")
            {
                $conditions[] = "`isUserPlaylist` = :isUserPlaylist";
            }
        }
        
        // Append conditions to the main query
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $query .= " LIMIT :limit OFFSET :offset";
    
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
        if (!empty($name)) {
            $stmt->bindParam(":title", $name);
        }
        if (!empty($mode)) {
            if($mode == "standard")
            {
                $isUserPlaylist = 0;
                $stmt->bindParam(":isUserPlaylist", $isUserPlaylist, PDO::PARAM_INT);
            }
            else if($mode == "user")
            {
                $isUserPlaylist = 1;
                $stmt->bindParam(":isUserPlaylist", $isUserPlaylist, PDO::PARAM_INT);
            }
        }
    
        $stmt->execute();

        $data["playlists"] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            if(!empty($modules))
            {
                if(in_array("track", $modules))
                {
                    foreach ($data["playlists"] as &$playlist) {
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
                    foreach ($data["playlists"] as &$playlist) {
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

        if(!empty($data["playlists"]))
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