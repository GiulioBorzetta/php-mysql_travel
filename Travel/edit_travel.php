<?php
include "../database/conn.php";

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

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT number_places_available, country_1, country_2, country_3, country_4 FROM travel WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($numero_posti_disponibili, $country_1, $country_2, $country_3, $country_4);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number_places_available = $_POST['number_places_available'];
    $country_1 = $_POST['country_1'] ?: null;
    $country_2 = $_POST['country_2'] ?: null;
    $country_3 = $_POST['country_3'] ?: null;
    $country_4 = $_POST['country_4'] ?: null;

    $stmt = $conn->prepare("UPDATE travel SET number_places_available = ?, country_1 = ?, country_2 = ?, country_3 = ?, country_4 = ? WHERE id = ?");
    $stmt->bind_param("issssi", $number_places_available, $country_1, $country_2, $country_3, $country_4, $id);

    if ($stmt->execute()) {
        header("Location: /");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '<title>Edit Viaggi</title>';
echo '</head>';
echo '<body>';
echo '<h1>Edit Viaggi</h1>';
echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '?id=' . $id . '">';

echo '<label for="number_places_available">Numero Posti Disponibili:</label>';
echo '<input type="number" id="number_places_available" name="number_places_available" value="' . htmlspecialchars($numero_posti_disponibili) . '" required>';
echo '<br><br>';

echo '<label for="country_1">Country 1:</label>';
echo '<select id="country_1" name="country_1">';
echo '<option value="">Select Country</option>';
foreach ($countries as $country) {
    echo '<option value="' . htmlspecialchars($country) . '" ' . ($country == $country_1 ? 'selected' : '') . '>' . htmlspecialchars($country) . '</option>';
}
echo '</select>';
echo '<br><br>';

echo '<label for="country_2">Country 2:</label>';
echo '<select id="country_2" name="country_2">';
echo '<option value="">Select Country</option>';
foreach ($countries as $country) {
    echo '<option value="' . htmlspecialchars($country) . '" ' . ($country == $country_2 ? 'selected' : '') . '>' . htmlspecialchars($country) . '</option>';
}
echo '</select>';
echo '<br><br>';

echo '<label for="country_3">Country 3:</label>';
echo '<select id="country_3" name="country_3">';
echo '<option value="">Select Country</option>';
foreach ($countries as $country) {
    echo '<option value="' . htmlspecialchars($country) . '" ' . ($country == $country_3 ? 'selected' : '') . '>' . htmlspecialchars($country) . '</option>';
}
echo '</select>';
echo '<br><br>';

echo '<label for="country_4">Country 4:</label>';
echo '<select id="country_4" name="country_4">';
echo '<option value="">Select Country</option>';
foreach ($countries as $country) {
    echo '<option value="' . htmlspecialchars($country) . '" ' . ($country == $country_4 ? 'selected' : '') . '>' . htmlspecialchars($country) . '</option>';
}
echo '</select>';
echo '<br><br>';

echo '<input type="submit" value="Update">';
echo '</form>';

echo '<a href="/">Back to Home</a>';
echo '</body>';
echo '</html>';
