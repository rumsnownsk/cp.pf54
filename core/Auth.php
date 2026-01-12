<?php


namespace PHPFrw;


class Auth
{
    public static function login(array $credential): bool
    {
        $password = $credential['password'];
        unset($credential['password']);
        $field = array_key_first($credential);
        $value = $credential[$field];

        $user = db()->findOne('users', $value, $field);

        if (!$user || $user['role'] == 0){
            return false;
        }

        if (password_verify($password, $user['password'])){
            session()->set('user', [
                'id'=>$user['id'],
                'name'=>$user['name'],
                'email'=>$user['email'],
                'role'=>$user['role']
            ]);
            return true;
        }
        return false;
    }

    public static function user()
    {
        return session()->get('user');
    }

    public static function isAuth(): bool
    {
        return session()->has('user');
    }

    public static function getRole(): int
    {
        return self::user()['role'];
    }

    public static function logout(): void
    {
        session()->remove('user');
    }

    public static function setUser(): void
    {
        if ($user_data = self::user()){
            $user=db()->findOne('users', $user_data['id']);
            if ($user){
                session()->set('user', [
                    'id'=>$user['id'],
                    'name'=>$user['name'],
                    'email'=>$user['email'],
                    'role'=>$user['role']
                ]);
            }
        }
    }
}