@extends('layout.app')

@section('content')
<div class="col-lg-8 col-md-12 col-sm-12 col-12">
    <div id="messages">

    </div>
    <div align="center"><h1 class="title-page">Conquistas</h1></div>
    <div class="jumbotron p-4 card-default col-lg-12 col-md-12 col-sm-12 bg-lg-green">
    <div id="btn-close" class="btn-close pos-close"><a onclick="closeTab()">X</a></div>
    <div id="btn-give-up" class="btn-close pos-close"><a onclick="giveUp()">X</a></div>
    <div id='badges-div'>
        <div align="center" class="row">
                <div class="col-2">
                    <img class='badge-size' src='../assets/img/badges/php.png'/>
                </div>
                <div class="col-2">
                    <img class='badge-size' src='../assets/img/badges/python.png'/>
                </div>
                <div class="col-2">
                    <img class='badge-size' src='../assets/img/badges/go.png'/>
                </div>
            </div>
            <div style='position:absolute;bottom:0;right:0;margin-right:15px;' align="right">
                <button onclick='LoadTests()' class="btn btn-success btn-icon btn-round">
                    <i class="now-ui-icons ui-1_simple-add"></i>
                </button>
            </div>
    </div>
    <div class="d-none" id="tests-div">
            <div align="center"><h2 class="title-card">Descrição</h2></div>
                <div align="center">
                    @if ($allow)
                        @foreach ($allow as $a)
                            <div align="center" class="row my-1">
                                <div class="col-2"><img class="test-icon" src='../assets/img/badges{{$a->badge}}'></div>
                                <div class="col-3">{{$a->title}}</div>
                                <div class="col-2"><img class="test-icon" src='../assets/img/icons/coin_green.png'> {{$a->test_value}}</div>
                                <div class="col-2"><button onclick = 'joinTest("<?php echo $a->id?>","<?php echo $a->title?>")' style="cursor:pointer" class="badge badge-success">Fazer</button></div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div align="center">
                    @if ($deny)
                        @foreach ($deny as $d)
                            <div align="center" class="row my-1">
                                <div class="col-2"><img class="test-icon" src='../assets/img/badges{{$d->badge}}'></div>
                                <div class="col-3">{{$d->title}}</div>
                                <div class="col-2"><img class="test-icon" src='../assets/img/icons/coin_green.png'> {{$d->test_value}}</div>
                                <div class="col-2"><div class="badge badge-danger">Feito X</div></div>
                            </div>
                        @endforeach
                    @endif
                </div>
    </div>
    <div class="d-none" id="id-start">
        <div id="test-title"></div>
    </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(() => {
        $("#btn-close").hide();
        $("#btn-give-up").hide();
        $("#tests-div").removeClass("d-none");
        $("#tests-div").hide();
        $("#id-start").removeClass("d-none");
        $("#id-start").hide();
        matchId = '';
    });

    const LoadTests = () => {
        $("#btn-close").show();
        $("#tests-div").show();
        $("#badges-div").hide();
    }

    const closeTab = () => {
        $("#badges-div").show();
        $("#btn-close").hide();
        $("#tests-div").hide();
        $("#id-start").hide();
    };

    const joinTest = (test_id,title) => {
        $.ajax({
            method: "GET",
            url: "/api/http/request",
            crossDomain: true,
            headers: {
                    'Content-Type' : 'application/json',
                },
            data: { method: "POST", params : { ms: "tests", action: "create", params: {user_id: <?php echo Auth::user()->id ?>, test_id:test_id} } }
        }).done( r => {
            var html = "<div class='test-content' align='center'"+
            "<h3>Pronto para começar o teste?</h3><br/>"+
            "<strong><h4>"+title+"</h4></strong><br/>"+
            "<p>Você terá 45 segundos para responder cada questão</p><br/>"+
            "<p style='font-size:80%;color:#707070'>Caso a página seja fechada no meio do teste, você será reprovado no mesmo. E poderá refazê-lo após 90 dias<p><br/>"+
            "<button onclick='getQuestion(0)' class='btn btn-success'>Começar</button>"+
            "</div>";
            $(".test-content").remove();
             $("#btn-close").hide();
            $("#btn-give-up").show();
            $("#test-title").append(html);
            $("#id-start").show();
            $("#tests-div").hide();
            $("#badges-div").hide();
            matchId = r.response.match_id;
        });
    }

    const getQuestion = order => {
        var ret = false;
        $.ajax({
            method: "GET",
            url: "/api/http/request",
            crossDomain: true,
            headers: {
                    'Content-Type' : 'application/json',
                },
            data: { method: "POST", params : { ms: "tests", action: "questions", params: {user_id: "<?php echo Auth::user()->id ?>", match_id:matchId, order:order.toString()} } }
        }).done( r => {
            if(r.status == "NOK" && order > 0){
                $.ajax({
                method: "GET",
                url: "/api/http/request",
                crossDomain: true,
                headers: {
                        'Content-Type' : 'application/json',
                    },
                data: { method: "POST", params : { ms: "tests", action: "end", params: {user_id: "<?php echo Auth::user()->id ?>", match_id:matchId, win:"1"} } }
                }).done( r => {
                    var sc = r.response.score * 100;
                    var res = "<div align='center'><h4 style='color:#246598'>Que pena você não foi aprovado!<br/>Acerto:" + sc + "%</h4></div>";
                    if(r.response.win == 1){
                        res = "<div align='center'><h4 style='color:#246598'>Parabéns você foi aprovado!<br/>Acerto:" + sc + "%</h4></div>";
                    }
                    var html = "<div align='center' class='test-content'>"+
                    "<div style='color:#246598'>"+
                    res+
                    "</div>"+
                    "<button onclick='document.location.reload(true);' class='btn btn-success'>Voltar</button>"
                    "</div>";
                    $(".test-content").remove();
                    $("#btn-give-up").hide();
                    $("#test-title").append(html);
                    ret = true;
                });
            }

            if(ret){
                return;
            }

            var plusOne = r.order + 1;
            var html = "<div align='center' class='test-content'>"+
                        "<div style='color:#246598'><h3>Pergunta "+plusOne+":</h3></div>"+
                          "<div id=\"countdown\">"+
                            "<div id=\"countdown-number\"></div>"+
                            "<svg id='circle'>"+
                                "<circle r=\"18\" cx=\"20\" cy=\"20\"></circle>"+
                            "</svg>"+
                            "</div>"+
                            "<div>"+
                            "<div style='color:#246598'><h4>"+r.question+"</h4></div>"+
                            getRadioButtonHtml("A",r.option_a)+
                            getRadioButtonHtml("B",r.option_b)+
                            getRadioButtonHtml("C",r.option_c)+
                            getRadioButtonHtml("D",r.option_d)+
                            "<input id='user-option' readyonly='readyonly' type='hidden' value=''/><br/>"+
                            "<button onclick='sendAnswer("+order+")' class='btn btn-success'>Responder</button>"
                            "</div>"+
                       "</div>";
            $(".test-content").remove();
            $("#test-title").append(html);


            var countdownNumberEl = document.getElementById('countdown-number');
            var countdown = 45;
            countdownNumberEl.textContent = countdown;

            setInterval(function() {
            countdown = --countdown < 0 ? 45 : countdown;
            countdownNumberEl.textContent = countdown;
                if(countdown <= 10){
                    $("#countdown-number").css("color","red");
                    $("svg circle").css("stroke","red");
                }
                if(countdown == 0){
                    getQuestion(r.order + 1);
                    countdown = 0;
                }
            }, 1000);
        });
    };

    const sendAnswer = order => {
        var opt = $("#user-option").val();
        $.ajax({
            method: "GET",
            url: "/api/http/request",
            crossDomain: true,
            headers: {
                    'Content-Type' : 'application/json',
                },
            data: { method: "POST", params : { ms: "tests", action: "save", params: {user_id: "<?php echo Auth::user()->id ?>", match_id:matchId, order:order.toString(),option:opt} } }
        }).done( r => {
            getQuestion(order + 1);
        });
    };

    const giveUp = () => {
    var close = confirm("Tem certeza que deseja desistir do teste?");
    if(close){
        document.location.reload(true);
    }
    };

    const getRadioButtonHtml = (option,content) => {
    return '<div style=\'color:#246598;\' class="form-check form-check-radio">'+
                '<label class="form-check-label">'+
                    '<input onchange="setOption(\''+option.toUpperCase()+'\')" class="form-check-input" type="radio" name="optionsRadios" id="'+option+'Radios" value="'+option+'">'+
                    '<span class="form-check-sign"></span>'+
                    content+
                '</label>'+
                '</div>';
    }

    const setOption = option => {
        $("#user-option").val(option);
    }

</script>
@endsection
