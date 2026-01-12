<?php


namespace App\Models;


use PHPFrw\Model;

class Order extends Model
{
    protected string $table = 'orders';

    protected array $loaded = ['name', 'phone', 'address', 'message'];

    // поля, которые нужны из Формы
    protected array $fillable = ['name', 'phone', 'address', 'message'];  // поля, которые нужны из Формы

    protected array $rules = [
        'required' => ['name', 'phone', 'address', 'message']
    ];
}