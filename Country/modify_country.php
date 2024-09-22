<?php
include __DIR__ . '/../database/conn.php';

if (isset($_GET['name'])) {
    $name = urldecode($_GET['name']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['old_name']) && isset($_POST['new_name'])) {
    $old_name = $_POST['old_name'];
    $new_name = $_POST['new_name'];

    $stmt = $conn->prepare("UPDATE country SET name = ? WHERE name = ?");
    $stmt->bind_param("ss", $new_name, $old_name);

    if ($stmt->execute()) {
        echo "Country updated successfully<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    $stmt->close();
    header("Location: /");
    exit();
}

$conn->close();

echo '<h1>Modify Country</h1>';
echo '<form method="post">';
echo '    <input type="hidden" name="old_name" value="' . htmlspecialchars($name) . '">';
echo '    <label for="new_name">New Country Name:</label>';
echo '    <input type="text" id="new_name" name="new_name" value="' . htmlspecialchars($name) . '" required><br>';
echo '    <input type="submit" value="Modify Country">';
echo '</form>';
echo '<a href="/">Back to Home</a>';
