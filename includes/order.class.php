<?php

class Cart
{
    private $id;
    private $user_id;
    private $creation_date;

    public function __construct($id, $user_id, $creation_date)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->creation_date = $creation_date;
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

    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }
}
