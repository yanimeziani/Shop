<?php
require_once 'db/db.php';
require_once 'class/order.class.php';
class OrderDAO
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createOrder($user_id)
    {
        $sql = "INSERT INTO orders (user_id, creation_date) VALUES (:user_id, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

    public function getOrderById($order_id)
    {
        $sql = "SELECT * FROM orders WHERE id = :order_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
