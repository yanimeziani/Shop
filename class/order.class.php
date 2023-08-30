<?php

class Order
{
    private $id;
    private $user_id;
    private $creation_date;

    public function __construct($id, $user_id)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->creation_date = date("Y-m-d H:i:s");
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getCreationDate()
    {
        return $this->creation_date;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
}
