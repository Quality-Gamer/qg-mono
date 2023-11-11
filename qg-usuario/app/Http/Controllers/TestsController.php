<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\APIService;
use App\Test;
use App\UserTest;

class TestsController extends Controller
{
    public function loadAllowTests(Request $request){
        $user_id = $request->input('user_id');
        
        if (!$user_id) {
            return APIService::sendJson(["status" => "NOK", "response" => NULL, "message" => "Usuário precisa ser passado"]);
        }

        $user = User::find($user_id);

        if (!$user) {
            return APIService::sendJson(["status" => "NOK", "response" => NULL, "message" => "Usuário não existe"]);
        }

        return $user->loadAllowTestsByUser();

    }

    public function loadDoneTests(Request $request){
        $user_id = $request->input('user_id');
        
        if (!$user_id) {
            return APIService::sendJson(["status" => "NOK", "response" => NULL, "message" => "Usuário precisa ser passado"]);
        }

        $user = User::find($user_id);

        if (!$user) {
            return APIService::sendJson(["status" => "NOK", "response" => NULL, "message" => "Usuário não existe"]);
        }

        return $user->loadDoneTestsByUser();

    }

    public function getQuestions(Request $request){
        $match_id = $request->input('match_id');

        $userTest = UserTest::where('match_id', $match_id)->first();
        
        if(!isset($userTest) || empty($userTest)){
            return APIService::sendJson(["status" => "NOK", "response" => NULL, "message" => "Esse teste não foi iniciado"]);
        }

        $test = $userTest->test;
        $questions = $test->questions;


        return APIService::sendJson(["status" => "OK", "response" => ["questions" => $questions],"message" => "success"]);

    }

    public function saveTests(Request $request){
        $user_id = $request->input('user_id');
        
        if (!$user_id) {
            return APIService::sendJson(["status" => "NOK", "response" => NULL, "message" => "Usuário precisa ser passado"]);
        }

        $user = User::find($user_id);

        if (!$user) {
            return APIService::sendJson(["status" => "NOK", "response" => NULL, "message" => "Usuário não existe"]);
        }

        $match_id = $request->input('match_id');
        $test_id = $request->input('test_id');
        $score = $request->input('score');
        $ut = UserTest::where('match_id', $match_id)->first();
        $win = 0;

        if($score >= 0.7){
            $win = 1;
        }
        
        if(!isset($ut) || empty($ut)){
            $win = null;
            $string = $user->id . time(); 
            $match_id = md5($string);
            $ut = new UserTest();
        } else {
            $test_id = $ut->test_id;
        }
        

        $count = UserTest::where("match_id",$match_id)->whereRaw("win is not null")->count();

        if($count > 0){
            return APIService::sendJson(["status" => "NOK", "response" => NULL, "message" => "Esse teste já foi feito"]);
        }

        $ut->user_id = $user->id;
        $ut->match_id = $match_id;
        $ut->test_id = $test_id;
        $ut->score = $score;
        $ut->win = $win;
        $ut->save();


        return APIService::sendJson(["status" => "OK", "response" => $ut, "message" => "success"]);
    }
}
