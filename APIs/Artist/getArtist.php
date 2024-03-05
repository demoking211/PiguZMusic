<?php

if ($_SERVER["REQUEST_METHOD"] === "GET")
{
    try
    {
        require_once '../ErrorHandler.php';
        require_once '../../includes/dbh.inc.php';

        $artistId = isset($_GET["artistId"]) ? $_GET["artistId"] : "";
        $modules = isset($_GET["modules"]) ? $_GET["modules"] : "";
    
        $query = "SELECT * FROM `artists` WHERE `id` = :artist_id";
    
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":artist_id", $artistId);
    
        $stmt->execute();

        $data["artist"] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            if(!empty($modules))
            {
                if(in_array("track", $modules))
                {
                    foreach ($data["artist"] as &$artist) {
                        $query2 = "SELECT track.* FROM `artists` AS artist INNER JOIN `artisttracks` AS artisttrack ON artist.id = artisttrack.artist_id INNER JOIN `tracks` AS track ON artisttrack.track_id = track.id WHERE artist.id = :artist_id";
        
                        $stmt = $pdo->prepare($query2);
        
                        $stmt->bindParam(":artist_id", $artist["id"]);
        
                        $stmt->execute();
        
                        $tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                        $artist["tracks"] = $tracks;
                    }
                    unset($track); // Unset the reference to avoid issues
                }
            }
        }

        $errorController = new ErrorController();

        if(!empty($data["artist"]))
        {
            echo $errorController->index(200, $data);
        }
        else
        {
            echo $errorController->index(404, [], ["Artist not found."]);
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