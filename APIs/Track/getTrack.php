<?php

if ($_SERVER["REQUEST_METHOD"] === "GET")
{
    try
    {
        require_once '../ErrorHandler.php';
        require_once '../../includes/dbh.inc.php';

        $trackId = isset($_GET["trackId"]) ? $_GET["trackId"] : "";
        $modules = isset($_GET["modules"]) ? $_GET["modules"] : "";
    
        $query = "SELECT * FROM `tracks` WHERE `id` = :track_id";
    
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":track_id", $trackId);
    
        $stmt->execute();

        $data["track"] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            if(!empty($modules))
            {
                if(in_array("genre", $modules))
                {
                    foreach ($data["track"] as &$track) {
                        $query2 = "SELECT * FROM `genres` WHERE `id` = :genre_id"; // Limit tracks per genre
        
                        $stmt = $pdo->prepare($query2);
        
                        $stmt->bindParam(":genre_id", $track["genre_id"]);
        
                        $stmt->execute();
        
                        $genre = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                        $track["genre"] = $genre;
                    }
                    unset($track); // Unset the reference to avoid issues
                }
                if(in_array("artist", $modules))
                {
                    foreach ($data["track"] as &$track) {
                        $query2 = "SELECT artist.* FROM `artists` AS artist INNER JOIN `artisttracks` AS artisttrack ON artist.id = artisttrack.artist_id INNER JOIN `tracks` AS track ON artisttrack.track_id = track.id WHERE track.id = :track_id";
        
                        $stmt = $pdo->prepare($query2);
        
                        $stmt->bindParam(":track_id", $track["id"]);
        
                        $stmt->execute();
        
                        $artists = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                        $track["artists"] = $artists;
                    }
                    unset($track); // Unset the reference to avoid issues
                }
            }
        }

        $errorController = new ErrorController();

        if(!empty($data["track"]))
        {
            echo $errorController->index(200, $data);
        }
        else
        {
            echo $errorController->index(404, [], ["Track not found."]);
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