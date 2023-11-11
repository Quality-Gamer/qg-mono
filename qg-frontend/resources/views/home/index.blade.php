@extends('layout.app')

@section('content')

<div class="col-lg-8 col-md-12 col-sm-12 col-12">
    <div id="messages">
        
    </div>
    <div align="center"><h1 class="title-page">Home</h1></div>
    <div class="jumbotron p-4 card-default col-lg-12 col-md-12 col-sm-12 bg-white">
        <div class="card bg-lg-green" style="width: 20rem;">
            <div class="card-body">
                <h4 class="card-title text-blue"><img src="../assets/img/icons/settings.png"> &nbsp;&nbsp; <strong>MPS Manager<storng></h4>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text text-blue">Vamos implementar o modelo MPS-BR?</p>
                <div align="center">
                    <button type="button" onclick="play('manager')" class="btn btn-info bg-navy-blue ">Jogar</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

<script>
    play = (game) => {
        window.location = "/"+game;
    }
</script>

@endsection
