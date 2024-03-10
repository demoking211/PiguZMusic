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

        $query = "SELECT * FROM `artisttracks` WHERE `id` = :id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":id", $artistTrack_id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(empty($result))
        {
            echo $errorController->index(404, [], ["ArtistTrack Not Found."]);
            die();
        }

        $query2 = "DELETE FROM `artisttracks` WHERE `id` = :artistTrack_id";

        $stmt = $pdo->prepare($query2);

        $stmt->bindParam(":artistTrack_id", $artistTrack_id);

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