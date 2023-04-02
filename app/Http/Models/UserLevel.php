<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;


class UserLevel extends Model
{
    protected $table = 'user_level';

    protected $fillable = [
        'name'
    ];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->hasMany(User::class, 'level', 'id');
    }
}
