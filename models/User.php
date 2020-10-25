<?php

class User
{
    public string $err = "Invalid data: ";
    public string $firstName = "";
    public string $lastName = "";
    public string $email = "";
    public ?string $summary = null;
    public string $password = "";
    public int $level = 0;

    function set($firstName, $lastName, $email, $password, $passwordConfirmation, $level)
    {
        if (!$firstName || !$lastName || !$email || !$password || !$passwordConfirmation) {
            return $this->err .= "All fields must be filled!";
        } else if ($password !== $passwordConfirmation) {
            return $this->err .= "Password does not match!";
        }

        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->level = $level;
    }

    function register()
    {
        $userCreate = new Create('users', 'id, first_name, last_name, email, summary, password, level');
        return $userCreate->createRecord(array($this->firstName, $this->lastName, $this->email, $this->summary, $this->password, $this->level));
    }

    function login($email, $password)
    {
        $userQuery = new UserQuery('users');
        $userByEmail = $userQuery->queryOneByColumn($email, 'email');

        if ($userByEmail)
            $hashCheck = password_verify($password, $userByEmail['password']);
        else
            return null;

        if ($hashCheck)
            return $userByEmail;
        else
            return null;
    }

    function setById($id) {
        $userGet = new UserQuery('users');
        $user = $userGet->queryOne($id);
        if ($user) {
            $this->firstName  = $user['first_name'];
            $this->lastName  = $user['last_name'];
            $this->email  = $user['email'];
            $this->summary  = $user['summary'];
            $this->level  = $user['level'];
            return true;
        } else {
         return false;
        }
    }
}