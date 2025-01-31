
<?php
class User {
    private $conn;
    private $username;
    private $password;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function authenticate($username, $password) {
        $this->username = mysqli_real_escape_string($this->conn, $username);
        $this->password = mysqli_real_escape_string($this->conn, $password);

        $query = "SELECT * FROM customer WHERE username = '$this->username' AND password = '$this->password'";
        $result = $this->conn->query($query);

        return $result;
    }
}
?>
