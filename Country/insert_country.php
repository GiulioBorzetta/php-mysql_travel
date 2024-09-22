<?php
include "./database/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
    $country = $_POST['name'];

    $stmt = $conn->prepare("INSERT INTO country (name) VALUES (?)");
    $stmt->bind_param("s", $country);

    if ($stmt->execute()) {
        header("Location: /");
        exit();
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    $stmt->close();
}

$conn->close();

echo '<h1>Insert Country</h1>';
echo '<form method="post">';
echo '    <label for="name">Country:</label>';
echo '    <input type="text" id="name" name="name" required>';
echo '    <input type="submit" value="Include">';
echo '</form>';

echo '<a href="/">Back to Home</a>';
