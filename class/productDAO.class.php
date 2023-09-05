<?php

declare(strict_types=1);
require_once 'class/product.class.php';

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

    public function getProductBySKU(int $sku): ?Product
    {
        try {
            $req = $this->db->prepare("SELECT * FROM products WHERE sku = :sku");
            $params = [':sku' => strval($sku)];
            $req->execute($params);
            $result = $req->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return new Product(intval($result['sku']), $result['name'], $result['description'], floatval($result['price']), intval($result['stock']));
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
                if (intval($result['stock']) > 0) {
                    $product = new Product(intval($result['sku']), $result['name'], $result['description'], floatval($result['price']), intval($result['stock']));
                    $products[] = $product;
                }
            }

            return $products;
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            return [];
        }
    }

    public function updateProduct(Product $product)
    {
        try {
            $req = $this->db->prepare("UPDATE products SET name = :name, description = :description, price = :price, stock = :stock WHERE sku = :sku");
            $params = [
                ':name' => $product->getName(),
                ':description' => $product->getDescription(),
                ':price' => $product->getPrice(),
                ':stock' => $product->getStock(),
                ':sku' => $product->getSKU()
            ];
            $req->execute($params);

            if ($req->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Update failed: " . $e->getMessage();
            return false;
        }
    }
}
