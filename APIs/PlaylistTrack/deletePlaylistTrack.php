<?php

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    try
    {
        require_once '../ErrorHandler.php';
        require_once '../../includes/config.php';
        require_once '../../includes/dbh.inc.php';

        $errorController = new ErrorController();

        $playlistTrack_id = trim(isset($_POST["playlistTrackId"]) ? $_POST["playlistTrackId"] : "");

        $query = "SELECT * FROM `playlisttracks` WHERE `id` = :id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":id", $playlistTrack_id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(empty($result))
        {
            echo $errorController->index(404, [], ["PlaylistTrack Not Found."]);
            die();
        }

        $query2 = "DELETE FROM `playlisttracks` WHERE `id` = :playlistTrack_id";

        $stmt = $pdo->prepare($query2);

        $stmt->bindParam(":playlistTrack_id", $playlistTrack_id);

        $stmt->execute();

        echo $errorController->index(200);
    
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