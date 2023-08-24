<?php

declare(strict_types=1);
class User
{
    private $id;
    private $email;
    private $password;
    private $first_name;
    private $last_name;
    private $shipping_address;

    public function __construct(int $id, string $email, string $password, string $first_name, string $last_name, string $shipping_address)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->shipping_address = $shipping_address;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getShippingAddress()
    {
        return $this->shipping_address;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setFirstName(string $first_name)
    {
        $this->first_name = $first_name;
    }

    public function setLastName(string $last_name)
    {
        $this->last_name = $last_name;
    }

    public function setShippingAddress(string $shipping_address)
    {
        $this->shipping_address = $shipping_address;
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
