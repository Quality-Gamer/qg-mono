<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\University;
use App\Email;
use App\EmailClient;
use App\Token;
use App\RankLog;
use App\APIService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use stdClass;

class UserController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only(['email','password']);
        return User::login($credentials);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'university' => 'required',
            'char' => 'required',
        ]);

        if ($validator->fails()) {
            $err = $validator->errors();
            // $array = array();

            // foreach ($err as $e) {
            //    $array[] = User::message()[$e]; 
            // }

            return APIService::sendJson(["status" => "NOK", "response" => [], "message" => $err]);
        }

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->university_id = $request->input('university');
        $user->char_id = $request->input('char');

        $exists = DB::select('select count(1) as _exists from user where email = ?', [$user->email]);

        if($exists[0]->_exists) {
            return APIService::sendJson(["status" => "NOK", "response" => [], "message" => "Email já registrado"]);
        }

        if(!$user->save()) {
            return APIService::sendJson(["status" => "NOK", "response" => [], "message" => "Falha na operação"]);
        }

        return APIService::sendJson(["status" => "OK", "response" => $user, "message" => "sucesso"]);
    }

    public function user(Request $request){
        $id = $request->input("user_id");
        return User::find($id);
    }

    public function changePassword(Request $request) {
        $token = $request->input("token");
        $new = $request->input("new_password");

        if($token) {
            return $this->changePasswordWithToken($token,$new);
        }

        $id = $request->input("user_id");
        $current = $request->input("current_password");
        $user = User::find($id);
        if(!$user) {
            return APIService::sendJson(["status" => "NOK", "response" => [], "message" => "Usuário inválido"]);
        }

        if($user->password != Hash::make($current)) {
            return APIService::sendJson(["status" => "NOK", "response" => [], "message" => "Senha atual incorreta"]);
        }

        $user->pasword = Hash::make($new);

        if(!$user->save()) {
            return APIService::sendJson(["status" => "NOK", "response" => [], "message" => "Falha na operação"]);
        }

        return APIService::sendJson(["status" => "OK", "response" => [], "message" => "Senha alterada com sucesso"]);

    }

    private function changePasswordWithToken($token,$newPass) {
        $model = Token::where('token', $token)->first();
        
        if (!$model) {
            return APIService::sendJson(["status" => "NOK", "response" => [], "message" => "Token inválido"]);
        }

        if (!$model->isValid()) {
            return APIService::sendJson(["status" => "NOK", "response" => [], "message" => "Link expirado"]);
        }

        if($model->used) {
            return APIService::sendJson(["status" => "NOK", "response" => [], "message" => "Link já utilizado"]);
        }
        
        $user = User::find($model->user_id);
        $user->password = Hash::make($newPass);

        if(!$user->save()) {
            return APIService::sendJson(["status" => "NOK", "response" => [], "message" => "Falha na operação"]);
        }

        $model->used = 1;
        $model->save();
        return APIService::sendJson(["status" => "OK", "response" => [], "message" => "Senha alterada com sucesso"]);
    }

    public function createToken(Request $request) {
        $email = $request->input("email");

        $user = User::where('email',$email)->first();

        if(!$user) {
            return APIService::sendJson(["status" => "NOK", "response" => [], "message" => "Email não cadastrado"]);
        }

        $token = new Token;
        $token->user_id = $user->id;
        $token->token = md5($user->id . time() . random_int(0,PHP_INT_MAX));
        $token->setExpires();
        
        if(!$token->save()) {
            return APIService::sendJson(["status" => "NOK", "response" => [], "message" => "Falha na operação"]);
        }

        $this->sendEmailForget($user,$token->token);
        return APIService::sendJson(["status" => "OK", "response" => [], "message" => "Requsição enviada com sucesso. Verifique seu email para alterar a senha"]);
    }

    public function tokenValid(Request $request) {
        $token = $request->input("token");
        $model = Token::where('token', $token)->first();

        if(!$model) {
            return APIService::sendJson(["status" => "NOK", "response" => [], "message" => "Token inválido"]);
        }

        if(!$model->isValid()) {
            return APIService::sendJson(["status" => "NOK", "response" => [], "message" => "Token expirado"]);
        }

        if($model->used) {
            return APIService::sendJson(["status" => "NOK", "response" => [], "message" => "Token já utilizado"]);
        }

        return APIService::sendJson(["status" => "OK", "response" => [], "message" => "Sucesso"]);

    }

    private function sendEmailForget($user,$token) {
        $client = new EmailClient;
        $url = env("FRONTEND_URL") ? env("FRONTEND_URL") : "https://qg-frontend.herokuapp.com/";
        $link = $url . "token/".$token;
        $subject = "Quality Gamer - Redefinição de Senha";
        $html = "<div><h1><b><span style='color:#91908f' class=\"text-gray fs-20\">Quality</span>"
        . "<span style='color:#488f3f' class=\"text-green fs-20\">Gamer</span></b></h1>"
        . "<h3>Alterar senha<h3><br/> Olá {$user->name}"
        ." para alterar sua senha clique no link abaixo: <br/> {$link}"
        ." <br/> Caso não tenha solicitado a alteração, favor ignorar este email.</div>";
        $text = "Alterar senha \r\n Olá {$user->name}"
        ." para alterar sua senha clique no link abaixo: \r\n "
        ."<a href='{$link}'>{$link}</a>"
        ." \r\n Caso não tenha solicitado a alteração, favor ignorar este email.</div>";
        
        $email = new Email;
        $email->subject = $subject;
        $email->user_id = $user->id;
        $email->content = $html;
        $email->save();
        
        $client->sendEmail($user->email,$subject,$html,$text);
    }

    public function loadUsers(Request $request){
        return User::all();

    }

    public function getUniversities(Request $request) {
        $u = DB::table('university')
        ->whereRaw('activated = ?', [1])
        ->orderByRaw('name ASC')
        ->get();
        return ["status" => "OK", "response" => $u, "message" => "success"];
    }

    public function getUsers(Request $request){
        $users = $request->input('users');
        $users = explode(",",$users);
        $response = [];
        foreach ($users as $value) {
            $u = User::find($value);
            $response[$u->id] = $u->name;
        }

        return ["status" => "OK", "response" => (array) $response, "message" => "success"];
    }

    public function updateScore(Request $request){
        $uid = $request->input("user_id");
        $score = $request->input("score");

        $user = User::find($uid);

        if(!$user) {
            return APIService::sendJson(["status" => "NOK", "response" => [], "message" => "Usuário não existe"]);
        }

        $user->score = $user->score + $score;
        
        if(!$user->save()) {
            $log = new RankLog;
            $log->user_id = $user->id;
            $log->log = json_encode(["user" => $user, "score" => $score]);
            $log->save();
            return APIService::sendJson(["status" => "NOK", "response" => [], "message" => "Falha na operação"]);
        }

        return APIService::sendJson(["status" => "OK", "response" => [], "message" => "Sucesso"]);
    }

}
