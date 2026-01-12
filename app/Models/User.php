<?php

namespace App\Models;

use PHPFrw\Model;

class User extends Model
{
    protected string $table = 'users';
    protected array $loaded = ['name', 'email', 'password', 'confirmPassword'];

    protected array $fillable = ['name', 'email', 'password'];  // поля, которые нужны из Формы

    protected array $rules = [
        'required' => ['name', 'email', 'password', 'confirmPassword'],
        'email' => ['email'],
        'lengthMin' => [
            ['password', 6]
        ],
        'equals' => [
            ['password', 'confirmPassword']
        ],
        "unique" => [
            ['email','users,email'],
            ['name', 'users, name']
        ]
    ];
    protected array $labels = [
        'name' => 'Имя',
        'password' =>'Поле Паролька',
        'confirmPassword' =>'Подтверждение парольки'
    ];

}