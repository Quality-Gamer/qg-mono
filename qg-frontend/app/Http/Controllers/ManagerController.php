<?php

namespace App\Http\Controllers;

use App\APIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ManagerController extends Controller
{
    public function index(Request $request){
        $url = config('microsservices.gateway');
        $key = config('microsservices.key');
        if($request->session()->has('user')){
            $user = new \App\User;
            $user->id = $request->session()->get('user')['id'];
            $user->name = $request->session()->get('user')['name'];
            $user->email = $request->session()->get('user')['email'];
            $user->char = $request->session()->get('user')['char'];
            $user->level = $request->session()->get('user')['level'];
            $user->score = $request->session()->get('user')['score'];
            $user->university = $request->session()->get('user')['university'];
            $user->color = $request->session()->get('user')['color'];
            $user->rank = $request->session()->get('user')['rank'];
            $data = array();
            $data["manager_id"] = null;
            $data["new"] = 0;
            $data["week"] = 1;

            if(!$request->session()->get('manager_id')){
                $params = array(
                    "ms" => "manager",
                    "action" => "create/match",
                    "params" => array(
                    "user_id" => (string)$user->id,
                    "model_id" => (string)config('general.manager.default'),
                    ),
                    "method" => "GET",
                    "cacheable" => 0,
                );
                $response = APIService::postHttpRequest($url,$params,$key);

                $body = $response["body"]->response;

                if($body && $body->status == "OK"){
                    $r = $body->response[0];
                    $managerId = $r->id;
                    $data['description'] = $r->description;
                    $request->session()->put('manager_id', $managerId);
                    $data["new"] = 1;
                } else {
                    $data["message"] = "Erro ao conectar com o servidor.";
                }
            }


            if($request->session()->get('manager_id')){
                $data["manager_id"] = $request->session()->get('manager_id');

                $p = array(
                    "ms" => "manager",
                    "action" => "get/match",
                    "params" => array(
                    "user_id" => (string)$user->id,
                    "match_id" => (string)$data["manager_id"]
                    ),
                );

                $resp = APIService::postHttpRequest($url,$p,$key);
                $body = $resp["body"]->response;

                if($body && $body->status == "OK"){
                    $res = $body->response[0];
                    $week = $res->week;
                    $data["week"] = $week;
                    $data['description'] = $res->description;
                } else {
                    $data["message"] = "Erro ao conectar com o servidor.";
                }
            } else {
                $data["message"] = "Erro ao conectar com o servidor.";
            }

            $data["url"] = config('microsservices.gateway');
            $data['key'] = config('microsservices.key');
            Auth::login($user);

            return view("manager.index",$data);
        }
        return redirect("/");
    }

    // deprecated
    public function updateWeek(Request $request){
        $request->session()->put('week',$request->input('week'));
    }

    // Only dev env
    public function reset(Request $request){
        $request->session()->forget('manager_id');
        $request->session()->forget('week');

        return redirect("/");
    }

    public function makeHTTPRequest(Request $request){
        $method = $request->input('method');
        $params = $request->input('params');
        $key = config('microsservices.key');
        $url = config('microsservices.gateway');

        // For a while return is inside the if/else to save time
        if(isset($method) && $method = "POST"){
            $response = APIService::postHttpRequest($url,$params,$key);
            return APIService::sendJson($response["body"]->response);
        } else {
            $response = APIService::getHttpRequest($url,$params);
            return APIService::sendJson($response["body"]->response);
        }

    }

}
