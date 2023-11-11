@extends('layout.app')

@section('content')
<div class="row bg"></div>
<div align="center">
    <div class="col-6 card mr-4 mr-lg-5">
        @if($success)
            <form action="" method="POST">
                @csrf
                <div align="center" class="col mt-3">
                    <h2><b><span class="text-green">Alterar Senha</span></b></h2>
                    <div id="messages">
                        
                    </div>
                </div>
                <div class="row">
                <div class="col mt-3">
                        <div align="center" class="form-group">
                            <label for="input-password">Nova senha</label>
                            <input type="password" class="form-control" id="input-password" name="pass">
                        </div>
                        <div align="center" class="form-group">
                            <label for="input-password2">Confirmar nova senha</label>
                            <input type="password" class="form-control" id="input-password2" name="pass2">
                        </div>
                </div>
                
                <button type="button" id="btn-send-forget" onclick="sendForget()" class="btn btn-login form-control mx-2"><b>Alterar</b></button>
                <button type="button" onclick="back()" class="btn btn-back form-control mt-2 mx-2"><b>Voltar</b></button>
                </div>
            </form>
        @else
            <div class="mt-3">
                <div class="alert alert-danger" role="alert">{{$message}}</div>
            </div>
        @endif
        </div>

</div>
@endsection

@section('scripts')

<script>
 back = () => {
    window.location = '/';
 }

 sendForget = () => {
        if($("#input-password").val().length < 6) {
            showToast("Senha precisa ter no mínimo 6 dígitos","warning");
            return;
        }

        if($("#input-password").val() != $("#input-password2").val()) {
            showToast("Senhas precisam ser iguais","warning");
            return;
        }

         $.ajax({
            method: "GET",
            url: "/api/http/request",
            crossDomain: true,
            headers: {
                'Content-Type' : 'application/json',
            },
            data: { method: "POST", params : { ms: "main", action: "change/password", method: "POST", params: {token: "<?php echo $token?>" , new_password: $("#input-password").val()}}},
            }).done( r => {
                // $("#messages-err").append(r.message);
                if(r.status != "OK") {
                    showToast(r.message,'danger');
                } else {
                    showToast(r.message,'success');
                    $("#btn-send-forget").attr("disabled",true);
                    showLoading();
                    window.setTimeout(() => {
                        back();
                    },1000);
                }
            }).fail( (err) => {
                console.log(err);
                console.log(err.headers);
            });
 }

 showToast = (message,header) => {
        var html = `
        <div class="clear-alert alert alert-` + header + `" role="alert">` + message + `</div>
        `;
        $(".clear-alert").remove();
        $("#messages").append(html);
    }

showLoading = () => {
    var html = `
    <div class="spinner-border text-info" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    `;
}
</script>

@endsection