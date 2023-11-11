<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Challenge extends Model
{
    protected $table = 'challenge';
    public static function loadAllChallangesByUser($uid) {
        return DB::table('challenge')
                ->join('user_challenge', 'challenge.id', '=', 'user_challenge.challenge_id')
                ->whereRaw('user_challenge.user_id = ? and challenge.active = 1', [$uid])
                ->get();

    }
}
