<?php include("include/Header.php"); ?>
<?php include("db_conn/db_connect.php"); ?>
<!DOCTYPE html>
<head>
    <title>Form</title>
</head>
<style>
  /* styles.css */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
}
section{
    margin: auto;
}

h1 {
    color: #333;
    text-align: center;
    margin-top: 20px;
}
h2{
    text-align: center;
}

form {
    width: 700px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input, select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

th {
    background-color: #f2f2f2;
    color: #333;
}

    
</style>
<body>
    <div>


<!-- Filter Form -->
<div>
    <h2>Filter Expense</h2>
<form method="GET" action="index.php">
    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date">

    <label for="end_date">End Date:</label>
    <input type="date" name="end_date">

    <label for="filter_category">Category:</label>
    <select name="filter_category">
        <option value="">All</option>
        <option value="Food">Food</option>
        <option value="Transport">Transport</option>
        <option value="Utilities">Utilities</option>
        <option value="Entertainment">Entertainment</option>
    </select>

    <button type="submit">Filter</button>
</form>
</div>

<!-- Display Filtered Results -->
<?php
// Define the base query
$query = "SELECT * FROM expense WHERE 1=1";

// Check for filter parameters and update the query
if (!empty($_GET['start_date'])) {
    $start_date = $_GET['start_date'];
    $query .= " AND date >= '$start_date'";
}

if (!empty($_GET['end_date'])) {
    $end_date = $_GET['end_date'];
    $query .= " AND date <= '$end_date'";
}

if (!empty($_GET['filter_category'])) {
    $category = $_GET['filter_category'];
    $query .= " AND category = '$category'";
}

// Execute the query
$result = mysqli_query($connection, $query);
?>

<h2>Filtered Expenses</h2>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Amount</th>
            <th>Category</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td><?php echo $row['Category']; ?></td>
                <td><?php echo $row['description']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
    </div>
   <section class="col-10 px-2">
   <h1 id="main-title">Add Expenses</h1>
   <form action="add_expense.php" method="POST">
 <div class="mb-3">
 <label for="date">Date:</label>
 <input type="date" name="date" required class="form-control form-control-lg" type="text" placeholder="date" aria-label=".form-control-lg example mb-3">
 </div>

<div class="mb-3">
<label for="amount">Amount:</label>
<input type="number" step="0.01" name="amount" required class="form-control form-control-lg" type="text" placeholder="Amount" aria-label=".form-control-lg example mb-3">
</div>

  <label for="category">Category:</label>
  <select name="category" required>
      <option value="Food">Food</option>
      <option value="Transport">Transport</option>
      <option value="Utilities">Utilities</option>
      <option value="Entertainment">Entertainment</option>
  </select>

<div class="mb-3">
<label for="description">Description (optional):</label>
<input type="text" name="description" class="form-control form-control-lg" type="text" placeholder="Description" aria-label=".form-control-lg example mb-3">
</div>

  <button class="btn btn-success" type="submit">Add Expense</button>
</form>
   </section>
   <?php include("include/Footer.php")?>
</body>
</html>