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

        $artistTrack_id = trim(isset($_POST["artistTrackId"]) ? $_POST["artistTrackId"] : "");
        $artist_id = trim(isset($_POST["artistId"]) ? $_POST["artistId"] : "");
        $track_id = trim(isset($_POST["trackId"]) ? $_POST["trackId"] : "");

        $query = "SELECT * FROM `artisttracks` WHERE `id` = :artistTrack_id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":artistTrack_id", $artistTrack_id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(empty($result))
        {
            echo $errorController->index(404, [], ["ArtistTrack not found."]);
            die();
        }

        if(empty($artist_id))
        {
            $artist_id = $result["artist_id"];
        }
        if(empty($track_id))
        {
            $track_id = $result["track_id"];
        }

        $user_id = $_SESSION['user_id'];

        $query2 = "UPDATE `artisttracks` SET `artist_id` = :artist_id, `track_id` = :track_id, `updated_by` = :user_id, `updated_datetime` = :currentDateTime WHERE `id` = :artistTrack_id";

        $stmt = $pdo->prepare($query2);

        $stmt->bindParam(":artistTrack_id", $artistTrack_id);
        $stmt->bindParam(":artist_id", $artist_id);
        $stmt->bindParam(":track_id", $track_id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":currentDateTime", $datetime_utc8);

        $stmt->execute();

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":artistTrack_id", $artistTrack_id);

        $stmt->execute();

        $data["artisttrack"] = $stmt->fetch(PDO::FETCH_ASSOC);

        echo $errorController->index(200, $data);
    
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