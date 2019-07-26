<?php

class User
{
    private $id;
    private $username;
    private $password;
    private $email;
    private $token;
    private $active;

    public function __construct($data = [])
    {
        $this->hydrate($data);
    }

    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }

    public function setId($id)
    {
        $this->id = (int) $id;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setToken($token)
    {
        $this->token = bin2hex(random_bytes($token));
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function id()
    {
        return $this->id;
    }

    public function username()
    {
        return $this->username;
    }
    public function password()
    {
        return $this->password;
    }

    public function email()
    {
        return $this->email;
    }
    public function token()
    {
        return $this->token;
    }
    public function active()
    {
        return $this->active;
    }
}
