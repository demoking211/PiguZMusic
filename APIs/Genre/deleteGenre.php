<?php

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    try
    {
        require_once '../ErrorHandler.php';
        require_once '../../includes/dbh.inc.php';

        $genre_id = isset($_POST["genreId"]) ? $_POST["genreId"] : "";

        $query = "SELECT * FROM `genres` WHERE `id` = :genre_id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":genre_id", $genre_id);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $errorController = new ErrorController();
        
        if(!empty($data))
        {
            $query2 = "DELETE FROM `genres` WHERE `id` = :genre_id";

            $stmt = $pdo->prepare($query2);

            $stmt->bindParam(":genre_id", $genre_id);

            $stmt->execute();

            echo $errorController->index(200);
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