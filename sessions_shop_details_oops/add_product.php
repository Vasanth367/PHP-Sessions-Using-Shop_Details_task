
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include("Database.php");
include('class/Product.class.php');

$db = new Database();
$conn = $db->getConnection();
$product = new Product($conn, $_SESSION['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($product->addProduct($_POST['p_name'], $_POST['p_price'], $_POST['p_number'])) {
        header("Location: dashboard.php");
    } else {
        echo "<div class='alert alert-danger'>Error adding product.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <form method="POST">
        <h2>Add Product</h2>
        <div class="mb-3">
            <label for="p_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" name="p_name" required>
        </div>
        <div class="mb-3">
            <label for="p_price" class="form-label">Product Price</label>
            <input type="text" class="form-control" name="p_price" required>
        </div>
        <div class="mb-3">
            <label for="p_number" class="form-label">Product Number</label>
            <input type="text" class="form-control" name="p_number" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
    <a href="dashboard.php"><button type="submit" class="btn btn-secondary mt-3">Go Back</button></a>
</div>
</body>
</html>
