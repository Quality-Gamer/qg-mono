<?php

namespace App\Http\Controllers;

use App\APIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RankingController extends Controller
{
    public function index(Request $request){
        $url = config('microsservices.gateway');
        $apiKey = config('microsservices.key');
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

            $page = $request->input('page');
            $params = array(
                "ms" => "ranking",
                "action" => "get/rank",
                "params" => array(
                    "page" => '1',
                ),
                "method" => "GET",
                "cacheable" => 0,
            );

            $response = APIService::postHttpRequest($url,$params,$apiKey);
            $body = $response["body"]->response;
            // $total = $body->total;
            $rank = $body->response->rank;


            $data = array(
                "rank" => $rank,
            );

            $ids = '';

            foreach ($rank as $key => $value) {
                if(!$rank[$key]->Rank) {
                    unset($rank[$key]);
                } else {
                    $ids .= $value->Name . ",";
                }
            }

            $ids = substr($ids,0,-1);
            $empty = !count($rank) ? true : false;
            $data['empty'] = $empty;

            $p = array(
                "ms" => "main",
                "action" => "get/users",
                "params" => array(
                    "users" => $ids,
                ),
                "method" => "GET",
                "cacheable" => 0,
            );

            $r = APIService::postHttpRequest($url,$p,$apiKey);
            $b = $r["body"]->response;
            $u = $b->response;
            $data['users'] = [];

            foreach($u as $k => $v) {
                $data['users'][$k] = $v;
            }

            Auth::login($user);
            return view("ranking.index",$data);
        }
        return redirect("/");
    }
}
