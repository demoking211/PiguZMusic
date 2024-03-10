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

        $playlistTrack_id = trim(isset($_POST["playlistTrackId"]) ? $_POST["playlistTrackId"] : "");
        $playlist_id = trim(isset($_POST["playlistId"]) ? $_POST["playlistId"] : "");
        $track_id = trim(isset($_POST["trackId"]) ? $_POST["trackId"] : "");

        $query = "SELECT * FROM `playlisttracks` WHERE `id` = :playlistTrack_id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":playlistTrack_id", $playlistTrack_id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(empty($result))
        {
            echo $errorController->index(404, [], ["PlaylistTrack not found."]);
            die();
        }

        if(empty($playlist_id))
        {
            $playlist_id = $result["playlist_id"];
        }
        if(empty($track_id))
        {
            $track_id = $result["track_id"];
        }

        $user_id = $_SESSION['user_id'];

        $query2 = "UPDATE `playlisttracks` SET `playlist_id` = :playlist_id, `track_id` = :track_id, `updated_by` = :user_id, `updated_datetime` = :currentDateTime WHERE `id` = :playlistTrack_id";

        $stmt = $pdo->prepare($query2);

        $stmt->bindParam(":playlistTrack_id", $playlistTrack_id);
        $stmt->bindParam(":playlist_id", $playlist_id);
        $stmt->bindParam(":track_id", $track_id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":currentDateTime", $datetime_utc8);

        $stmt->execute();

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":playlistTrack_id", $playlistTrack_id);

        $stmt->execute();

        $data["playlisttrack"] = $stmt->fetch(PDO::FETCH_ASSOC);

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