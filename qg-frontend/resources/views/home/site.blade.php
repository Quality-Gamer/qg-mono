@extends('layout.app')

@section('content')
<div class="row bg"></div>
<div align="right">
    <div class="col-6 card-login mr-4 mr-lg-5">
        <div align="center" class="col mt-3">
            <h2><b><span class="text-gray">Quality</span><span class="text-green">Gamer</span></b></h2>
        </div>
        <div class="col mt-3">
            <form action="/login" method="POST">
                @csrf
                <div align="center" class="form-group">
                    <label for="input-email">Email</label>
                    <input type="email" class="form-control" id="input-email" name="email" aria-describedby="emailHelp">
                </div>
                <div align="center" class="form-group">
                    <label for="input-password">Password</label>
                    <input type="password" class="form-control" id="input-password" name="password">
                </div>
                @if(isset($message))
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                @endif
                <button type="submit" class="btn btn-login form-control"><b>Entrar</b></button>
                <div class="mt-1" align="center"><a href="/register">Cadastre-se</a></div>
                <div class="mt-1" align="center"><a href="/forgot">Recuperar senha</a></div>
            </form>
        </div>
    </div>
</div>
@endsection