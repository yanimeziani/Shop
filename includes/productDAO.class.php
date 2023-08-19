<?php
require_once 'includes/product.class.php';
class ProductDAO
{
    private $db;

    public function __construct(PDO $conn)
    {
        $this->db = $conn;
    }

    public function insertProduct(Product $product)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO products (sku, name, description, price, stock) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$product->getSKU(), $product->getName(), $product->getDescription(), $product->getPrice(), $product->getStock()]);
            return true;
        } catch (PDOException $e) {
            echo "Insert failed: " . $e->getMessage();
            return false;
        }
    }

    public function getProductBySKU($sku)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM products WHERE sku = ?");
            $stmt->execute([$sku]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return new Product($result['sku'], $result['name'], $result['description'], $result['price'], $result['stock']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            return null;
        }
    }

    public function getAllProducts()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM products");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $products = [];
            foreach ($results as $result) {
                $product = new Product($result['sku'], $result['name'], $result['description'], $result['price'], $result['stock']);
                $products[] = $product;
            }

            return $products;
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            return [];
        }
    }
}
