<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Test extends Model
{
    protected $table = 'test';

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

}