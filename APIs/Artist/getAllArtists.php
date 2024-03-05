<?php

if ($_SERVER["REQUEST_METHOD"] === "GET")
{
    try
    {
        require_once '../ErrorHandler.php';
        require_once '../../includes/dbh.inc.php';

        $name = isset($_GET["name"]) ? '%' . $_GET["name"] . '%' : "";
        $modules = isset($_GET["modules"]) ? $_GET["modules"] : "";
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $limit = 10;

        // Calculate the offset based on the page number
        $offset = ($page - 1) * $limit;
    
        $query = "SELECT * FROM `artists`";

        if (!empty($name)) {
            $query .= " WHERE `name` LIKE :artist_name";
        }

        $query .= " LIMIT :limit OFFSET :offset";
    
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
        if (!empty($name)) {
            $stmt->bindParam(":artist_name", $name);
        }
    
        $stmt->execute();

        $data["artists"] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            if(!empty($modules))
            {
                if(in_array("track", $modules))
                {
                    foreach ($data["artists"] as &$artist) {
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

        if(!empty($data["artists"]))
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