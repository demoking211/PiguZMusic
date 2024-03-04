<?php
if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    try
    {
        require_once '../ErrorHandler.php';
        require_once '../../includes/config.php';
        require_once '../../includes/dbh.inc.php';
    
        $user_id = $_SESSION['user_id'];
        
        $title = trim(isset($_POST['genreDetails']["title"]) ? $_POST['genreDetails']["title"] : "");
        $description = trim(isset($_POST['genreDetails']["description"]) ? $_POST['genreDetails']["description"] : "");

        $id = GUIDv4();
    
        $query = "INSERT INTO `genres`(`id`, `name`, `description`, `created_by`, `created_datetime`) VALUES (:id, :title, :descr, :user_id, :currentDateTime)";
    
        $stmt = $pdo->prepare($query);
    
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":descr", $description);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":currentDateTime", $date_utc8);
    
        $stmt->execute();

        $query2 = "SELECT * FROM `genres` WHERE `id` = :id";
    
        $stmt = $pdo->prepare($query2);
    
        $stmt->bindParam(":id", $id);
    
        $stmt->execute();

        $data["genre"] = $stmt->fetch(PDO::FETCH_ASSOC);

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