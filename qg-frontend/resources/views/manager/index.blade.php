@extends('layout.app')

@section('content')
<div class="col-lg-8 col-md-12 col-sm-12 col-12">
    <div id="messages">
        
    </div>
    <div align="center"><h1 class="title-page">MPS Manager</h1></div>
    <div class="jumbotron p-4 card-default col-lg-12 col-md-12 col-sm-12 bg-lg-green">
    <div id="btn-close" class="btn-close pos-close d-none"><a onclick="closeTab()">X</a></div>
    <div align="center" id="content-game" class="d-none">
            <div id="main">
            <div class="flex-a w-50 mb-3">
                @for ($i = 1; $i <= $week; $i++)
                    <span id="week-badge-<?php echo $i?>" class="badge badge-blue">{{$i}}</span>
                @endfor

                @for ($i = $week + 1; $i <= 8; $i++)
                    <span id="week-badge-<?php echo $i?>" class="badge badge-transparent">{{$i}}</span>
                @endfor
            </div>
            <div align="center" id="week-title"><h2 class="title-card clear-week">Ano {{$week}}</h2></div>
                <a onclick="changeToDescription()" class="badge btn-green badge-button mr-2 text-white">Regras</a>
                <a onclick="changeToManager()" class="badge btn-blue badge-button mr-2 text-white">Gerenciar</a>
                <a onclick="changeToProject()" class="badge btn-pink badge-button mr-2 text-white">Projeto</a>
            <div class="mt-4">
                <button onclick="nextWeek()" class="btn img-btn next-week-btn"><div>Avançar ano</div><img src="assets/img/icons/arrow.png" alt="Avançar ano"> </button>
            </div>
            <div class="mt-4">
                <button type="button" onclick="giveUp()" class="badge badge-danger">Desistir</a>
            </div>
        </div>
    </div>
        <!-- <div class="d-none" id="before-game">
            <div align="center"><h2 class="title-card">Bem-vindo {{Auth::user()->name}}</h2></div>
                <div align="center" class="end-game text-blue">
                    <button onclick="startGameManager()" class="btn img-btn next-week-btn"><div>Criar novo game</div><img class="play-btn my-3`" src="assets/img/icons/play-button.png" alt="Avançar ano" class=""> </button>
                </div>
        </div> -->
        <div class="d-none" id="end-game">
            <div align="center"><h2 class="title-card">Fim de Jogo</h2></div>
                <div align="center" class="end-game text-blue">
                    <strong> Pontos consquitados </strong><br/>
                    <span id="end-pts"></span> pts
                    <br/>
                    <button onclick="backToMain()" class="btn img-btn next-week-btn"><div>Voltar</div><img src="assets/img/icons/arrow.png" alt="Avançar ano" class="flip"> </button>
                </div>
        </div>
        <div class="d-none" id="description">
            <div align="center"><h2 class="title-card">Como Jogar?</h2></div>
                <div>
                    <div style="position: relative; width: 100%; height: 0; padding-top: 100.0000%;
                         padding-bottom: 48px; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16); margin-top: 1.6em; margin-bottom: 0.9em; overflow: hidden;
                         border-radius: 8px; will-change: transform;">
                          <iframe loading="lazy" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0;margin: 0;"
                            src="https:&#x2F;&#x2F;www.canva.com&#x2F;design&#x2F;DAFLZb6Cqdo&#x2F;view?embed" allowfullscreen="allowfullscreen" allow="fullscreen">
                          </iframe>
                    </div>
                    <a href="https:&#x2F;&#x2F;www.canva.com&#x2F;design&#x2F;DAFLZb6Cqdo&#x2F;view?utm_content=DAFLZb6Cqdo&amp;utm_campaign=designshare&amp;utm_medium=embeds&amp;utm_source=link" target="_blank" rel="noopener">up</a> de Iago
                </div>
        </div>
        <div class="d-none" id="manager">
            <div align="center"><h2 class="title-card">Gerenciar</h2></div>
            <div>
                <div class="row">
                    <div class="col-12 col-lg-6 col-sm-12 col-md-12 mt-sm-auto" style="max-height: 320px; height:auto;">
                        <div class="title-manager" style="display:flex;justify-content:center"><p class="manager-title" id="money-project"></p> <img class="icon-manager ml-3" src="assets/img/icons/money.png" alt="Dinheiro disponível"></div>
                        <div class="card card-manager">
                            <div class="card-body" style="overflow-y: scroll;height: 200px;">
                                <h4 class="card-title mt-0 mb-1">Recursos</h4>
                                <table class="table table-sm">
                                    <tbody>
                                        <div id="card-team" class="row">

                                        </div>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-sm-12 col-md-12" style="max-height: 320px; height:auto">
                        <div class="title-manager" style="display:flex;justify-content:center"><p class="manager-title" id="clock-project"></p> <img class="icon-manager ml-3" src="assets/img/icons/clock.png" alt="Tempo disponível"></div>
                        <div class="card card-manager">
                            <div class="card-body" style="overflow-y: scroll;height: 200px;">
                                <h4 class="card-title mt-0 mb-1">Atividades</h4>
                                <table class="table table-sm">
                                    <tbody id="card-actions">
                                    <div id="card-actions" class="row">

                                    </div>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-none" id="project">
            <div align="center"><h2 class="title-card">Projeto</h2></div>
            <div class="row">
                <div class="col-lg-4 col-4">
                    <h5>Equipe</h5>
                    <div id="list-team">

                    </div>
                </div>
                <div class="col-lg-4 col-4">
                    <h5>Outros</h5>
                    <div id="list-others">

                    </div>
                </div>
                <div class="col-lg-4 col-4">
                    <h5>Level</h5>
                    <div id="level-div"></div>
                    <!-- <div>
                            <div align="center" class="progress-container col-12">
                                <span class="progress-badge" id="status-project"></span>
                                <div class="progress mt-1 pb">
                                    <div class="progress-bar progress-bar-striped" id="status-pg-bar" role="progressbar" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100" style="width: 37%;">
                                    </div>
                                </div>
                                <span class="progress-badge mt-1" id="status-percentage" ></span>
                            </div>
                        </div> -->
                </div>
            </div>
            <h5>Ocorrências</h5>
            <div class="row">
                <div id="div-occurrences" class="jumbotron card-oc col-12 p-0">
                            
                </div>
            </div>
        </div>
    <div align="center" id="new-game" class="mt-5 d-none">
        <div><h3 class="mr-2 text-blue" style="text-transform: uppercase"><strong>Criando novo game</strong></h3></div>
            <div class="col-10 mt-5">
                <img id="loading" src="assets/img/icons/circle.png">
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(() => {
        $("#btn-close").hide();
        $("#description").hide();
        $("#manager").hide();
        $("#project").hide();
        $("#end-game").hide();
        $("#new-game").hide();
        $("#content-game").show();
        $("#main").show();
        $("#description").removeClass("d-none");
        $("#btn-close").removeClass("d-none");
        $("#manager").removeClass("d-none");
        $("#project").removeClass("d-none");
        $("#end-game").removeClass("d-none");
        $("#new-game").removeClass("d-none");
        $("#before-game").removeClass("d-none");
        $("#content-game").removeClass("d-none");
        $("#before-game").hide();
        
        updateAmount();
        
        load = 0;
        time = 0;
        round = 0;

        <?php if($new) {?>
           $("#content-game").hide();
           $("#new-game").show();
           interval = window.setInterval(loading, 300);
        <?php } ?>
        
        <?php if(isset($message)) {?>
            alert("<?php echo $message?>");
        <?php } ?>

        arrayName = new Map();
        arrayName.set("bk",["Backend",1]);
        arrayName.set("cc",["Contato Cliente",0]);
        arrayName.set("dg",["Designer",1]);
        arrayName.set("dv",["Entrega Semanal",0]);
        arrayName.set("ft",["Frontend",1]);
        arrayName.set("ld",["L. Software UI",1]);
        arrayName.set("li",["Licença IDE",1]);
        arrayName.set("po",["Product Owner",1]);
        arrayName.set("ra",["A. Requisitos",1]);
        arrayName.set("rk",["A. Risco Semanal",0]);
        arrayName.set("sc",["Scrum Semanal",0]);
        arrayName.set("tt",["Testador",1]);
    });

    const backToMain = () => {
        window.location.href = '/manager/reset';
    }

    const changeToDescription = () => {
        $("#main").hide();
        $("#manager").hide();
        $("#project").hide();
        $("#end-game").hide();
        $("#before-game").hide();
        $("#description").show();
        $("#btn-close").show();
    };

    const changeToEnd = () => {
        $("#main").hide();
        $("#manager").hide();
        $("#project").hide();
        $("#description").hide();
        $("#btn-close").hide();
        $("#before-game").hide();
        $("#end-game").show();
    };

    const changeToBefore = () => {
        $("#main").hide();
        $("#manager").hide();
        $("#project").hide();
        $("#description").hide();
        $("#btn-close").hide();
        $("#before-game").show();
        $("#end-game").hide();
    };

    const startGame = () => {
        $("#new-game").show();
    }

    const changeToManager = () => {
        if(!load){
            
            $.ajax({
                method: "GET",
                url: "/api/http/request",
                crossDomain: true,
                headers: {
                    'Content-Type' : 'application/json',
                },
                data: { method: "POST", params : { ms: "manager", action: "get/store", params: {user_id: <?php echo Auth::user()->id ?>, match_id: '<?php echo $manager_id?>'}}},
            }).done( r => {
                var i = r.response[0];
                i.forEach((item) => {
                    appendItem(item);
                });
               $(".card-manager").css("width", "auto");
                load = 1;
            }).fail( (err) => {
                console.log(err);
                console.log(err.headers);
            });
        }

        $("#main").hide();
        $("#manager").show();
        $("#project").hide();
        $("#description").hide();
        $("#end-game").hide();
        $("#before-game").hide();
        $("#btn-close").show();
    };

    const changeToProject = () => {
        $.ajax({
            method: "GET",
            url: "/api/http/request",
            crossDomain: true,
            headers: {
                    'Content-Type' : 'application/json',
                },
            data: { method: "POST", params : { ms: "manager", action: "get/match", params: {user_id: <?php echo Auth::user()->id ?>, match_id: '<?php echo $manager_id?>', week: '1'} } }
        }).done( r => {
            var res = r.response[0];
            var products = res.resources.products;
            var team = res.resources.team.members;
            $('.clear-loaded').remove();
            
            if(team != null && team != undefined  && team != 'null' && team != 'undefined' && team != '') {
                team.forEach((i) => {
                    appendProjectItem(i,true);
                })
            }

            if(products != null && products != undefined  && products != 'null' && products != 'undefined' && products != '') {
                products.forEach((i) => {
                    appendProjectItem(i,false);
                })
            }

            $('.clear-div-occurrences').remove();
            if(res.manager_occurrence != null){
                res.manager_occurrence.forEach( r => {
                    appendProjectOccurrence(r.occurrence.description);
                });
            }

            if(res.user_occurrence != null){
                res.user_occurrence.forEach( r => {
                    appendProjectOccurrence(r.occurrence.description,1);
                });
            }

            getLevelImage(res.level);
            
        }).fail( (err) => {
            console.log(err);
        });

        $("#main").hide();
        $("#manager").hide();
        $("#end-game").hide();
        $("#project").show();
        $("#before-game").hide();
        $("#description").hide();
        $("#btn-close").show();
    };
    
    const getLevelImage = (level) => {
        
        var html = `
            <img class='clear-img-level level-img' src="assets/img/level/`+getImage(level)+`">
        `;
        $(".clear-img-level").remove();
        $("#level-div").append(html);
    }

    const getImage = (level) => {
        var array = [];
        array.push('_none.png');
        array.push('_g.png');
        array.push('_f.png');
        array.push('_e.png');
        array.push('_d.png');
        array.push('_c.png');
        array.push('_b.png');
        array.push('_a.png');
        return array[level];
    }

    const closeTab = () => {
        $("#main").show();
        $("#btn-close").hide();
        $("#description").hide();
        $("#manager").hide();
        $("#end-game").hide();
        $("#project").hide();
    };

    const appendItem = (item) => {
        var img = "clock.png";
        var cs = "minimize-icon-clock";
        var id = "#card-actions";
        var type = "A";

        if(item.type == "T" || item.type == "P"){
            img = "money.png";
            cs = "minimize-icon";
            id = "#card-team";

        }

        var html = "<tr class='col-12' px-1'>"+
                    "<div class='row'>"+
                    "<div style=\"display:flex;justify-content:space-between\">"+
                    "<div><td class='px-2'>"+item.name+"</td>"+
                    "<td class='px-1'>"+item.price+"<img class=" + "'" + cs + " img-fluid'" + "src=" + "assets/img/icons/"+ img + ">"+"</td></div>"+
                    "<div><td class='px-0'>"+"<img onclick=\"buyItem('"+ item.id + "','" + item.price + "','" + item.type +"')\" class=\"img-fluid minimize-icon-done\" src=\"assets/img/icons/done.png\">"+"</td></div>"+
                    +"</div></tr>"

        $(id).append(html);
    }

    const loading = () => {
        if(time > 0){
            var t = time - 1;
            $("#loading").removeClass("loading-"+t);
        }
        
        $("#loading").addClass("loading-"+time);
        time += 1;
        
        if(time >= 12){
            var t = time - 1;
            $("#loading").removeClass("loading-"+t);
            time = 0;
            round +=1;
            if(round > 1){
                clearInterval(interval);
                initGame();
            }
        }
    }

    const initGame = () => {
        $("#content-game").show();
        $("#main").show();
        $("#new-game").hide();
    }

    const startGameManager = () => {
        $("#content-game").hide();
        $("#before-game").hide();
        $("#new-game").show();
        interval = window.setInterval(loading, 300);
    }

    const unset = () => {
        $.ajax({
            method: "GET",
            url: "/manager/reset",
            crossDomain: true,
            headers: {
                    'Content-Type' : 'application/json',
                },
        })
    }

    const appendProjectItem = (item,team = false) => {
        var id = "#list-others";

        if(team){
            id = "#list-team";
        }
        
        var html = "<p class=\"list-item my-0 ml-4 font-bold text-project clear-loaded\">" + item.quantity + "&nbsp;&nbsp;" + item.name + "</p>";

        $(id).append(html);
    }

    const appendProjectOccurrence = (value,user = 0) => {
        var img = "alert.png";
        var id = '#div-occurrences';

        if(user == 1){
            id = "user_alert.png";
        }
        
        var html = "<div class=\"row my-1 ml-2 clear-div-occurrences\">" +
                    "<img class=\"minimize-icon-clock\" src=\"assets/img/icons/"+img+"\">"+
                    "<p class=\"list-item my-0 font-bold\">"+ value +"</p>"+
                    "</div>";

        $(id).append(html);
    }

    const updateStatus = (status,perc) => {
        var st = "Normal";
        var color = "navy-blue";
       
        $(".clear-status").remove();

        if(status == "L"){
            st = "Atrasado";
            color = "red";
        }

        if(status == "A"){
            st = "Adiantado";
            color = "green";
        }

        var p = "<div class=\"clear-status text-"+ color +"\">" + perc + "%</div>";
        var s = "<div class=\"clear-status  text-"+ color +"\">" + st + "</div>";
        
        var cs = "bg-"+color;

        $("#status-project").append(s);
        $("#status-percentage").append(p);

        $("#status-pg-bar").removeClass("bg-blue");
        $("#status-pg-bar").removeClass("bg-red");
        $("#status-pg-bar").removeClass("bg-green");
        $("#status-pg-bar").addClass(cs);
        $('#status-pg-bar').attr('aria-valuenow', perc).css('width', perc);
    }

    const getType = (tp) => {
        if (tp == "T" || tp == "P") {
            return "R";
        }

        return "A";
    }

    const buyItem = (key,price,type) => {
        $.ajax({
            method: "GET",
            url: "/api/http/request",
            crossDomain: true,
            headers: {
                    'Content-Type' : 'application/json',
                },
            data: { method: "POST", params : { ms: "manager", action: "create/transaction", params: {user_id: <?php echo Auth::user()->id ?>, match_id: '<?php echo $manager_id?>', item: key, type: getType(type)}}}
        }).done( r => {
           var res = r.response[0];
           if(res.done == 1){
               updateAmount();
           } else {
               if(res.errCode == 1){
                   addAlert("Saldo insuficiente",1);
               } else {
                    addAlert("Desculpe, essa operação não é válida",1);
               }
           }
        }).fail( (err) => {
            console.log(err);
        });
    }

    const updateAmount = () => {
        $.ajax({
            method: "GET",
            url: "/api/http/request",
            crossDomain: true,
            headers: {
                    'Content-Type' : 'application/json',
                },
            data: { method: "POST", params : { ms: "manager", action: "get/match", params: {user_id: <?php echo Auth::user()->id ?>, match_id: '<?php echo $manager_id?>' }}}
        }).done( r => {
            var idm = "#money-project";
            var idc = "#clock-project";
            var res = r.response[0];
            var money = res.money;
            var time = res.time;
            var html_money = "<div class=\"clear-amount\">"+money+"</div>";
            var html_clock = "<div class=\"clear-amount\">"+time+"</div>";

            $(".clear-amount").remove();
            $(idm).append(html_money);
            $(idc).append(html_clock);
        }).fail( (err) => {
            console.log(err);
        });
    }

    addAlert = (message,error = 0) => {
        var icon = "ui-2_like";
        var cs = "alert-success";

        if(error){
            icon = "";
            cs = "alert-danger";
        }
        
        var html =  "<div class=\"alert " +cs+ "\" role=\"alert\">"+
                    "<div class=\"container\" id=\"messages\">"+
                    "<div class=\"alert-icon\">"+
                    "<i class=\"now-ui-icons " + icon + "\"></i>"+
                    "</div>"+
                    message +
                    "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">"+
                    "<span aria-hidden=\"true\">"+
                    "<i class=\"now-ui-icons ui-1_simple-remove\"></i>"+
                    "</span>"+
                   "</button> </div>";
        $("#messages").append(html);
    }

    const nextWeek = () => {
        var c = confirm('Tem certeza que deseja avançar para o próximo ano?'); 
        
        if(!c){
            return;
        }

        $.ajax({
            method: "GET",
            url: "/api/http/request",
            crossDomain: true,
            headers: {
                    'Content-Type' : 'application/json',
                },
            data: { method: "POST", params : { ms: "manager", action: "run/game", params:{user_id: <?php echo Auth::user()->id ?>, match_id: '<?php echo $manager_id?>'}}}
        }).done( r => {
            var res = r.response.match;
            var match = res[0];
            var end = r.response.end;
            if(end == 0){
                updateWeekInView(match.week,match.money,match.time);
            } else {
                endGame(match.level);
            }
        }).fail( (err) => {
            console.log(err);
        });
    }

    const endGame = (level) => {
        var score = level * 2;
        updateScoreUser(score);
        updateScoreRanking(score);
        $("#end-pts").text(score);
        changeToEnd();
    }

    const updateScoreUser = (score) => {
        $.ajax({
            method: "GET",
            url: "/api/http/request",
            crossDomain: true,
            headers: {
                    'Content-Type' : 'application/json',
                },
            data: { method: "POST", params : { ms: "main", action: "update/score", params: {user_id: <?php echo Auth::user()->id ?>, score: score} } }
        });
    }

    const updateScoreRanking = (score) => {
        $.ajax({
            method: "GET",
            url: "/api/http/request",
            crossDomain: true,
            headers: {
                    'Content-Type' : 'application/json',
                },
            data: { method: "POST", params : { ms: "ranking", action: "post/rank", params: {user_id: <?php echo Auth::user()->id ?>, score: score} } }
        });
    }

    const updateWeekInView = (week,value,time) => {
        var old = week - 1;
        var html = "<h2 class=\"title-card clear-week\">Ano " + week + "</h2>";
        var id = "#week-badge-" + week;
        $(".clear-week").remove();
        $(".clear-amount").remove();
        var h1 = "<div class=\"clear-amount\">" + value + "</div>";
        var h2 = "<div class=\"clear-amount\">" + time + "</div>";

        $("#money-project").append(h1);
        $("#clock-project").append(h2);
        $(id).removeClass("badge-transparent");
        $(id).addClass("badge-blue");
        $("#week-title").append(html);
    }  

    const giveUp = () => {
        var ok = confirm("Tem certeza que deseja desistir?");
        
        if(ok) {
            window.location.href = "/manager/reset";
        }
    }
    
</script>
@endsection
