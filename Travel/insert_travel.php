<?php
include "./database/conn.php";

$stmd = $conn->prepare("SELECT name FROM country");
$stmd->execute();
$result = $stmd->get_result();
$countries = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $countries[] = $row["name"];
    }
}
$stmd->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number_places_available = $_POST['number_places_available'];
    $country_1 = $_POST['country_1'] ?? null;
    $country_2 = $_POST['country_2'] ?? null;
    $country_3 = $_POST['country_3'] ?? null;
    $country_4 = $_POST['country_4'] ?? null;

    $stmt = $conn->prepare("INSERT INTO travel (number_places_available, country_1, country_2, country_3, country_4) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $number_places_available, $country_1, $country_2, $country_3, $country_4);

    if ($stmt->execute()) {
        header("Location: /");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

function generateCountryOptions($countries)
{
    $options = '<option value="">Select a country</option>';
    foreach ($countries as $country) {
        $options .= '<option value="' . htmlspecialchars($country) . '">' . htmlspecialchars($country) . '</option>';
    }
    return $options;
}

echo '<h1>Insert Travel</h1>';
echo '<form method="post">';
echo '<label for="number_places_available">Number of places available:</label>';
echo '<input type="number" id="number_places_available" name="number_places_available" required>';
echo '<br><br>';

for ($i = 1; $i <= 4; $i++) {
    echo '<label for="country_' . $i . '">Country ' . $i . ':</label>';
    echo '<select id="country_' . $i . '" name="country_' . $i . '">';
    echo generateCountryOptions($countries);
    echo '</select>';
    echo '<br><br>';
}

echo '<input type="submit" value="Submit">';
echo '</form>';
echo '<a href="/">Back To Home</a>';
