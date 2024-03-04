<?php

if ($_SERVER["REQUEST_METHOD"] === "GET")
{
    try
    {
        require_once '../ErrorHandler.php';
        require_once '../../includes/dbh.inc.php';

        $name = isset($_GET["name"]) ? $_GET["name"] : "";
        $modules = isset($_GET["modules"]) ? $_GET["modules"] : "";
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $limit = 10;

        // Calculate the offset based on the page number
        $offset = ($page - 1) * $limit;
    
        $query = "SELECT * FROM `genres`";

        if(!empty($name))
        {
            $query = "SELECT * FROM `genres` WHERE `name` LIKE :title";
        }

        $query .= " LIMIT :limit OFFSET :offset";
    
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
        if (!empty($name)) {
            $stmt->bindParam(":title", $name);
        }
    
        $stmt->execute();

        $data["genres"] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data) && $modules == "track") {
            foreach ($data["genres"] as &$genre) {
                $query2 = "SELECT * FROM `tracks` WHERE `genre_id` = :genre_id"; // Limit tracks per genre

                $stmt = $pdo->prepare($query2);

                $stmt->bindParam(":genre_id", $genre["id"]);

                $stmt->execute();

                $tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $genre["tracks"] = $tracks;
            }
            unset($genre); // Unset the reference to avoid issues
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