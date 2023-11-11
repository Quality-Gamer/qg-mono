<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\APIService;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use Notifiable;
    private $levels = [
        0,
        0,
        45,
        100,
        180,
        300,
        470,
        700,
        1300,
        2000,
        3500
    ];

    private $levelsName = [
        "Rookie" => 1,
        "Beginner" => 2,
        "Junior" => 3,
        "Senior" => 4,
        "Semi Pro" => 5,
        "Pro" => 6,
        "National" => 7,
        "World Pro" => 8,
        "Master" => 9,
        "Top Master" => 10,
    ];

    public function setCharAttribute($value) {
        $this->attributes['char'] = $value;
    }

    public function setUnivesityAttribute($value) {
        $this->attributes['university'] = $value;
    }

    public function setColorAttribute($value) {
        $this->attributes['color'] = $value;
    }

    public function setLevelAttribute($value) {
        $this->attributes['level'] = $value;
    }

    public function setScoreAttribute($value) {
        $this->attributes['score'] = $value;
    }

    public function setRankAttribute($value) {
        $this->attributes['rank'] = $value;
    }

    public static function getAllUsers() {
        $url = "https://qg-usuario.herokuapp.com/api/load/users";
        $response = APIService::getHttpRequest($url);
        
        foreach ($response['body'] as $key => $value) {
            if(isset(auth()->user()->id) && !empty(auth()->user()->id) && $value->id == auth()->user()->id) {
                unset($response['body'][$key]);
            }
        }

        return $response['body'];
    }

    public function getLevel() {
        return isset($this->level) ? $this->level : "Rookie";
    }

    public function getScore() {
        return isset($this->score) ? $this->score : 0;
    }

    public function getCharJob() {
        $array = ["1" => "Desenvolvedor Backend", "2" => "Desenvolvedora Frontend", "3" => "Desenvolvedor Fullstack", "4" => "Testador"];
        return $array[strval($this->char)];
    }

    public function getCharImg() {
        $array = ["1" => "pumpkin.png", "2" => "girl.png" , "3" => "robot.png", "4" => "dino.png"];
        return $array[strval($this->char)];
    }

    public function getCharIcon() {
        $array = ["1" => "pumpkin.png", "2" => "girl.png" , "3" => "robot.png", "4" => "dino.png"];
        return $array[strval($this->char)];
    }

    private function getLevelScore() {
        $level = $this->levelsName[$this->level];
        $nextLevel = $level + 1;
        return $this->levels[$nextLevel];
    }

    private function getCurrentLevelScore() {
        $level = $this->levelsName[$this->level];
        return $this->levels[$level];
    }

    public function getBarValue() {
        $current = $this->score - $this->getCurrentLevelScore();
        $target = $this->getLevelScore() - $this->getCurrentLevelScore();
        if(!$target) {
            $target = 1;
        }
        return ($current/$target) * 100;
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
