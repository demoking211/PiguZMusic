<?php

declare(strict_types=1);

// Read functions
function get_username(object $pdo, string $username)
{
    $query = "SELECT username FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(object $pdo, string $email)
{
    $query = "SELECT email FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":email", $email);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

// Create function
function set_user(object $pdo, string $username, string $password, string $email)
{
    $id = GUIDv4();

    $query = "INSERT INTO `users` (`id`, `username`, `passwordHash`, `email`, `created_by`) VALUES (:id, :username, :pwd, :email, :id);";
    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pwd", $hashedPassword);
    $stmt->bindParam(":email", $email);

    $stmt->execute();

    $role_id = 3;

    $query2 = "INSERT INTO `userroles` (`user_id`, `role_id`) VALUES (:user_id, :role_id);";
    $stmt = $pdo->prepare($query2);

    $stmt->bindParam(":user_id", $id);
    $stmt->bindParam(":role_id", $role_id);

    $stmt->execute();

    $playlist_id = GUIDv4();
    $playlist_name = "Episodes for later";
    $playlist_description = "Auto Playlist";
    $isUserPlaylist = 1;

    $query3 = "INSERT INTO `playlists` (`id`, `name`, `description`, `isUserPlaylist`, `created_by`) VALUES (:playlist_id, :playlist_name, :playlist_description, :isUserPlaylist, :user_id);";
    $stmt = $pdo->prepare($query3);

    $stmt->bindParam(":playlist_id", $playlist_id);
    $stmt->bindParam(":playlist_name", $playlist_name);
    $stmt->bindParam(":playlist_description", $playlist_description);
    $stmt->bindParam(":isUserPlaylist", $isUserPlaylist);
    $stmt->bindParam(":user_id", $id);

    $stmt->execute();

    $query4 = "INSERT INTO `userplaylists` (`playlist_id`, `user_id`, `created_by`) VALUES (:playlist_id, :user_id, :user_id);";
    $stmt = $pdo->prepare($query4);

    $stmt->bindParam(":playlist_id", $playlist_id);
    $stmt->bindParam(":user_id", $id);

    $stmt->execute();
}