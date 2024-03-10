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

        $id = trim(isset($_POST["id"]) ? $_POST["id"] : "");
        $title = trim(isset($_POST["title"]) ? $_POST["title"] : "");
        $description = trim(isset($_POST["description"]) ? $_POST["description"] : "");
        $isUserPlaylist = trim(isset($_POST["isUserPlaylist"])? $_POST["isUserPlaylist"] : 0);

        $query = "SELECT * FROM `playlists` WHERE `id` = :id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
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

            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) 
            {
                $thumbnailName = $_FILES['thumbnail']['name'];
                $thumbnailExtension = pathinfo($thumbnailName, PATHINFO_EXTENSION);
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

                $thumbnailPath = $image_path . $result["path"];
                if (file_exists($thumbnailPath)) 
                {
                    unlink($thumbnailPath);
                }
        
                $newThumnailFilename = DIRECTORY_SEPARATOR . $date_utc8 . '_' . $result["id"] . '.' . $thumbnailExtension;
                $thumbnailPath = $image_path . $newThumnailFilename;

                if (!file_exists($image_path)) {
                    mkdir($image_path, 0777, true); // Creates the directory recursively
                }

                move_uploaded_file($thumbnailTmp, $thumbnailPath);
            }
            else
            {
                $newThumnailFilename = $result["path"];
            }

            $query2 = "UPDATE `playlists` SET `name` = :title, `description` = :descr, `path` = :thumbnailPath, `isUserPlaylist` = :isUserPlaylist, `updated_by` = :user_id, `updated_datetime` = :currentDateTime WHERE `id` = :id";

            $stmt = $pdo->prepare($query2);

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":descr", $description);
            $stmt->bindParam(":thumbnailPath", $newThumnailFilename);
            $stmt->bindParam(":isUserPlaylist", $isUserPlaylist);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":currentDateTime", $datetime_utc8);

            $stmt->execute();

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":id", $id);
    
            $stmt->execute();
    
            $data["playlist"] = $stmt->fetch(PDO::FETCH_ASSOC);

            echo $errorController->index(200, $data);
        }
        else
        {
            echo $errorController->index(404, [], ["Playlist not found."]);
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