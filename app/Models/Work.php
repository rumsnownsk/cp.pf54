<?php

namespace App\Models;

use PHPFrw\Model;

class Work extends Model
{
    protected string $table = 'works';
    protected array $loaded = ['title', 'category_id', 'timeCreate', 'publish'];

    /* поля, которые будут записываться в БД */
    protected array $fillable = ['title', 'category_id', 'timeCreate', 'publish', 'photoName'];

    protected array $rules = [
        'required' => ['title', 'category_id', 'timeCreate', 'publish'],
    ];
    protected array $labels = [
        'title' => 'Название объекта $labels'
    ];
}