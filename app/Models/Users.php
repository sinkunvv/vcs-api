<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    public function slides()
    {
        return $this->hasMany('App\Models\Slides', 'user_id');
    }
}
