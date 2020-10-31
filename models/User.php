<?php

class User
{
    // GET
    public static function getById($id)
    {
        $query = new Query('users');
        return $query->fields(['*'])->where('id', '=', $id)->get();
    }

    // POST
    public static function register(string $firstName, string $lastName, string $email, string $summary, string $password, string $passwordConfirmation, int $level)
    {
        $password = self::passwordCheck($password, $passwordConfirmation);

        if (!$firstName || !$lastName || !$email || !$password)
            return false;

        $create = new Create('users');

        return $create->values([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'summary' => $summary,
            'password' => $password,
            'level' => $level
        ])->insert();
    }

    // POST
    public static function login($email, $password)
    {
        $query = new Query('users');
        $user = $query->fields(['*'])->where('email', '=', $email, false, true)->get();

        return (!!$user && password_verify($password, $user['password'])) ? $user : null;
    }

    // PUT
    public static function updateProfile($session, $firstName, $lastName, $email, $summary)
    {
        if (!$firstName || !$lastName || !$email)
            return 0;

        $update = new Update('users');

        return $update->fields([
            'first_name',
            'last_name',
            'email',
            'summary'
        ])->where('id', '=', $session)->update([
            $firstName,
            $lastName,
            $email,
            $summary,
            $session
        ]);
    }

    public static function updatePassword($session, $password)
    {
        if (!$password)
            return 0;

        $update = new Update('users');

        return $update->fields(['password'])
            ->where('id', '=', $session)
            ->update([$password]);
    }

    public static function passwordCheck($p, $p2)
    {
        if ($p === $p2 && $p)
            return password_hash($p, PASSWORD_DEFAULT);
        else
            return 0;
    }
}