<?php

if ($_SERVER["REQUEST_METHOD"] === "POST")
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

        $track_id = isset($_POST["trackId"]) ? $_POST["trackId"] : "";

        $query = "SELECT * FROM `tracks` WHERE `id` = :track_id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":track_id", $track_id);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!empty($data))
        {
            $thumbnailPath = $image_path . $data["thumbnail_path"];
            if (file_exists($thumbnailPath)) 
            {
                unlink($thumbnailPath);
            }

            $musicPath = $track_path . $data["music_path"];
            if (file_exists($musicPath)) 
            {
                unlink($musicPath);
            }

            $premiumMusicPath = $track_path . $data["music_premium_path"];
            if (file_exists($premiumMusicPath)) 
            {
                unlink($premiumMusicPath);
            }


            $query2 = "DELETE FROM `tracks` WHERE `id` = :track_id";

            $stmt = $pdo->prepare($query2);

            $stmt->bindParam(":track_id", $track_id);

            $stmt->execute();

            $query3 = "DELETE FROM `playlisttracks` WHERE `track_id` = :track_id";

            $stmt = $pdo->prepare($query3);

            $stmt->bindParam(":track_id", $track_id);

            $stmt->execute();

            $query4 = "DELETE FROM `artisttracks` WHERE `track_id` = :track_id";

            $stmt = $pdo->prepare($query4);

            $stmt->bindParam(":track_id", $track_id);

            $stmt->execute();

            echo $errorController->index(200);
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