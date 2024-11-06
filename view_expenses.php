<?php
include("db_conn/db_connect.php");

$query = "SELECT * FROM expense ORDER BY date DESC";
$result = $connection->query($query);

echo "<table border='1'>
      <tr>
          <th>Date</th>
          <th>Amount</th>
          <th>Category</th>
          <th>Description</th>
      </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $row['date'] . "</td>
            <td>$" . number_format($row['amount'], 2) . "</td>
            <td>" . $row['category'] . "</td>
            <td>" . htmlspecialchars($row['description']) . "</td>
          </tr>";
}

echo "</table>";

$connection->close();
?>
