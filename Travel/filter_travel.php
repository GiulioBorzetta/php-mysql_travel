<?php
include "./database/conn.php";

$name_search = isset($_GET['name_search']) ? $_GET['name_search'] : '';
$number_places_available_search = isset($_GET['number_places_available_search']) ? $_GET['number_places_available_search'] : '';

$sql = "SELECT id, number_places_available, country_1, country_2, country_3, country_4 FROM travel WHERE 1=1";

if (!empty($name_search)) {
    $sql .= " AND (country_1 LIKE '%$name_search%' OR country_2 LIKE '%$name_search%' OR country_3 LIKE '%$name_search%' OR country_4 LIKE '%$name_search%')";
}

if (!empty($number_places_available_search)) {
    $sql .= " AND number_places_available = $number_places_available_search";
}

$result = $conn->query($sql);

echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '<title>Project PHP</title>';
echo '</head>';
echo '<body>';

echo '<h1>Filter</h1>';
echo '<form id="searchForm" method="get">';
echo '<label>Country: </label>';
echo '<input type="text" id="name_search" name="name_search" placeholder="Search country" value="' . htmlspecialchars($name_search) . '" />';
echo '<label>Number of Seats: </label>';
echo '<input type="number" id="number_places_available_search" name="number_places_available_search" placeholder="Search seats (only NUM)" value="' . htmlspecialchars($number_places_available_search) . '" />';
echo '<input type="submit" value="Search" />';
echo '</form>';

echo '<h1>Filtered Travel</h1>';
echo '<table border="1">';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Number of places available</th>';
echo '<th>Country 1</th>';
echo '<th>Country 2</th>';
echo '<th>Country 3</th>';
echo '<th>Country 4</th>';
echo '<th>Actions</th>';
echo '</tr>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['number_places_available']) . '</td>';
        echo '<td>' . htmlspecialchars($row['country_1']) . '</td>';
        echo '<td>' . htmlspecialchars($row['country_2']) . '</td>';
        echo '<td>' . htmlspecialchars($row['country_3']) . '</td>';
        echo '<td>' . htmlspecialchars($row['country_4']) . '</td>';
        echo '<td>';
        echo '<a href="./Travel/edit_travel.php?id=' . htmlspecialchars($row['id']) . '">Edit</a> ';
        echo '<a href="./Travel/delete_travel.php?id=' . htmlspecialchars($row['id']) . '" onclick="return confirm(\'Are you sure?\')">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr>';
    echo '<td colspan="7">No records found</td>';
    echo '</tr>';
}

echo '</table>';
echo '</body>';
echo '</html>';

$conn->close();
