<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Connection and Query</title>
</head>
<body>

<h2>Select User Type</h2>

<form method="post">
    <button type="submit" name="normalUser">Normal User</button>
    <button type="submit" name="premiumUser">Premium User</button>
    <input type="hidden" name="formSubmitted" value="1">
</form>

<?php
// Check if the form is submitted
if (isset($_POST['formSubmitted']) && ($_POST['formSubmitted'] == 1)) {
    // Check if either button is clicked
    if (isset($_POST['normalUser']) || isset($_POST['premiumUser'])) {
        // Determine which button was clicked
        $userType = (isset($_POST['normalUser'])) ? 'normal' : 'premium';

        // Database connection details
        $host = 'localhost:3306';
        $dbname = 'piguz_db';
        $dbusername = 'root';
        $dbpassword = '';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Determine the status based on the user type
            $status = ($userType == 'normal') ? 1 : 2;

            // Example INSERT query based on user type
            $insertQuery = "INSERT INTO User (username, passwordHash, email, created_by, created_datetime, status, reamrks) 
                            VALUES ('new_user', 'password123', 'new_user@example.com', 'admin', NOW(), $status, 'New User')";
            
            $pdo->exec($insertQuery);

            echo "<p>Connected to $userType user database successfully!</p>";
            echo "<p>New user inserted with status $status!</p>";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
?>

</body>
</html>
