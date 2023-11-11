@extends('layout.app')

@section('content')
<div class="row bg"></div>
<div align="center">
    <div class="col-6 card mr-4 mr-lg-5">
        <form>
            @csrf
        <div align="center" class="col mt-3" id="top-header">
            <h2><b><span class="text-green">Novo Cadastro</span></b></h2>
            @if(isset($message))
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
            @endif
        </div>
        <div class="row">
        <div class="col mt-3">
                <div align="center" class="form-group">
                    <label for="input-name">Nome</label>
                    <input type="text" class="form-control" id="input-name" name="name">
                </div>
                <div align="center" class="form-group">
                    <label for="input-email">Email</label>
                    <input type="email" class="form-control" id="input-email" name="email" aria-describedby="emailHelp">
                </div>
                <div align="center" class="form-group">
                    <label for="input-password">Senha</label>
                    <input type="password" class="form-control" id="input-password" name="password">
                </div>
                <div align="center" class="form-group">
                    <label for="input-password-confirm">Confirmar Senha</label>
                    <input type="password" class="form-control" id="input-password-confirm" name="password-confirm">
                </div>
                <div align="center" class="form-group">
                    <label for="inputState">Universidade</label>
                    <select onchange="changeUniversity(this)" id="inputState" name="university" class="form-control">
                        <option value="" selected>Selecionar</option>
                        @foreach ($universities as $university)
                            <option value="{{$university->id}}" >{{$university->name}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" id="inputUniversity" name="university_input">
                </div>
        </div>
        <div class="col mt-3">
                <div align="center" class="form-group">
                    <label for="inputChar">Personagem</label>
                    <select onchange="changeChar(this)" name="char" id="inputChar" class="form-control">
                        <option value="0" selected>Selecionar</option>
                        <option value="1">Pump - Desenvolvedor Backend</option>
                        <option value="2">Lady - Desenvolvedora Frontend</option>
                        <option value="3">Nick - Desenvolvedor Fullstack</option>
                        <option value="4">Dino - Testador</option>
                    </select>
                    <input type="hidden" id="inputCharacter" name="char_input">
                </div>
                <div align="center" class="card-char form-group">
                    <div id="char-select-title">Sem personagem selecionado</div>
                    <div aling="center"><img class="char-register" id="char-selected-img" src="./assets/img/char/nochar.png"></div>
                    <div id="char-select-name"></div>
                </div>
        </div>
       
        <button type="button" onclick="createUser()" class="btn btn-login form-control mx-2"><b>Cadastrar</b></button>
        <button type="button" onclick="back()" class="btn btn-back form-control mt-2 mx-2"><b>Voltar</b></button>
        </div>
    </div>
    </form>

</div>
@endsection

@section('scripts')

<script>
 changeChar = (select) => {
     var arrayChar = ["nochar.png","pumpkin.png", "girl.png", "robot.png", "dino.png"];
     var arrayTitle = ["Sem personagem selecionado","Desenvolvedor Backend","Desenvolvedora Frontend","Desenvoldor Fullstack","Testador"];
     var arrayName = ["","Pump","Lady","Nick","Dino"];
     var urlBase = "./assets/img/char/";
     var chosen = select.value;

     $("#char-selected-img").attr("src",urlBase + arrayChar[chosen]);
     $("#char-select-title").text(arrayTitle[chosen]);
     $("#char-select-name").text(arrayName[chosen]);
     $("#inputCharacter").val(chosen);
 }

 changeUniversity = (select) => {
    $("#inputUniversity").val(select.value);
 }

 back = () => {
    window.location = '/';
 }

 createUser = () => {
    var email = $('#input-email').val();
    var name = $('#input-name').val();
    var password = $('#input-password').val();
    var passwordConfirm = $('#input-password-confirm').val();
    var char = $('#inputCharacter').val();
    var university = $('#inputUniversity').val();
    
    if(password != passwordConfirm) {
        addAlert("As senhas precisam ser iguais");
    }

    $.ajax({
        url: "/create/user",
        method: "POST",
        data: {email: email, name: name, password: password, char_input: char, university_input: university, "_token" : $('meta[name="csrf-token"]').attr('content')},
    }).done(function(res) {
        if (res.status != "OK" || res.response.body.response.status != "OK") {
            var msg = '';
            index = 0;
            Object.entries(res.response.body.response.message).forEach(([key, value]) => {
                breakline = '';
                if (index > 0) {
                    breakline = '</br>';
                }
                msg = msg + breakline + value[0];
                index++;
            });
            addAlert(msg); 
        } else {
            $.ajax({
            url: "/login",
            method: "POST",
            data: {email: email, password: password, "_token" : $('meta[name="csrf-token"]').attr('content')},
            }).done(function(res) {
                window.location.href = '/';
            });
        }
    });
 }

 addAlert = (message) => {
    var html = '<div class="alert alert-danger" role="alert">'+message+'</div>';
    $(".alert").remove();
    $('#top-header').append(html);
 }
</script>

@endsection