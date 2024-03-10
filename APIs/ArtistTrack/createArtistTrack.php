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
    
        $user_id = $_SESSION['user_id'];
        
        $artist_id = trim(isset($_POST["artistId"]) ? $_POST["artistId"] : "");
        $track_id = trim(isset($_POST["trackId"]) ? $_POST["trackId"] : "");

        $query = "SELECT * FROM `artists` WHERE `id` = :id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":id", $artist_id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(empty($result))
        {
            echo $errorController->index(404, [], ["Artist Not Found."]);
            die();
        }

        $query = "SELECT * FROM `tracks` WHERE `id` = :id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":id", $track_id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(empty($result))
        {
            echo $errorController->index(404, [], ["Track Not Found."]);
            die();
        }
    
        $query = "INSERT INTO `artisttracks`(`track_id`, `artist_id`, `created_by`, `created_datetime`) VALUES (:track_id, :artist_id, :user_id, :currentDateTime)";
    
        $stmt = $pdo->prepare($query);
    
        $stmt->bindParam(":track_id", $track_id);
        $stmt->bindParam(":artist_id", $artist_id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":currentDateTime", $datetime_utc8);
    
        $stmt->execute();

        $query2 = "SELECT * FROM `artisttracks` WHERE `track_id` = :track_id AND `artist_id` = :artist_id";
    
        $stmt = $pdo->prepare($query2);
    
        $stmt->bindParam(":track_id", $track_id);
        $stmt->bindParam(":artist_id", $artist_id);
    
        $stmt->execute();

        $data["artisttrack"] = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($data))
        {
            echo $errorController->index(200, $data);
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