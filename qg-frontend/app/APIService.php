<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class APIService extends Model
{
    public static function getHttpRequest($url,$params = []){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url);
        return ["status_code" => $response->getStatusCode(),"body" => json_decode($response->getBody())];
    }

    public static function postHttpRequest($url,$params = [],$key = null){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, [
            'json' => $params,
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => $key ? $key : '',
            ]
        ]);
        return ["status_code" => $response->getStatusCode(),"body" => json_decode($response->getBody())];
    }

    public static function sendJson($body){
        $response = response()->json($body);
        $response->header('Content-Type', 'application/json');
        $response->header('charset', 'utf-8');

        return $response;
    }
}
