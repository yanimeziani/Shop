<?php
include 'includes/user.class.php';

class UserDAO
{
    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function createUser(User $user)
    {
        $req = $this->db->prepare("INSERT INTO users (email, password, first_name, last_name, shipping_address) VALUES (:email, :password, :first_name, :last_name, :shipping_address)");

        $params = [
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
            ':first_name' => $user->getFirstName(),
            ':last_name' => $user->getLastName(),
            ':shipping_address' => $user->getShippingAddress()
        ];

        if ($req->execute($params)) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserByEmail($email)
    {
        $req = $this->db->prepare("SELECT * FROM users WHERE email = :email");

        $params = [':email' => $email];
        $req->execute($params);

        $result = $req->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new User($result['id'], $result['email'], $result['password'], $result['first_name'], $result['last_name'], $result['shipping_address']);
        } else {
            return null;
        }
    }

    public function updateUser(User $user)
    {
        $req = $this->db->prepare("UPDATE users SET email = :email, password = :password, first_name = :first_name, last_name = :last_name, shipping_address = :shipping_address WHERE id = :id");

        $params = [
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
            ':first_name' => $user->getFirstName(),
            ':last_name' => $user->getLastName(),
            ':shipping_address' => $user->getShippingAddress(),
            ':id' => $user->getId()
        ];

        if ($req->execute($params)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUser($email)
    {
        $req = $this->db->prepare("DELETE FROM users WHERE email = :email");

        $params = [':email' => $email];

        if ($req->execute($params)) {
            return true;
        } else {
            return false;
        }
    }

    public function userExists($email)
    {
        $req = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");

        $params = [':email' => $email];
        $req->execute($params);

        $count = $req->fetchColumn();

        return $count > 0;
    }
}
