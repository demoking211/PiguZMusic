<?php

declare(strict_types=1);

function get_username(object $pdo, string $username)
{
    $query = "SELECT * FROM users WHERE username = :username OR email = :username;";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}