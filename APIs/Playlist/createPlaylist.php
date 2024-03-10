<?php

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    try
    {
        require_once '../ErrorHandler.php';
        require_once '../../includes/config.php';
        require_once '../../includes/dbh.inc.php';

        $errorController = new ErrorController();

        $user_id = $_SESSION['user_id'];
        
        $title = trim(isset($_POST['title']) ? $_POST["title"] : "");
        $description = trim(isset($_POST["description"])? $_POST["description"] : "");
        $isUserPlaylist = trim(isset($_POST["isUserPlaylist"])? $_POST["isUserPlaylist"] : 0);
        
        $id = GUIDv4();

        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) 
        {
            $thumbnailName = $_FILES['thumbnail']['name'];
            $extension = pathinfo($thumbnailName, PATHINFO_EXTENSION);
            $thumbnailSize = $_FILES['thumbnail']['size'];
            $thumbnailTmp = $_FILES['thumbnail']['tmp_name'];
            $thumbnailType = $_FILES['thumbnail']['type'];

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

            $newFilename = DIRECTORY_SEPARATOR . $date_utc8 . '_' . $id . '.' . $extension;

            $thumbnailPath = $image_path . $newFilename;
    
            if (!file_exists($image_path)) {
                mkdir($image_path, 0777, true); // Creates the directory recursively
            }

            move_uploaded_file($thumbnailTmp, $thumbnailPath);
        }
        else
        {
            $newFilename = "";
        }

        $query = "INSERT INTO `playlists`(`id`, `name`, `description`, `path`, `isUserPlaylist`, `created_by`, `created_datetime`) VALUES (:id, :title, :descr, :thumbnailPath, :isUserPlaylist, :user_id, :currentDateTime)";
    
        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":descr", $description);
        $stmt->bindParam(":thumbnailPath", $newFilename);
        $stmt->bindParam(":isUserPlaylist", $isUserPlaylist);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":currentDateTime", $datetime_utc8);
        
        $stmt->execute();
        
        if($isUserPlaylist == 1)
        {
            $query2 = "INSERT INTO `userplaylists`(`playlist_id`, `user_id`, `created_by`) VALUES (:id, :user_id, :user_id)";
        
            $stmt = $pdo->prepare($query2);
            
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":user_id", $user_id);
            
            $stmt->execute();
        }

        $query2 = "SELECT * FROM `playlists` WHERE `id` = :id";
    
        $stmt = $pdo->prepare($query2);
    
        $stmt->bindParam(":id", $id);
    
        $stmt->execute();

        $data["playlist"] = $stmt->fetch(PDO::FETCH_ASSOC);

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