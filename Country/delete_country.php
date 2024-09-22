<?php
include "../database/conn.php";

if (isset($_GET['name'])) {
    $name = urldecode($_GET['name']);

    $stmt = $conn->prepare("DELETE FROM country WHERE name = ?");
    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        echo "Country deleted successfully<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    $stmt->close();
    header("Location: /");
    exit();
}

$conn->close();
