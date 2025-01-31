
<?php
session_start();
include("Database.php");
include('class/User.class.php');

$db = new Database();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User($conn);
    $result = $user->authenticate($_POST['username'], $_POST['password']);
    
     if ($result && $result->num_rows > 0) {
         $row = $result->fetch_assoc();
         $_SESSION['username'] = $_POST['username'];
         $_SESSION['id'] = $row['id'];
         $_SESSION['c_image'] = $row['c_image'];

         header("Location: dashboard.php");
     } else {
         echo "<div class='alert alert-danger'>Invalid credentials</div>";
     }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

    </div>
</body>
</html>


<style>
        body {
            background-color: #f0f2f5;
        }
        .login-container {
            max-width: 400px;
            margin: auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #5a5a5a;
        }
        .login-container .form-control {
            border-radius: 4px;
        }
        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
            border-radius: 4px;
        }
        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2e59d9;
        }
        .alert-danger {
            text-align: center;
            margin-top: 20px;
            border-radius: 4px;
        }
    </style>
