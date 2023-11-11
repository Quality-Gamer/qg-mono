<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Challenge;
use App\UserChallenge;
use App\UserChallengeScore;
use stdClass;

class ChallengeController extends Controller
{
    public function create(Request $request){
        $response = [];
        $user = User::find($request->input("user_id"));
        $response['status'] = "NOK";
        $response['response'] = null;
        $response['message'] = "Falha na operação";

        if($user && !empty($request->input("challenge_name"))) {
            $model = new Challenge;
            $model->user_id = $user->id;
            $model->challenge_name = $request->input("challenge_name");
            $model->active = 1;
            if($model->save()) {
                $response['status'] = "OK";
                $response['response'] = $model;
                $response['message'] = "Sucesso";
            }
        }

        return $response;
    }

    public function load(Request $request){
        $id = $request->input("user_id");
        return ["status" => "OK", "response" => Challenge::loadAllChallangesByUser($id), "message" => "Sucesso"];
    }

    public function join(Request $request){
        $uid = $request->input("user_id");
        $cid = $request->input("challenge_id");
        $status = "NOK";
        $response = null;
        $message = "Falha na operação";

        if ($uid && $cid) {
            $model = new UserChallenge;
            $model->user_id = $uid;
            $model->challenge_id = $cid;
            if($model->save()){
                $status = "OK";
                $message = "Sucesso";
                $reponse = $model;
            }
        }

        return ["status" => $status, "response" => $response, "message" => $message];
    }

}
