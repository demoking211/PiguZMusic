<?php

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    try
    {
        require_once '../ErrorHandler.php';
        require_once '../../includes/config.php';
        require_once '../../includes/dbh.inc.php';

        $genre_id = trim(isset($_POST['genreDetails']["genreId"]) ? $_POST['genreDetails']["genreId"] : "");
        $title = trim(isset($_POST['genreDetails']["title"]) ? $_POST['genreDetails']["title"] : "");
        $description = trim(isset($_POST['genreDetails']["description"]) ? $_POST['genreDetails']["description"] : "");

        $query = "SELECT * FROM `genres` WHERE `id` = :genre_id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":genre_id", $genre_id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $errorController = new ErrorController();
        
        if(!empty($result))
        {
            $user_id = $_SESSION['user_id'];

            if(empty($title))
            {
                $title = $result["name"];
            }
            if(empty($description))
            {
                $description = $result["description"];
            }

            $query2 = "UPDATE `genres` SET `name` = :title, `description` = :descr, `updated_by` = :user_id, `updated_datetime` = :currentDateTime WHERE `id` = :genre_id";

            $stmt = $pdo->prepare($query2);

            $stmt->bindParam(":genre_id", $genre_id);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":descr", $description);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":currentDateTime", $date_utc8);

            $stmt->execute();

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":genre_id", $genre_id);
    
            $stmt->execute();
    
            $data["genre"] = $stmt->fetch(PDO::FETCH_ASSOC);

            echo $errorController->index(200, $data);
        }
        else
        {
            echo $errorController->index(404, [], ["Genre not found."]);
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