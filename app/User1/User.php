<?php

namespace App\User1;

use App\DB\DB;
use App\DB\MySQL;

class User
{
    private $email, $password, $db;

    public function __construct($email, $password, DB $db)
    {
        $this->email = strtolower($email);
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->db = $db;
    }

    public function register(): void
    {
        $this->db->create();
        echo $this->email . ' has registered with password ' . $this->password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        $this->db->read();
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = strtolower($email);
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }
}



