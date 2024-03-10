<?php

if ($_SERVER["REQUEST_METHOD"] === "GET")
{
    try
    {
        require_once '../ErrorHandler.php';
        require_once '../../includes/dbh.inc.php';

        $artistTrack_id = trim(isset($_GET["artistTrackId"]) ? $_GET["artistTrackId"] : "");
        $artist_id = trim(isset($_GET["artistId"]) ? $_GET["artistId"] : "");
        $track_id = trim(isset($_GET["trackId"]) ? $_GET["trackId"] : "");

        $errorController = new ErrorController();

        if(empty($artistTrack_id) && empty($artist_id) && empty($track_id))
        {
            echo $errorController->index(404, [], ["404 Not Found"]);
            die();
        }
    
        $query = "SELECT * FROM `artisttracks`";

        if(!empty($artistTrack_id))
        {
            $query .= " WHERE `id` = :artistTrack_id";
        }
        else if(!empty($artist_id) && !empty($track_id))
        {
            echo $errorController->index(404, [], ["Either artist_id OR track_id ONLY."]);
            die();
        }
        else if(!empty($artist_id))
        {
            $query .= " WHERE `artist_id` = :artist_id";
        }
        else if(!empty($track_id))
        {
            $query .= " WHERE `track_id` = :track_id";
        }
    
        $stmt = $pdo->prepare($query);

        if(!empty($artistTrack_id))
        {
            $stmt->bindParam(":artistTrack_id", $artistTrack_id);
        }
        else if(!empty($artist_id))
        {
            $stmt->bindParam(":artist_id", $artist_id);
        }
        else if(!empty($track_id))
        {
            $stmt->bindParam(":track_id", $track_id);
        }
    
        $stmt->execute();

        $data["artisttracks"] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($data["artisttracks"]))
        {
            foreach ($data["artisttracks"] as &$artisttrack) {
                $query2 = "SELECT * FROM `artists` WHERE `id` = :artist_id";

                $stmt = $pdo->prepare($query2);

                $stmt->bindParam(":artist_id", $artisttrack["artist_id"]);

                $stmt->execute();

                $artist = $stmt->fetch(PDO::FETCH_ASSOC);

                $artisttrack["artist"] = $artist;

                $query2 = "SELECT * FROM `tracks` WHERE `id` = :track_id";

                $stmt = $pdo->prepare($query2);

                $stmt->bindParam(":track_id", $artisttrack["track_id"]);

                $stmt->execute();

                $track = $stmt->fetch(PDO::FETCH_ASSOC);

                $artisttrack["track"] = $track;
            }

            echo $errorController->index(200, $data);
        }
        else
        {
            echo $errorController->index(404, [], ["ArtistTracks not found."]);
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