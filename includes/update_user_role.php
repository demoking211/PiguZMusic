<?php
require_once 'dbh.inc.php';
require_once 'config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    // Sanitize and validate userId and roleId as needed

    // Update user role in the database
    $sql = "UPDATE `userroles` SET `role_id` = 2 WHERE `user_id` = :userId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();

    // Respond with a JSON message indicating success
    echo json_encode(['message' => 'User role updated successfully.']);
} else {
    // Respond with an error message if the request is not valid
    echo json_encode(['message' => 'Invalid request.']);
}
?>
