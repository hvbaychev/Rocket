<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['first_name', 'middle_name', 'last_name', 'email', 'password', 'birth_date', 'role'];

    // Можете да добавите връзки към други модели тук, ако е необходимо
}
