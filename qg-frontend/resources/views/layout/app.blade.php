<!--

=========================================================
* Now UI Kit - v1.3.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-kit
* Copyright 2019 Creative Tim (http://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/now-ui-kit/blob/master/LICENSE.md)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/icons/favicon.png">
  <link rel="icon" type="image/png" href="../assets/img/icons/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/countdown.css" rel="stylesheet" />

  <link href="../assets/css/now-ui-kit.css?v=1.3.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/css/style.css" rel="stylesheet" />
  <link href="../assets/css/chat.css" rel="stylesheet" />

   <!--   Core JS Files   -->
   <script src="../assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="../assets/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="../assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
  <script src="../assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVKjHMzN-gncXoFcOhL45VxYq7-XG1HsA"></script> -->
  <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-kit.js?v=1.3.0" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
  <!-- SendBird Chat -->
  <!-- <script src="../assets/sendbird/SendBird.min.js"></script> -->
 <!-- Scripts -->
 <script src="{{ asset('js/app.js') }}" defer></script>

 <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-JQ93Q9R967"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-JQ93Q9R967');
</script>

<!-- Hotjar Tracking Code for https://qg-frontend.herokuapp.com/ -->
    <script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:2237373,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>


 <!-- Fonts -->
 <link rel="dns-prefetch" href="//fonts.gstatic.com">
 <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

</head>

<body class="login-page sidebar-collapse">
    <div id="app">
            @auth
                <div>
                <nav class="navbar navbar-expand-lg bg-blue">
                    <div class="container">
                    <a class="navbar-brand" href="/"><b><span class="text-gray fs-20">Quality</span><span class="text-green fs-20">Gamer</span></b></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar" data-nav-image="assets/img/blurred-image-1.jpg">
                        <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">
                            <p>Home</p>
                            </a>
                        </li>
                        @if (config('features.store'))
                        <li class="nav-item">
                            <a class="nav-link" href="/store">
                            <p>Loja</p>
                            </a>
                        </li>
                        @endif
                        @if (config('features.tests'))
                        <li class="nav-item">
                            <a class="nav-link" href="/tests">
                            <p>Conquistas</p>
                            </a>
                        </li>
                        @endif
                        @if (config('features.ranking'))
                        <li class="nav-item">
                            <a class="nav-link" href="/ranking">
                            <p>Ranking</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="/profile">
                            <p><img class="navbar-img" src="./assets/img/avatar/{{auth()->user()->getCharIcon()}}"></p>
                            </a>
                        </li>
                        @if (config('features.coin'))
                        <li class="nav-item">
                            <a class="nav-link">
                            <p><span class="mr-1 fs-12">2000</span><img class="navbar-img" src="./assets/img/icons/coin_green.png"></p>
                            </a>
                        </li>
                        @endif
                        @if (config('features.social'))
                        <li class="nav-item mr-3">
                            <a class="nav-link" href="/profile">
                            <p><img class="navbar-img" src="./assets/img/icons/network.png"></p>
                            </a>
                        </li>
                        @endif
                        <form class="form-inline ml-auto" action="logout" method="post" data-background-color>
                            @csrf
                            <div class="form-group has-white">
                                <input type="submit" class="form-control bold" value="Sair">
                            </div>
                        </form>

                        </ul>
                    </div>
                    </div>
                </nav>
                </div>
            @endauth

        <main>
            <h2 align="center" style="text-transform: uppercase" class="text-orange">@yield('title')</h2>
            <div align="center" style="font-size:16px;"  id="page-alert"></div>
            @auth
            <div class="container">
            <div class="row" style="margin-top:80px">
            <div class="col-lg-3 col-md-12 col-sm-12 col-12 mb-5">
                <div>
                    <div class="card-user">
                        <div align="center" style="color:{{auth()->user()->color}}" class="mt-2 bold">{{auth()->user()->getLevel()}}</div>
                        <div align="center" class="mt-2 bold">{{auth()->user()->getCharJob()}}</div>
                        <div align="center" class="mt-2 bold">{{auth()->user()->name}}</div>
                        <div class="flex-a">
                            <div align="center" class="mt-3 mb-3 char"><img src="../assets/img/char/{{auth()->user()->getCharImg()}}"></div>
                        </div>
                        <div class="mt-4">
                            <div align="center" class="progress-container col-12">
                                <span style="color:{{auth()->user()->color}}" class="progress-badge">{{auth()->user()->getScore()}}pts</span>
                                <div class="progress mt-0 pb">
                                    <div class="progress-bar progress-bar-striped" style="background-color:{{auth()->user()->color}}; width: {{auth()->user()->getBarValue()}}%;" role="progressbar" aria-valuenow="{{auth()->user()->getScore()}}" aria-valuemin="0" aria-valuemax="100" role="progressbar">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-a mt-4">
                            <div>
                                <span align="center" ><img class="trophy-size" src="../assets/img/icons/trophy.png"><span class="bold fs-18"> 
                                <?php if(Auth()->user()->rank) { ?>
                                    {{auth()->user()->rank}}º 
                                <?php } else { ?>
                                    <span style="font-size: 14px">Não Rankeado</span>
                                <?php } ?>
                                </span></span>
                            </div>
                        </div>
                        @if (config('features.tests'))
                        <div class="flex-a mt-4">
                            <div class="badges">
                                <span align="center" ><img class="badge-size mx-1" src="../assets/img/badges/php.png"></span>
                                <span align="center" ><img class="badge-size mx-1" src="../assets/img/badges/go.png"></span>
                                <span align="center" ><img class="badge-size mx-1" src="../assets/img/badges/python.png"></span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-md-12 col-1"></div>
            @endauth
            @yield('content')
            </div>
            </div>
        </div>
        @auth
        @if (config('features.chat'))
        <div id="chat-min-div" class="col-lg-3 col-md-3 col-sm-6 col-6 chat">
            <div class="card card-min"">
            <div style="display:flex; justify-content:space-between">
                <h4 class="card-min-title">
                Chat <i class="now-ui-icons ui-2_chat-round" style="position:relative;top:3px"></i>
                </h4>
                <div style="margin-top:4px; margin-right:4px" onclick="showChat()" id="div-open">
                    <i class="now-ui-icons arrows-1_minimal-up"></i>
                </div>
            </div>
            </div>
        </div>
       
        <div id="chat-div" class="col-lg-3 col-md-3 col-sm-6 col-6 chat">
                    <div class="card">
                        <div class="card-body container">
                            <div style="display:flex; justify-content:space-between">
                                <h4 class="card-title box-title">
                                Chat
                                </h4>
                                <div onclick="hideChat()" id="div-close">
                                    <i class="now-ui-icons arrows-1_minimal-down"></i>
                                </div>
                            </div>
                            <div class="card-content row">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-4 card-overflow-y">
                                    <ul class="list-group" style="list-style-type:none;">
                                    @foreach (App\User::getAllUsers() as $user)
                                        <li class="chat-avatar" id="user-{{$user->id}}"><span class="badge badge-danger" id="clear-count-{{$user->id}}" style="background-color:transparent;border-color:transparent;color:transparent;z-index:1000;position:relative;top:17px;left:8px">0</span><img onclick="openChat(<?php echo $user->id?>)" src="https://media-exp1.licdn.com/dms/image/C4E03AQF6_Y5xP6pd7w/profile-displayphoto-shrink_200_200/0?e=1605139200&v=beta&t=EAc_MK9AF9YiWgQNrXBZD5YTFcu3jVZ2-isWfA4k7hI" class="figure-img img-fluid rounded" style></li>
                                        <!-- <div align="center"><li class="chat-avatar"><div align="center" class="bg-blue py-1 badge"><strong><span style="font-size:18px;">+</span></strong></li></div> -->
                                    @endforeach
                                    </ul>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-8">
                                    <div id="messenger-box" class="messenger-box card-overflow-y" style="overflow-x:none;">
                                    <div id="empty-chat" class="card-subtitle mb-2 text-muted">
                                    <div><h6 id="msg-empty"></h6></div>
                                    <!-- <div style="" class="lds-hourglass"></div> loading -->
                                    </div>
                                    </div><!-- /.messenger-box -->
                                    <div class="send-mgs">
                                            <div class="yourmsg">
                                                <input id="input-msg" class="form-control" type="text">
                                            </div>

                                            <button onclick="sendMessage()" type="button" id="btn-msg" class="msg-send-btn">
                                                <div>
                                                    <i class="now-ui-icons ui-1_send"></i>
                                                </div>
                                            </button>
                                        </div>
                                </div>
                            </div>
                        </div> <!-- /.card-body -->
                        <div class="footer-inner bg-white">
                        <div class="row">
                            <div class="col-sm-6">
                                Copyright &copy; 2018 Ela Admin
                            </div>
                            <div class="col-sm-6 text-right">
                                Designed by <a target="_blank" href="https://colorlib.com">Colorlib</a>
                            </div>
                        </div>
                    </div>
                    </div><!-- /.card -->
                </div>
                @endif
        @endauth
    </main>

    @yield('scripts')

    @auth
    <script>

        $(document).ready(function(){
        <?php if (config('features.chat')) { ?> 
            hideChat();
            noChatSelected();
            my_name = '<?php echo Auth::user()->name ?>';
            your_name = null;
            my_id = <?php echo Auth::user()->id ?>;
            your_id = null;

            socket = io.connect("https://qg-chat.herokuapp.com/");
            socket.emit('news', {user_id_1: my_id});
            socket.on('message', (data) => {
                json = JSON.parse(data);
                if(json.count) {
                    addCountNew(json);
                } else if(json.writing) {
                    isWriting(json);
                } else {
                    addMessage(json);
                }
                scrollTopAnimated();
            });
        <?php } ?>
        });

        openChat = (user_id) => {
            $("#messenger-box ul").remove();
            $("#empty-chat").show();
            setUser(user_id);
            socket.emit('write', {user_id_1: my_id, user_id_2: user_id});
            socket.emit('openChatRoom', {user_id_1: my_id, user_id_2: user_id});
            emptyMessage();
            unlockChat();
        }

        setUser = (user_id) => {
            <?php foreach(App\User::getAllUsers() as $user) { ?>
                if(<?php echo $user->id?> == user_id) {
                    your_id = <?php echo $user->id?>;
                    your_name = '<?php echo $user->name?>';
                }
            <?php } ?>
        }

        sendMessage = () => {
            var msg = $("#input-msg").val();
            $("#input-msg").val('');
            var messageObject = {
                message : msg,
                user_id_1 : my_id,
                user_id_2 : your_id,
            }
            socket.emit('sendMessage', messageObject);
        }

        hideChat = () => {
            $("#chat-div").hide();
            $("#chat-min-div").show();
        }

        showChat = () => {
            $("#chat-min-div").hide();
            $("#chat-div").show();
            scrollTopAnimated();
        }

        addMessage = (message) => {
            $("#empty-chat").hide();
            var image = "https://media-exp1.licdn.com/dms/image/C4E03AQF6_Y5xP6pd7w/profile-displayphoto-shrink_200_200/0?e=1605139200&v=beta&t=EAc_MK9AF9YiWgQNrXBZD5YTFcu3jVZ2-isWfA4k7hI";
            if(my_id == message.user_id_sent) {
                if (message.user_id_received != your_id) {
                    return;
                }
                var html = getSendHTMLMessages(message.user_id_sent,message.message,image,message.datetime);
            } else {
                if (message.user_id_sent != your_id) {
                    return;
                }
                var html = getReceivedHTMLMessages(message.user_id_sent,message.message,image,message.datetime);
            }

            $("#messenger-box").append(html);
            fillUser(your_name);
        }

        getReceivedHTMLMessages = (username,msg,profile_url,date) => {
            var received_msg_html = '<ul><li><div class="msg-received msg-received-call msg-container"><div class="avatar">'+
            '<img src="'+profile_url+'" alt="">'+
            '<div class="send-time">'+getDateTime(date)+'</div></div><div class="msg-box"><div class="inner-box"> <div class="name">'+
            '<span class="user-name-received"></span>' + '</div><div class="meg">'+msg+'</div></div></div></div></li></ul>';
            return received_msg_html;
        }
        getSendHTMLMessages = (username,msg,profile_url,date) => {
            var send_msg_html = '<ul><li><div class="msg-sent msg-sent-call msg-container"><div class="avatar">'+
            '<img src="'+profile_url+'" alt="">'+
            '<div class="send-time">'+getDateTime(date)+'</div></div><div class="msg-box"><div class="inner-box"> <div class="name">'+
            '<span class="user-name-sent">'+my_name+'</span>' + '</div><div class="meg">'+msg+'</div></div></div></div></li></ul>';
            return send_msg_html;
        }

        getDateTime = (timestamp) => {
            var ts = Math.trunc(timestamp/1000);
            dateObj = new Date(ts * 1000);
            brString = dateObj.toLocaleString("pt-BR", {timeZone: "America/Sao_Paulo"});
            return brString;
        }

        saveUserId = (uid) => {
            your_id = uid;
        }

        fillUser = (name) => {
            $(".user-name-received").text(name);
        }

        scrollTopAnimated = () => {
            var scroll = $("#messenger-box");
            var totalOverflow = scroll.css('height');
            var toverflow = totalOverflow.split('px');
            var velocity = 1000000000; //to force fast and whole animation
            $("#messenger-box").animate(
                { scrollTop: toverflow[0] * velocity}, 1);
        }

        addCountNew = (data) => {
            if(!Number.isInteger(data.count)) {
                return;
            }
            var id = "#user-"+data.user_id;
            var cc = "clear-count-"+data.user_id;
            $("#"+cc).remove();
            var html = '<span class="badge badge-danger" id="'+cc+'" style="z-index:1000;position:relative;top:17px;left:8px">'+data.count+'</span>';
            $(id).prepend(html);
        }

        isWriting = (data) => {
            var input = $(".yourmsg");
            $(".clear-writing").remove();
            if(data.writing == 1){
                var html = "<span class='writing-text clear-writing'>" +your_name+ " está digitando...</span>";
                input.append(html);
                blink(".clear-writing");
            }
        }

        $("#input-msg").focus(() => {
            socket.emit('startWrite', {user_id_1: my_id, user_id_2: your_id});
        });

        $("#input-msg").focusout(() => {
            if($("#input-msg").val().length > 0){
                return;
            }

            socket.emit('stopWrite', {user_id_1: my_id, user_id_2: your_id});
        });

        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                if($("#input-msg").is(":focus") && $("#input-msg").val().length > 0) {
                    sendMessage();
                }
            }
        });

        blink = (selector) => {
            $(selector).fadeOut('slow', function() {
                $(this).fadeIn('slow', function() {
                    blink(this);
                });
            });
        }

        emptyMessage = () => {
            var msg = "Ops! Vocês ainda não mandaram nenhuma mensagem =(";
            $("#msg-empty").text(msg);
        }

        noChatSelected = () => {
            var msg = "Por favor selecione um chat para iniciar uma conversa";
            $("#msg-empty").text(msg);
            lockChat();
        }

        lockChat = () => {
            $("#input-msg").attr("disabled",true);
            $("#btn-msg").attr("disabled",true);
        }

        unlockChat = () => {
            $("#input-msg").attr("disabled",false);
            $("#btn-msg").attr("disabled",false);
        }

        $("#input-msg").keydown( () => {
            if(!your_id){
                lockChat();
            }
        });
        // $(window).bind('beforeunload', function(){
        //     return 'Are you sure you want to leave?';
        // });
    </script>
    @endauth

</body>
</html>
