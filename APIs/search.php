<?php

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    try
    {
        require_once 'ErrorHandler.php';
        require_once '../includes/dbh.inc.php';

        $data = array();
        
        // Check if the search parameter is set
        if (isset($_GET['track'])) 
        {
            $input = "%" . $_GET['track'] . "%";
            // Sanitize the search input (prevent SQL injection, etc.)
            $query = "SELECT * FROM `tracks` WHERE `name` LIKE :input";
            $stmt = $pdo->prepare($query);
    
            $stmt->bindParam(":input", $input);
    
            $stmt->execute();
    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
            $data["tracks"] = $results;
        }
        if(isset($_GET['artist']))
        {
            $input = "%" . $_GET['artist'] . "%";

            $query = "SELECT * FROM `artists` WHERE `name` LIKE :input";
            $stmt = $pdo->prepare($query);
    
            $stmt->bindParam(":input", $input);
    
            $stmt->execute();
    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $data["artists"] = $results;
        }

        $errorController = new ErrorController();

        if(!empty($data["tracks"]) || !empty($data["artists"]))
        {
            echo $errorController->index(200, $data);
        }
        else
        {
            echo $errorController->index(404, [], ["Data not found"]);
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