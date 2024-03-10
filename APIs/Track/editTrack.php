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
        $genre_id = trim(isset($_POST["genreId"]) ? $_POST["genreId"] : "");
        $title = trim(isset($_POST["title"]) ? $_POST["title"] : "");
        $description = trim(isset($_POST["description"]) ? $_POST["description"] : "");

        $query = "SELECT * FROM `tracks` WHERE `id` = :id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!empty($result))
        {
            $user_id = $_SESSION['user_id'];

            if(empty($genre_id))
            {
                $genre_id = $result["genre_id"];
            }
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

                $thumbnailPath = $image_path . $result["thumbnail_path"];
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
                $newThumnailFilename = $result["thumbnail_path"];
            }

            if (isset($_FILES['music-path']) && $_FILES['music-path']['error'] === UPLOAD_ERR_OK) 
            {
                $musicName = $_FILES['music-path']['name'];
                $musicExtension = pathinfo($musicName, PATHINFO_EXTENSION);
                $musicSize = $_FILES['music-path']['size'];
                $musicTmp = $_FILES['music-path']['tmp_name'];
                $musicype = $_FILES['music-path']['type'];

                $musicPath = $track_path . $result["music_path"];
                if (file_exists($musicPath)) 
                {
                    unlink($musicPath);
                }

                $newMusicFilename = DIRECTORY_SEPARATOR . $date_utc8 . '_' . $result["id"] . '_1' . '.' . $musicExtension;
                $musicPath = $track_path . $newMusicFilename;

                if (!file_exists($image_path)) {
                    mkdir($image_path, 0777, true); // Creates the directory recursively
                }

                move_uploaded_file($musicTmp, $musicPath);
            }
            else
            {
                $newMusicFilename = $result["music_path"];
            }

            if (isset($_FILES['premium-music-path']) && $_FILES['premium-music-path']['error'] === UPLOAD_ERR_OK) 
            {
                $premiumMusicName = $_FILES['premium-music-path']['name'];
                $premiumMusicExtension = pathinfo($premiumMusicName, PATHINFO_EXTENSION);
                $premiumMusicSize = $_FILES['premium-music-path']['size'];
                $premiumMusicTmp = $_FILES['premium-music-path']['tmp_name'];
                $premiumMusicype = $_FILES['premium-music-path']['type'];

                $newPremiumMusicFilename = DIRECTORY_SEPARATOR . $date_utc8 . '_' . $result["id"] . '_2' . '.' . $premiumMusicExtension;
                $premiumMusicPath = $track_path . $newPremiumMusicFilename;

                $premiumMusicPath = $track_path . $result["music_premium_path"];
                if (file_exists($premiumMusicPath)) 
                {
                    unlink($premiumMusicPath);
                }

                if (!file_exists($image_path)) {
                    mkdir($image_path, 0777, true); // Creates the directory recursively
                }

                move_uploaded_file($premiumMusicTmp, $premiumMusicPath);
            }
            else
            {
                $newPremiumMusicFilename = $result["music_premium_path"];
            }

            $query2 = "UPDATE `tracks` SET `genre_id` = :genre_id, `name` = :title, `description` = :descr, `thumbnail_path` = :thumbnailPath, `music_path` = :musicPath, `music_premium_path` = :premiumMusicPath, `updated_by` = :user_id, `updated_datetime` = :currentDateTime WHERE `id` = :id";

            $stmt = $pdo->prepare($query2);

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":genre_id", $genre_id);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":descr", $description);
            $stmt->bindParam(":thumbnailPath", $newThumnailFilename);
            $stmt->bindParam(":musicPath", $newMusicFilename);
            $stmt->bindParam(":premiumMusicPath", $newPremiumMusicFilename);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":currentDateTime", $datetime_utc8);

            $stmt->execute();

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":id", $id);
    
            $stmt->execute();
    
            $data["track"] = $stmt->fetch(PDO::FETCH_ASSOC);

            echo $errorController->index(200, $data);
        }
        else
        {
            echo $errorController->index(404, [], ["Track not found."]);
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