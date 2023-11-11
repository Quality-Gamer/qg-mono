@extends('layout.app')

@section('content')

<div class="col-lg-8 col-md-12 col-sm-12 col-12">
    <div id="messages">
        
    </div>
    <div align="center"><h1 class="title-page">Seus dados</h1></div>
    <div class="jumbotron p-4 card-default col-lg-12 col-md-12 col-sm-12 bg-lg-green" id="readonly">
    <div class="row">
        <div class="col mt-3">
                <div align="center" class="form-group">
                    <label for="input-name" class="text-blue">Nome</label>
                    <input type="text" disabled class="form-control col-4" id="input-name" value="{{Auth()->user()->name}}" name="name">
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col mt-3">
                <div align="center" class="form-group">
                    <label for="input-email" class="text-blue">Email</label>
                    <input type="email" disabled class="form-control col-4" id="input-email" value="{{Auth()->user()->email}}" name="email">
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col mt-3">
                <div align="center" class="form-group">
                    <label for="input-university" class="text-blue">Universidade</label>
                    <input type="text" disabled class="form-control col-4" id="input-university" value="{{Auth()->user()->university}}" name="university">
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-3">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                    <input type="button" onclick="changeReadWriteMode(true)" class="form-control btn btn-blue text-white" value="Alterar senha" id="input-change-password">
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>
</div>

    <div class="jumbotron p-4 card-default col-lg-12 col-md-12 col-sm-12 bg-lg-green d-none" id="readwrite">
        <div id="btn-close" class="btn-close pos-close"><a onclick="changeReadWriteMode(false)">X</a></div>
        <div class="row">
            <div class="col mt-3">
                    <div align="center" class="form-group">
                        <label for="input-current-pass"class="text-blue">Senha atual</label>
                        <input type="password" class="form-control bg-white col-4" id="input-current-pass" name="current-pass">
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3">
                    <div align="center" class="form-group">
                        <label for="input-new-pass" class="text-blue">Nova senha</label>
                        <input type="password" class="form-control bg-white col-4" id="input-new-pass"  name="new-pass">
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3">
                    <div align="center" class="form-group">
                        <label for="input-confirm-new-pass" class="text-blue">Confirmar nova senha</label>
                        <input type="password" class="form-control bg-white col-4" id="input-confirm-new-pass">
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <input type="button" onclick="" class="form-control btn btn-blue text-white" value="Salvar senha" id="input-change-password">
                    </div>
                    <div class="col-4"></div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('scripts')
<script>
    changeReadWriteMode = (write) => {
        var show = "#readonly";
        var hide = "#readwrite";
        if(write) {
            hide = "#readonly";
            show = "#readwrite";
        }

        $(show).removeClass('d-none');
        $(hide).addClass('d-none');
    }
</script>
@endsection