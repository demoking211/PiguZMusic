<?php

if ($_SERVER["REQUEST_METHOD"] === "GET")
{
    try
    {
        require_once '../ErrorHandler.php';
        require_once '../../includes/dbh.inc.php';

        $playlistTrack_id = trim(isset($_GET["playlistTrackId"]) ? $_GET["playlistTrackId"] : "");
        $playlist_id = trim(isset($_GET["playlistId"]) ? $_GET["playlistId"] : "");
        $track_id = trim(isset($_GET["trackId"]) ? $_GET["trackId"] : "");

        $errorController = new ErrorController();

        if(empty($playlistTrack_id) && empty($playlist_id) && empty($track_id))
        {
            echo $errorController->index(404, [], ["404 Not Found"]);
            die();
        }
    
        $query = "SELECT * FROM `playlisttracks`";

        if(!empty($playlistTrack_id))
        {
            $query .= " WHERE `id` = :playlistTrack_id";
        }
        else if(!empty($playlist_id) && !empty($track_id))
        {
            echo $errorController->index(404, [], ["Either playlist_id OR track_id ONLY."]);
            die();
        }
        else if(!empty($playlist_id))
        {
            $query .= " WHERE `playlist_id` = :playlist_id";
        }
        else if(!empty($track_id))
        {
            $query .= " WHERE `track_id` = :track_id";
        }
    
        $stmt = $pdo->prepare($query);

        if(!empty($playlistTrack_id))
        {
            $stmt->bindParam(":playlistTrack_id", $playlistTrack_id);
        }
        else if(!empty($playlist_id))
        {
            $stmt->bindParam(":playlist_id", $playlist_id);
        }
        else if(!empty($track_id))
        {
            $stmt->bindParam(":track_id", $track_id);
        }
    
        $stmt->execute();

        $data["playlisttracks"] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($data["playlisttracks"]))
        {
            foreach ($data["playlisttracks"] as &$playlisttrack) {
                $query2 = "SELECT * FROM `playlists` WHERE `id` = :playlist_id";

                $stmt = $pdo->prepare($query2);

                $stmt->bindParam(":playlist_id", $playlisttrack["playlist_id"]);

                $stmt->execute();

                $playlist = $stmt->fetch(PDO::FETCH_ASSOC);

                $playlisttrack["playlist"] = $playlist;

                $query2 = "SELECT * FROM `tracks` WHERE `id` = :track_id";

                $stmt = $pdo->prepare($query2);

                $stmt->bindParam(":track_id", $playlisttrack["track_id"]);

                $stmt->execute();

                $track = $stmt->fetch(PDO::FETCH_ASSOC);

                $playlisttrack["track"] = $track;
            }

            echo $errorController->index(200, $data);
        }
        else
        {
            echo $errorController->index(404, [], ["PlaylistTracks not found."]);
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