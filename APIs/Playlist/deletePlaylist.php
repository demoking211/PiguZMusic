<?php

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    try
    {
        require_once '../ErrorHandler.php';
        require_once '../../includes/dbh.inc.php';

        $playlist_id = isset($_POST["playlistId"]) ? $_POST["playlistId"] : "";

        $query = "SELECT * FROM `playlists` WHERE `id` = :playlist_id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":playlist_id", $playlist_id);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $errorController = new ErrorController();
        
        if(!empty($data))
        {
            $thumbnailPath = $image_path . $data["path"];
            if (file_exists($thumbnailPath)) 
            {
                unlink($thumbnailPath);
            }

            $query2 = "DELETE FROM `playlists` WHERE `id` = :playlist_id";

            $stmt = $pdo->prepare($query2);

            $stmt->bindParam(":playlist_id", $playlist_id);

            $stmt->execute();

            $query3 = "DELETE FROM `playlisttracks` WHERE `playlist_id` = :playlist_id";

            $stmt = $pdo->prepare($query3);

            $stmt->bindParam(":playlist_id", $playlist_id);

            $stmt->execute();

            echo $errorController->index(200);
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