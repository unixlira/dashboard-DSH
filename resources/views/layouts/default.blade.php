<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        Desejo Sexual Hipoativo
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('assets/img/logo1.ico')}}"/>
    <!-- global styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/components.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/custom.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/chat.css')}}"/>
    <link type="text/css" rel="stylesheet" href="#" id="skin_change"/>
    
    <!-- end of global styles-->
    @yield('header_styles')
</head>

<body>
<div class="preloader" style=" position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 100000;
  backface-visibility: hidden;
  background: #ffffff;">
    <div class="preloader_img" style="width: 200px;
  height: 200px;
  position: absolute;
  left: 48%;
  top: 48%;
  background-position: center;
z-index: 999999">
        <img src="{{asset('assets/img/loader.gif')}}" style=" width: 40px;" alt="loading...">
    </div>
</div>
<div class="bg-dark" id="wrap">
    <div id="top">
        <!-- .navbar -->
        <nav class="navbar navbar-static-top">
            <div class="container-fluid m-0">
                <a class="navbar-brand" href="{{ URL::to('index1') }}">
                    <h4><img src="{{asset('assets/img/logo.png')}}" class="admin_img" alt="Desejo Sexual Hipoativo"></h4>
                </a>
                <div class="menu mr-sm-auto">
                    <span class="toggle-left" id="menu-toggle">
                        <i class="fa fa-bars"></i>
                    </span>
                </div>
                @if(Request::session()->get('permissao',1) != 2)
                <div class="top_search_box d-none d-md-flex">
                    <form class="header_input_search">
                        <input type="text" placeholder="Buscar" name="buscar">
                        <button type="submit">
                            <span class="font-icon-search"></span>
                        </button>
                        <div class="overlay"></div>
                    </form>
                </div>
                @endif
                <div class="topnav dropdown-menu-right">
                    <div class="btn-group">

                        <!-- ICONE NOTIFICAÇÕES
                        <div class="notifications no-bg">
                            <a class="btn btn-default btn-sm messages" data-toggle="dropdown" id="messages_section"> <i
                                    class="fa fa-flag-o fa-stack-2x"></i>
                                <span class="badge badge-pill badge-warning notifications_badge_top">3</span>
                            </a>
                            <div class="dropdown-menu drop_box_align" role="menu" id="messages_dropdown">
                                <div class="popover-header">Alerta de Atividades</div>
                                <div id="messages">
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-10 message-data">
                                                Emissão de Cupom de R$ 500,00
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-10 message-data">
                                                Tentativa de Resgate de Cupom Utilizado
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-10 message-data">
                                                Liberação superior a 99 spins para CPF / CNPJ
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="popover-footer">
                                    <a href="{{ URL::to('notificacoes/vertodas') }}" class="text-white">Ver Todas</a>
                                </div>
                            </div>
                        </div>
                        -->

                    </div>
                    
                    <div class="btn-group">
                        <div class="user-settings no-bg">
                            <button type="button" class="btn btn-default no-bg micheal_btn" data-toggle="dropdown">
                                <img src="{{asset('assets/img/foto_perfil/'.Request::session()->get('foto'))}}" class="admin_img2 img-thumbnail rounded-circle avatar-img"
                                     alt="avatar"> Usuário conectado: {{Request::session()->get('nome')}}
                                <span class="fa fa-sort-down white_bg"></span>
                            </button>
                            <div class="dropdown-menu admire_admin">
                                <a class="dropdown-item" href="{{ URL::to('usuarios/perfilusuario/'.Request::session()->get('id_usuario')) }}"><i class="fa fa-cogs"></i>
                                    Informações</a>
                                <a class="dropdown-item" href="{{ URL::to('login/lockscreen') }}"><i class="fa fa-lock"></i>
                                    Bloquear sessão</a>
                                <a class="dropdown-item" href="{{ URL::to('login/logoff') }}"><i class="fa fa-sign-out"></i>
                                    Finalizar Sessão</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.container-fluid -->
        </nav>
        <!-- /.navbar -->
        <!-- /.head -->
    </div>
          
    <!-- /#top -->
    <div class="wrapper">
        <div id="left">
            <div class="menu_scroll">
                <div class="left_media">
                    <div class="media user-media">
                        <div class="user-media-toggleHover">
                            <span class="fa fa-user"></span>
                        </div>
                        <div class="user-wrapper">
                            <a class="user-link" href="{{ URL::to('usuarios/perfilusuario/'.Request::session()->get('id_usuario')) }}">
                                <img class="media-object img-thumbnail user-img rounded-circle admin_img3" alt="User Picture"
                                     src="{{asset('assets/img/foto_perfil/'.Request::session()->get('foto'))}}">
                                <p class="user-info menu_hide">Bem-vindo(a) {{mb_strimwidth(Request::session()->get('nome'), 0, 16, '...')}}</p>
                            </a>
                        </div>
                    </div>
                    <hr/>
                </div>
                    <?php
                        $url = explode('/', (Request::url())); //pegando a url pra verificar quando é acessado o menu detalhesparticipante
                        $link = '';
                        /*
                        if (count($url) > 6) { //verificando se existe a 4ª posicao
                            $link = $url[6];
                        }
                        */
                        if (count($url) > 4) { //verificando se existe a 4ª posicao
                            $link = $url[4];
                        }
                        
                    ?>
                <ul id="menu">
                    @if(Request::session()->get('permissao',1) != 2)
                        <li {!! (Request::is('index1') || Request::is('/') || Request::is('acoesrecentes') ? 'class="active"':"") !!}>
                        <a href="{{ URL::to('index1') }} ">
                            <i class="fa fa-home"></i>
                            <span class="link-title menu_hide">&nbsp;&nbsp;Início</span>
                        </a>
                        </li>
                    @endif
                    <li class="dropdown_menu {!! (Request::is('usuarios/listarusuarios')|| Request::is('usuarios/novousuario')|| Request::is('usuarios/usuariosremovidos')|| ($link == 'perfilusuario')||($link == 'editarusuario') ? 'active' : '') !!}">
                        <a href="javascript:;">
                            <i class="fa fa-users"></i>
                            <span class="link-title menu_hide">&nbsp; Usuários</span>
                            <span class="fa arrow menu_hide"></span>
                        </a>
                        <ul class="collapse">
                            @if(Request::session()->get('permissao',1) != 2)
                                <li {!! (Request::is('usuarios/listarusuarios') ? 'class="active"' : '') !!}>
                                <a href="{{ URL::to('usuarios/listarusuarios') }}">
                                    <i class="fa fa-angle-right"></i>
                                    &nbsp; Lista de Usuários
                                </a>
                                </li>
                                @if(Request::session()->get('permissao',1) == 1)
                                    <li {!! (Request::is('usuarios/novousuario') ? 'class="active"' : '') !!}>
                                    <a href="{{ URL::to('usuarios/novousuario') }}">
                                        <i class="fa fa-angle-right"></i>
                                        <span class="link-title">&nbsp;Adicionar Usuário</span>
                                    </a>
                                    </li>
                                @endif
                            @endif
                            <li {!! (($link == 'perfilusuario')|| ($link == 'editarusuario') ? 'class="active"' : '') !!}>
                            <a href="{{ URL::to('usuarios/perfilusuario/'.Request::session()->get('id_usuario')) }}">
                                <i class="fa fa-angle-right"></i>
                                &nbsp; Perfil do Usuário
                            </a>
                            </li>
                            @if(Request::session()->get('permissao',1) != 2)
                                @if(Request::session()->get('permissao',1) == 1)
                                    <li {!! (Request::is('usuarios/usuariosremovidos') ? 'class="active"' : '') !!}>
                                    <a href="{{ URL::to('usuarios/usuariosremovidos') }}">
                                        <i class="fa fa-angle-right"></i>
                                        &nbsp; Usuários Removidos
                                    </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </li>
                    <li class="dropdown_menu {!! (Request::is('medicos') || Request::is('medicos/cadastrados') || Request::is('medicos/bloqueados')? 'active' : '') !!}">
                        <a href="javascript:;">
                            <i class="fa fa-user-md"></i>
                            <span class="link-title menu_hide">&nbsp; Médicos</span>
                            <span class="fa arrow menu_hide"></span>
                        </a>
                        <ul class="collapse">
                            <li {!! (Request::is('medicos/cadastrados') ? 'class="active"' : '') !!}>
                                <a href="{{ URL::to('/medicos/cadastrados') }}">
                                    <i class="fa fa-angle-right"></i>
                                    <span class="link-title">&nbsp;Médicos Cadastrados</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="collapse">
                            <li {!! (Request::is('medicos/bloqueados') ? 'class="active"' : '') !!}>
                                <a href="{{ URL::to('medicos/bloqueados') }}">
                                    <i class="fa fa-angle-right"></i>
                                    <span class="link-title">&nbsp;Médicos Bloqueados</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li {!! (($link == 'performance')  ? 'class="active"':"") !!}>
                        <a href="{{URL::to('/relatorios/performance')}} ">
                            <i class="fa fa-share-alt fa-flip-horizontal"></i>
                            <span class="link-title menu_hide">&nbsp; Relatórios de Performance</span>
                        </a>
                    </li>

                    <li  {!! (($link == 'recebidas') || ($link == 'responder') ? 'class="active"':"") !!}>
                        <a href="{{URL::to('/perguntas/recebidas')}} ">
                            <i class="fa fa-question "></i>
                            <span class="link-title menu_hide">&nbsp; Perguntas Recebidas</span>
                        </a>
                    </li>
                </ul>
                <!-- /#menu -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer navbar-fixed-bottom">
                <div class="chat_box" style="position: absolute;">
                    <div class="chat_head">Chat</div>
                    <div class="chat_body card" id="contatos" style="overflow: auto; display: none;"> 
                    </div>
                </div>

                <div class="msg_box" style="right:260px; position: absolute;">
                    <div class="msg_head"><span id="user_name">Teste</span>
                        <div class="close">x</div>
                    </div>
                    <div class="msg_wrap card">
                        <div class="msg_body" id="mensagens">
                        </div>
                        <div class="msg_footer"><textarea class="msg_input" rows="4"></textarea></div>
                    </div>
                </div>
                <div class="container-fluid m-0">
                    <div class="textoFooter col-12">Desenvolvido por Magic TV &reg; 2019. Todos os Direitos Reservados.</div>    
                </div>
            </footer>
        </div>
        <!-- /#left -->
        <div id="content" class="bg-container">
            <!-- Content -->
        @yield('content')
        <!-- Content end -->
        </div>

</div>

<!-- /#wrap -->
<!-- global scripts-->
<script type="text/javascript" src="{{asset('assets/js/components.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom.js')}}"></script>
<script type="text/javascript">
    
    $(document).ready(function(){
        $('.msg_box').hide();
        $('#contatos').html('<div id="carregando" style=\'background: url("{{asset("assets/img/loader.gif")}}") no-repeat center; height: 100px; \'></div>');
        setInterval('verificaMensagens()', 10000); //verifica se tem novas mensagens na conversa atual a cada 2 segundos
        // setInterval('carregaContatos()', 5000); //atualiza a listagem de contatos a cada 2 segundos
    });

    function verificaMensagens(){
        if ($('.msg_box').css('display') != 'none') { //se o chat ta aberto, verifica:
            carregaMensagens('{{Request::session()->get("id_usuario")}}',$('.id_destinatario')[0].id);
            visualizarMensagem('{{Request::session()->get("id_usuario")}}',$('.id_destinatario')[0].id);
        }
    }

    $('.chat_head').click(function(){
        $('.chat_body').slideToggle('slow');
    });
    $('.msg_head').click(function(){
        $('.msg_wrap').slideToggle('slow');
    });
    
    $('.close').click(function(){
        $('.msg_box').hide();
    });
    
    $(document).on('click', '.user', function(){ //Pegando elementos criados dinamicamente direto da DOM
        //console.info(this.id);
        $('#mensagens').html('<div id="carregando" style=\'background: url("{{asset("assets/img/loader.gif")}}") no-repeat center; height: 100px; \'></div>');
        $('#user_name').html($(this).text()+'<span class="id_destinatario" id="'+this.id+'"</span>');
        $('.msg_wrap').show();
        $('.msg_box').show();
        carregaMensagens('{{Request::session()->get("id_usuario")}}',this.id);
    });
    
    $('textarea').keypress(
        function(e){
            if (e.keyCode == 13) {
                e.preventDefault();
                var msg = $(this).val();
                $(this).val('');
                if(msg!=''){
                    $('<div class="msg_b">'+msg+'</div>').insertBefore('.msg_push');
                    enviaMensagem('{{Request::session()->get("id_usuario")}}', $('.id_destinatario')[0].id, msg);
                }
            }
        }
    );

    function enviaMensagem(id_usuario, id_destinatario, mensagem){
        $.post("/nagumoplay/site/chat/enviamensagem", {id_usuario:id_usuario, id_destinatario:id_destinatario, mensagem:mensagem, "_token": "{{ csrf_token() }}"}, function(result){
        //$.post("/chat/enviamensagem", {id_usuario:id_usuario, id_destinatario:id_destinatario, mensagem:mensagem, "_token": "{{ csrf_token() }}"}, function(result){
            $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight); //rola a conversa para baixo
        });
    }
    
    // function carregaContatos(){
    //     $.ajax({
    //         type: 'GET',
    //         url: "/nagumoplay/site/chat/carregacontatos",
    //         //url: "/chat/carregacontatos",
    //         success: function(data) {
    //             let contatos = '';
    //             //montando o layout
    //             let classe = 'mensagemPendente';
    //             let remetente = new Array();
    //             for (var i = 0; i <= data.length - 1; i++) {
    //                 if (data[i].id_usuario != null) {
    //                     remetente.push(data[i].id_usuario);
    //                 }
    //                 if (data[i].id != '{{Request::session()->get("id_usuario")}}') {
    //                     if (data[i].ativo == 1 && data[i].permissao != 3) {
    //                         if (data[i].status_chat == 1) {
    //                             if (jQuery.inArray( data[i].id, remetente ) != -1) { //existe o ID no array
    //                                 contatos += '<div class="'+classe+' user" id="'+data[i].id+'"> '+data[i].nome+'</div>';
    //                             }else{
    //                                 contatos += '<div class="user" id="'+data[i].id+'"> '+data[i].nome+'</div>';
    //                             }
    //                         }else{
    //                             if (jQuery.inArray( data[i].id, remetente ) != -1) { //existe o ID no array
    //                                 contatos += '<div class="'+classe+' user offline" id="'+data[i].id+'"> '+data[i].nome+'</div>';
    //                             }else{
    //                                 contatos += '<div class="user offline" id="'+data[i].id+'"> '+data[i].nome+'</div>';
    //                             }
    //                         }                            
    //                     }
    //                 }
    //             }
    //             $('#contatos').html(contatos);
    //         }
    //     });
    // }

    function carregaMensagens(id, destinatario){
        $.ajax({
            type: 'GET',
            url: "/nagumoplay/site/chat/carregamensagens/"+id+"/"+destinatario+"",
            //url: "/chat/carregamensagens/"+id+"/"+destinatario+"",
            success: function(data) {
                //montando o layout
                let mensagens = '';
                for (var i = 0; i <= data.length - 1; i++) {
                    //identificando de quem sao as mensagens
                    if (data[i].id_usuario != '{{Request::session()->get("id_usuario")}}') {
                        mensagens += '<div class="msg_a">'+data[i].mensagem+'</div>';
                    }else{
                        mensagens += '<div class="msg_b">'+data[i].mensagem+'</div>';
                    }
                }
                mensagens += '<div class="msg_push"></div>';
                $('#mensagens').html(mensagens);
                $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
            }
        });
    }

    function visualizarMensagem(id, destinatario){
        $.ajax({
            type: 'GET',
            url: "/nagumoplay/site/chat/visualizarmensagem/"+id+"/"+destinatario+"",
            //url: "/chat/visualizarmensagem/"+id+"/"+destinatario+"",
            success: function(data) {
                //nadinha
            }
        });
    }
</script>
<!-- end of global scripts-->
<!-- page level js -->
@yield('footer_scripts')
<!-- end page level js -->
</body>
</html>