<?php

namespace PHPFrw;

use Throwable;

class Auth
{
    public static function login(array $credential): bool
    {
        $password = $credential['password'];
        unset($credential['password']);
        $field = array_key_first($credential);
        $value = $credential[$field];

        $user = db()->findOne('users', $value, $field);

        if (!$user || $user['role'] == 0) {
            return false;
        }

        if (password_verify($password, $user['password'])) {
            if (function_exists('session_regenerate_id')){
                @session_regenerate_id(true);
            }
            session()->set('user', [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
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
        if (session() !== false){
            return session()->has('user');
        }
        return false;
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
        if ($user_data = self::user()) {
            $user = db()->findOne('users', $user_data['id']);
            if ($user) {
                session()->set('user', [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ]);
            }
        }
    }

    public static function isAdmin(): bool
    {
        $userRow = [
            'userName' => (string)$_SESSION['user']['name'],
            'userRole' => (int)$_SESSION['user']['role'],
        ];

        $adminExist = false;
        $userRole = 0;

        if (session()->has('user') ) {

            try {
                $user_name = $userRow['userName'];

                $user = db()->query('
                SELECT id, name, email, role 
                FROM users 
                where name = :name 
                and role = 1
                ', [':name' => $user_name]);

                if ($row = $user->getOne()){
                    $adminExist = true;
                    $userRow = array_merge($userRow, $row);
                    $userRole = (int)$userRow['role'];
                }
            } catch (Throwable $e) {
                catchInc($e->getMessage(), 'Admin index fetch error: ');
            }
        }

        if (!$adminExist || $userRole !== 1){
            $_SESSION = [];
            if (session_id() !== ''){
                session_destroy();
            }
            return false;
        }
        return true;
    }
}