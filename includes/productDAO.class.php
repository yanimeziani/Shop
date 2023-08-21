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
            $req = $this->db->prepare("INSERT INTO products (sku, name, description, price, stock) VALUES (:sku, :name, :description, :price, :stock)");
            $params = [
                ':sku' => $product->getSKU(),
                ':name' => $product->getName(),
                ':description' => $product->getDescription(),
                ':price' => $product->getPrice(),
                ':stock' => $product->getStock()
            ];
            $req->execute($params);
            return true;
        } catch (PDOException $e) {
            echo "Insert failed: " . $e->getMessage();
            return false;
        }
    }

    public function getProductBySKU($sku)
    {
        try {
            $req = $this->db->prepare("SELECT * FROM products WHERE sku = :sku");
            $params = [':sku' => $sku];
            $req->execute($params);
            $result = $req->fetch(PDO::FETCH_ASSOC);
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
            $req = $this->db->query("SELECT * FROM products");
            $results = $req->fetchAll(PDO::FETCH_ASSOC);

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
