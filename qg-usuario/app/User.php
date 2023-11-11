<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\Test;
use App\APIService;
use stdClass;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    public function userTest() {
        return $this->hasMany('App\UserTest');
    }

    public function level() {
        return $this->belongsTo('App\Level');
    }

    public function university() {
        return $this->belongsTo('App\University');
    }

    public function rank() {
        return $this->hasOne('App\Rank');
    }

    public static function login($credentials) {
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $user->level;
            $user->university;
            $user->rank;
            return APIService::sendJson(["status" => "OK", "response" => $user,"message" => "success"]);
        }

        return APIService::sendJson(["status" => "NOK", "response" => NULL, "message" => "Email e/ou senha inválidos"]);
    }

    public function loadAllowTestsByUser(){
        $allowedTests = [];
        $deniedTests = [];
        $listObjTests = Test::all();

        foreach($this->userTest as $t){
            $today = date('Y-m-d');
            $diff = date_diff(date_create($t->created_at),date_create($today));
            if($diff->d < 180){
                if(!in_array($t->test,$deniedTests)){
                    $deniedTests[] = $t->test;
                }
            }
        }

        foreach($listObjTests as $t){
            if(!in_array($t,$deniedTests)){
                $allowedTests[] = $t;
            }
        }

        return APIService::sendJson(["status" => "OK", "response" => ["allow" => $allowedTests, "deny" => $deniedTests],"message" => "success"]);
    }

    public function loadDoneTestsByUser(){
        $doneTests = [];

        foreach($this->userTest as $t){
            $doneTests[] = [ "test" => $t->test, "user_test" => $t ];
        }

        return APIService::sendJson(["status" => "OK", "response" => ["done_tests" => $doneTests],"message" => "success"]);
    }

    public function messages() {
        return [
            'The name field is required.' => 'Nome requerido',
            'The email field is required.' => 'Email requerido',
            'The password field is required.' => 'Senha requerida',
            'The university field is required.' => 'Universidade requerida',
            'The char field is required.' => 'Personagem requerido',
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
