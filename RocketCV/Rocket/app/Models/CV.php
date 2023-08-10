<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CV extends Model


{

    protected $table = 'cvs';
    protected $fillable = ['first_name', 'middle_name', 'last_name', 'birth_date', 'user_id', 'technologies_id', 'universities_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function technology()
    {
        return $this->belongsTo(Technology::class, 'technologies_id');
    }

    public function university()
    {
        return $this->belongsTo(University::class, 'universities_id');
    }
}
