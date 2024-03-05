<?php

if ($_SERVER["REQUEST_METHOD"] === "GET")
{
    try
    {
        require_once '../ErrorHandler.php';
        require_once '../../includes/dbh.inc.php';

        $title = isset($_GET["title"]) ? '%' . $_GET["title"] . '%' : "";
        $genreId = isset($_GET["genreId"]) ? $_GET["genreId"] : "";
        $modules = isset($_GET["modules"]) ? $_GET["modules"] : "";
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $limit = 10;

        // Calculate the offset based on the page number
        $offset = ($page - 1) * $limit;
    
        $query = "SELECT * FROM `tracks`";

        // Append conditions based on request parameters
        $conditions = [];
        
        if (!empty($title)) {
            $conditions[] = "`name` LIKE :title";
        }
        
        if (!empty($genreId)) {
            $conditions[] = "`genre_id` = :genreId";
        }
        
        // Append conditions to the main query
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $query .= " LIMIT :limit OFFSET :offset";
    
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
        if (!empty($title)) {
            $stmt->bindParam(":title", $title);
        }
        if (!empty($genreId)) {
            $stmt->bindParam(":genreId", $genreId);
        }
    
        $stmt->execute();

        $data["tracks"] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            if(!empty($modules))
            {
                if(in_array("genre", $modules))
                {
                    foreach ($data["tracks"] as &$track) {
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
                    foreach ($data["tracks"] as &$track) {
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

        if(!empty($data["tracks"]))
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