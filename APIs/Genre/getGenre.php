<?php

if ($_SERVER["REQUEST_METHOD"] === "GET")
{
    try
    {
        require_once '../ErrorHandler.php';
        require_once '../../includes/dbh.inc.php';
        
        $genre_id = isset($_GET["genreId"]) ? $_GET["genreId"] : "";
        $modules = isset($_GET["modules"]) ? $_GET["modules"] : "";
    
        $query = "SELECT * FROM `genres` WHERE `id` = :genre_id";
    
        $stmt = $pdo->prepare($query);
    
        $stmt->bindParam(":genre_id", $genre_id);
    
        $stmt->execute();

        $data["genre"] = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($data) && $modules == "track")
        {
            $query2 = "SELECT * FROM `tracks` WHERE `genre_id` = :genre_id";
    
            $stmt = $pdo->prepare($query2);
        
            $stmt->bindParam(":genre_id", $genre_id);
        
            $stmt->execute();

            $tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $data["genre"]["tracks"] = $tracks;
        }

        $errorController = new ErrorController();

        if(!empty($data))
        {
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