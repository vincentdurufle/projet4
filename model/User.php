<?php

/**
 * Sets a user entity to be loaded in Manager
 */

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

 /**
   * loop through all setters
   *
   * @param string 
   * @param int
   * @return void
   */

    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }

    /**
   * sets id
   *
   * @param int $id
   * @return void
   */
    public function setId($id)
    {
        $this->id = (int) $id;
    }
    /**
   * sets username
   *
   * @param string $username
   * @return void
   */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
   * transform string to hash
   *
   * @param string $password
   * @return void
   */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
   * sets email
   *
   * @param string $email
   * @return void
   */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
   * sets token with a int param setting the length
   *
   * @param int $token
   * @return void
   */
    public function setToken($token)
    {
        $this->token = bin2hex(random_bytes($token));
    }

    /**
   * sets active 1 or 0
   *
   * @param int $active
   * @return void
   */
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
