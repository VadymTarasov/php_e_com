<?php
require_once 'db_config.php';

class ProductInMySQLRepository {
    private $conn;

    public function __construct() {
        global $servername, $username, $password, $dbname;
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getAllProducts(): array
    {
        $sql = "SELECT id, name, description, price, image FROM products";
        $result = $this->conn->query($sql);

        $products = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }

    public function getProductById($id): bool|array|null
    {
        $sql = "SELECT id, name, description, price, image FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addProduct($name, $description, $price, $image): int|string
    {
        $sql = "INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssds", $name, $description, $price, $image);
        $stmt->execute();
        return $this->conn->insert_id;
    }

    public function updateProduct($id, $name, $description, $price, $image): void
    {
        $sql = "UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdsi", $name, $description, $price, $image, $id);
        $stmt->execute();
    }

    public function deleteProduct($id): void
    {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function closeConnection(): void
    {
        $this->conn->close();
    }

    public function __destruct() {
        $this->closeConnection();
    }
}

?>
