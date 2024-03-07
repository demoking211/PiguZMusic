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
        $genre_id = trim(isset($_POST["genreId"]) ? $_POST["genreId"] : "");
        
        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) 
        {
            $thumbnailName = $_FILES['thumbnail']['name'];
            $thumbnailExtension = pathinfo($thumbnailName, PATHINFO_EXTENSION);
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

        if (isset($_FILES['music-path']) && $_FILES['music-path']['error'] === UPLOAD_ERR_OK) 
        {
            $musicName = $_FILES['music-path']['name'];
            $musicExtension = pathinfo($musicName, PATHINFO_EXTENSION);
            $musicSize = $_FILES['music-path']['size'];
            $musicTmp = $_FILES['music-path']['tmp_name'];
            $musicype = $_FILES['music-path']['type'];
        }

        if (isset($_FILES['premium-music-path']) && $_FILES['premium-music-path']['error'] === UPLOAD_ERR_OK) 
        {
            $premiumMusicName = $_FILES['premium-music-path']['name'];
            $premiumMusicExtension = pathinfo($premiumMusicName, PATHINFO_EXTENSION);
            $premiumMusicSize = $_FILES['premium-music-path']['size'];
            $premiumMusicTmp = $_FILES['premium-music-path']['tmp_name'];
            $premiumMusicype = $_FILES['premium-music-path']['type'];
        }

        $id = GUIDv4();

        $newThumnailFilename = DIRECTORY_SEPARATOR . $date_utc8 . '_' . $id . '.' . $thumbnailExtension;
        $thumbnailPath = $image_path . $newThumnailFilename;

        $newMusicFilename = DIRECTORY_SEPARATOR . $date_utc8 . '_' . $id . '_1' . '.' . $musicExtension;
        $musicPath = $track_path . $newMusicFilename;

        $newPremiumMusicFilename = DIRECTORY_SEPARATOR . $date_utc8 . '_' . $id . '_2' . '.' . $premiumMusicExtension;
        $premiumMusicPath = $track_path . $newPremiumMusicFilename;

        if (!file_exists($image_path)) {
            mkdir($image_path, 0777, true); // Creates the directory recursively
        }
        if (!file_exists($track_path)) {
            mkdir($track_path, 0777, true); // Creates the directory recursively
        }
    
        if(move_uploaded_file($thumbnailTmp, $thumbnailPath) && move_uploaded_file($musicTmp, $musicPath) && move_uploaded_file($premiumMusicTmp, $premiumMusicPath))
        {
            $query = "INSERT INTO `tracks`(`id`, `genre_id`, `name`, `description`, `thumbnail_path`, `music_path`, `music_premium_path`, `created_by`, `created_datetime`) VALUES (:id, :genre_id, :title, :descr, :thumbnailPath, :musicPath, :premiumMusicPath, :user_id, :currentDateTime)";
    
            $stmt = $pdo->prepare($query);
        
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
        }

        $query2 = "SELECT * FROM `tracks` WHERE `id` = :id";
    
        $stmt = $pdo->prepare($query2);
    
        $stmt->bindParam(":id", $id);
    
        $stmt->execute();

        $data["track"] = $stmt->fetch(PDO::FETCH_ASSOC);

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