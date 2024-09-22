<?php
include "./database/conn.php";

$sql = "SELECT id, number_places_available, country_1, country_2, country_3, country_4 FROM travel";
$result = $conn->query($sql);

echo '<h1>Manage Travel</h1>';
echo '<a href="/trips">Add New Travel</a>';
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
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['number_places_available'] . '</td>';
        echo '<td>' . htmlspecialchars($row['country_1']) . '</td>';
        echo '<td>' . htmlspecialchars($row['country_2']) . '</td>';
        echo '<td>' . htmlspecialchars($row['country_3']) . '</td>';
        echo '<td>' . htmlspecialchars($row['country_4']) . '</td>';
        echo '<td>';
        echo '<a href="./Travel/edit_travel.php?id=' . $row['id'] . '">Edit</a> ';
        echo '<a href="./Travel/delete_travel.php?id=' . $row['id'] . '" onclick="return confirm(\'Are you sure?\')">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr>';
    echo '<td colspan="7">No records found</td>';
    echo '</tr>';
}

echo '</table>';
$conn->close();
