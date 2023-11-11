<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserTest extends Model
{
    protected $table = 'user_test';

    public function test()
    {
        return $this->belongsTo('App\Test');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}