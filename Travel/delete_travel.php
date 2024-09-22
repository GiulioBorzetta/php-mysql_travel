<?php
include "../database/conn.php";

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM travel WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Record deleted successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: /");
exit();
