
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class=" header ">
    <div class="container d-flex justify-content-between">
    <div class="text-center">
    <h1>Welcome to Your Product Details Dashboard</h1>
    <p class="lead">Manage your products and orders</p>
    </div>
    <div>
            <img class="border" src="<?php echo $_SESSION['c_image']; ?>" alt="image" height="50px" width="50px">
    </div>
    </div>
</div>

<div class="container mb-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2><u>Welcome, <?php echo $_SESSION['username']; ?></u></h2>
            <!-- <h3>I am <cite> Vasant </cite></h3> -->
        </div>

        
    </div>

    <div class="row mb-4 text-center">
        <div class="col-md-6 mb-2">
            <a href="add_product.php" class="btn btn-success w-100"><b>Add Product</b></a>
        </div>
        <div class="col-md-6 mb-2">
            <a href="logout.php" class="btn btn-danger w-100"><b>Sign Out</b></a>
        </div>
    </div>

    <h3 class="mb-4"><u>Product List :</u></h3>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Batch Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $product->getProducts();
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['p_name']}</td>
                                <td>{$row['p_price']}</td>
                                <td>{$row['p_number']}</td>
                              </tr>";   
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- footer -->

<footer>
  <div class="footer-container">
    <div class="footer-section">
      <h4>About Us</h4>
      <p>We are a leading company in providing excellent products and services to our customers. Our mission is to create value and make a difference.</p>
    </div>
    <div class="footer-section">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Privacy Policy</a></li>
      </ul>
    </div>

    <div class="footer-section">
      <h4>Contact Us</h4>
      <p>Email: info@company.com</p>
      <p>Phone: (123) 456-7890</p>
      <p>Address: 123 Business Street, City, Country</p>
    </div>

    <div class="footer-section">
      <h4>Follow Us</h4>
      <ul class="social-media">
        <li><a href="#">Facebook</a></li>
        <li><a href="#">Twitter</a></li>
        <li><a href="#">LinkedIn</a></li>
        <li><a href="#">Instagram</a></li>
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; 2025 Company Name. All Rights Reserved.</p>
  </div>
</footer>

</body>
</html>






<!-- stylesheet*/ -->

<style>
        body {
            background-color: #f8f9fa;
        }
        .header {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn {
            border-radius: 50px;
        }
        .container {
            margin-top: 40px;
        }
        .border{
            border: radius 50px;
        }
                
        /* footer */
        footer {
        background-color: #333;
        color: white;
        padding: 40px 0;
        font-family: Arial, sans-serif;
        }

        .footer-container {
        display: flex;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
        }

        .footer-section {
        flex: 1;
        margin: 0 20px;
        }

        .footer-section h4 {
        font-size: 18px;
        margin-bottom: 10px;
        }

        .footer-section p, .footer-section ul {
        font-size: 14px;
        }

        .footer-section ul {
        list-style-type: none;
        padding: 0;
        }

        .footer-section ul li {
        margin-bottom: 8px;
        }

        .footer-section ul li a {
        color: white;
        text-decoration: none;
        }

        .footer-bottom {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
        }
        
    </style>