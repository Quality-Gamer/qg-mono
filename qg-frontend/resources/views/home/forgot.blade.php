@extends('layout.app')

@section('content')
<div class="row bg"></div>
<div align="center">
    <div class="col-6 card mr-4 mr-lg-5">
        <form action="" method="POST">
            @csrf
        <div align="center" class="col mt-3">
            <h2><b><span class="text-green">Recuperar</span></b></h2>
            <div id="messages">
                
            </div>
        </div>
        <div class="row">
        <div class="col mt-3">
                <div align="center" class="form-group">
                    <label for="input-email">Email</label>
                    <input type="email" class="form-control" id="input-email" name="email">
                </div>
                
        </div>
        
        <button type="button" id="btn-send-forget" onclick="sendForget()" class="btn btn-login form-control mx-2"><b>Recuperar</b></button>
        <button type="button" onclick="back()" class="btn btn-back form-control mt-2 mx-2"><b>Voltar</b></button>
        </div>
    </div>
    </form>

</div>
@endsection

@section('scripts')

<script>
 back = () => {
    window.location = '/';
 }

 sendForget = () => {
         $.ajax({
            method: "GET",
            url: "/api/http/request",
            crossDomain: true,
            headers: {
                'Content-Type' : 'application/json',
            },
            data: { method: "POST", params : { ms: "main", action: "forget", method: "POST", params: {email: $('#input-email').val()}}},
            }).done( r => {
                // $("#messages-err").append(r.message);
                if(r.status != "OK") {
                    showToast(r.message,'danger');
                } else {
                    showToast(r.message,'success');
                    $("#btn-send-forget").attr("disabled",true);
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
</script>

@endsection