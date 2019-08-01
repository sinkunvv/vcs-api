<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slides extends Model
{
    protected $table = 'slides';
    protected $primaryKey = 'id';

    public function urls()
    {
        return $this->hasMany('App\Models\Pages', 'slide_id');
    }
}
