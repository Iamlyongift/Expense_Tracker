<?php
include("db_conn/db_connect.php"); // File containing database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $date = $_POST['date'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $description = $_POST['description'] ?? '';

    // Basic validation
    if (empty($date) || empty($amount) || empty($category)) {
        die("All required fields must be filled.");
    }

    if ($amount <= 0) {
        die("Amount must be a positive value.");
    }

    $query = "INSERT INTO expense (date, amount, category, description) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("sdss", $date, $amount, $category, $description);

    if ($stmt->execute()) {
        echo "Expense added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
