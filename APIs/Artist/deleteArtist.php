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

        $artist_id = isset($_POST["artistId"]) ? $_POST["artistId"] : "";

        $query = "SELECT * FROM `artists` WHERE `id` = :artist_id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":artist_id", $artist_id);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!empty($data))
        {
            $thumbnailPath = $image_path . $data["path"];
            if (file_exists($thumbnailPath))
            {
                unlink($thumbnailPath);
            }

            $query2 = "DELETE FROM `artists` WHERE `id` = :artist_id";

            $stmt = $pdo->prepare($query2);

            $stmt->bindParam(":artist_id", $artist_id);

            $stmt->execute();

            echo $errorController->index(200);
        }
        else
        {
            echo $errorController->index(404, [], ["Artist not found."]);
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