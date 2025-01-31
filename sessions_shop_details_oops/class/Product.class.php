
<?php
class Product {
    private $conn;
    private $c_id;

    public function __construct($dbConnection, $customer_id) {
        $this->conn = $dbConnection;
        $this->c_id = $customer_id;
    }

    public function getProducts() {
        $query = "SELECT * FROM product WHERE c_id = $this->c_id";
        return $this->conn->query($query);
    }

    public function addProduct($p_name, $p_price, $p_number) {
        $p_name = mysqli_real_escape_string($this->conn, $p_name);
        $p_price = mysqli_real_escape_string($this->conn, $p_price);
        $p_number = mysqli_real_escape_string($this->conn, $p_number);

        $query = "INSERT INTO product (p_name, p_price, p_number, c_id) 
                  VALUES ('$p_name', '$p_price', '$p_number', '$this->c_id')";
        
        return $this->conn->query($query);
    }
}
?>
