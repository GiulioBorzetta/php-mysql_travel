<?php
include "./database/conn.php";

$sql = "SELECT name FROM country";
$result = $conn->query($sql);

echo '<h1>Country</h1>';
echo '<a href="/countries">Add New Country</a>';

echo '<table border="1">';
echo '    <tr>';
echo '        <th>Name</th>';
echo '        <th>Modify</th>';
echo '        <th>Delete</th>';
echo '    </tr>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
        echo "<td><a href='./Country/modify_country.php?name=" . urlencode($row["name"]) . "'>Modify</a></td>";
        echo "<td><a href='./Country/delete_country.php?name=" . urlencode($row["name"]) . "'>Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo '<tr><td colspan="3">No countries found</td></tr>';
}

echo '</table>';

$conn->close();
