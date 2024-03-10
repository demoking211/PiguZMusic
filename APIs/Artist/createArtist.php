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
        
        $name = trim(isset($_POST['name']) ? $_POST["name"] : "");
        $description = trim(isset($_POST["description"])? $_POST["description"] : "");
        
        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) 
        {
            $thumbnailName = $_FILES['thumbnail']['name'];
            $extension = pathinfo($thumbnailName, PATHINFO_EXTENSION);
            $thumbnailSize = $_FILES['thumbnail']['size'];
            $thumbnailTmp = $_FILES['thumbnail']['tmp_name'];
            $thumbnailType = $_FILES['thumbnail']['type'];
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($thumbnailType, $allowedTypes)) {
            echo $errorController->index(400, [], ["Only JPG, PNG, and GIF files are allowed."]);
            die();
        }

        $maxSize = 5 * 1024 * 1024; // 5MB
        if ($thumbnailSize > $maxSize) {
            echo $errorController->index(400, [], ["File size exceeds the maximum limit (5MB)."]);
            die();
        }

        $id = GUIDv4();

        $newFilename = DIRECTORY_SEPARATOR . $date_utc8 . '_' . $id . '.' . $extension;

        $thumbnailPath = $image_path . $newFilename;

        if (!file_exists($image_path)) {
            mkdir($image_path, 0777, true); // Creates the directory recursively
        }
    
        if(move_uploaded_file($thumbnailTmp, $thumbnailPath))
        {
            $query = "INSERT INTO `artists`(`id`, `name`, `description`, `path`, `created_by`, `created_datetime`) VALUES (:id, :title, :descr, :thumbnailPath, :user_id, :currentDateTime)";
    
            $stmt = $pdo->prepare($query);
        
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":title", $name);
            $stmt->bindParam(":descr", $description);
            $stmt->bindParam(":thumbnailPath", $newFilename);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":currentDateTime", $datetime_utc8);
        
            $stmt->execute();
        }

        $query2 = "SELECT * FROM `artists` WHERE `id` = :id";
    
        $stmt = $pdo->prepare($query2);
    
        $stmt->bindParam(":id", $id);
    
        $stmt->execute();

        $data["artist"] = $stmt->fetch(PDO::FETCH_ASSOC);

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