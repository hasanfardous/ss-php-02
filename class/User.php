<?php

class User
{
    private $email, $password;

    public function __construct($email, $password)
    {
        $this->email = strtolower($email);
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function register(): void
    {
        echo $this->email . ' has registered with password ' . $this->password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
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

    private function validate()
    {

    }

    private function userExists()
    {

    }
}

$user1 = new User('Smseleem@gmail.com', '123456');
$user1->register();
echo '<hr/>';

$user1->setPassword('654321');
echo $user1->getPassword();
echo '<hr/>';



