@extends(('layouts/default'))
{{-- Page title --}}
@section('title')
    Dashboard-1
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/c3/css/c3.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/custom.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/components.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/toastr/css/toastr.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/switchery/css/switchery.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/new_dashboard.css')}}"/>
    <link href="{{asset('assets/css/pages/flot_charts.css')}}" rel="stylesheet" type="text/css">
@stop
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-6">
                    <h4 class="m-t-5" style="color:#ffffff;">
                        <i class="fa fa-home"></i>
                        Página Inicial
                    </h4>
                </div>
            </div>
        </div>
    </header>
<div class="outer">
    <div class="inner bg-container">
        <div class="row"> <!-- Contagem Participantes e Pontuação -->
            <div class="col-lg-4 col-12 m-t-15">
                <div class="card">
                    <div class="card-header bg-white">Total de Médicos Cadastrados</div>
                    <div class="card-header bg-white" style="border-bottom: 0px !important"><strong><h1><span id="totalMedicos">0</span></h1><div class="margemBaixo"></div></strong></div>
                </div>

            </div>
            <div class="col-lg-4 col-12 m-t-15">
                
                <div class="card">
                    <div class="card-header bg-white">Novos Médicos (Dia / Semana / Mês)</div>
                    <div class="card-header bg-white" style="border-bottom: 0px !important">
                        <div class="row">
                            <div class="col-md-4 ">
                                <strong><h2><span id="novosMedicosDia">0</span></h2></strong><br />Diário
                            </div>
                            <div class="col-md-4 ">
                                <strong><h2><span id="novosMedicosSemana">0</span></h2></strong><br />Semanal
                            </div>
                            <div class="col-md-4 ">
                                <strong><h2><span id="novosMedicosMes">0</span></h2></strong><br />Mensal
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12 m-t-15">
               <div class="card">
                    <div class="card-header bg-pontuacao">Total de Adesão aos Cursos (Dia / Semana / Mês)</div>
                    <div class="card-header bg-pontuacao" style="border-bottom: 0px !important">
                        <div class="row">
                            <div class="col-md-4 ">
                                <strong><h2><span id="totalcursosDia">0</span></h2></strong><br />Diário
                            </div>
                            <div class="col-md-4 ">
                                <strong><h2><span id="adesaoCursosSemana">0</span></h2></strong><br />Semanal
                            </div>
                            <div class="col-md-4 ">
                                <strong><h2><span id="adesaoCursosMes">0</span></h2></strong><br />Mensal
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"> <!-- ContabilIdade de Cupons e Top 10 Promocoes -->
            <div class="col-lg-6 col-12 m-t-15">
                <div class="card col-12 bg-spins">
                    <div class="card-header" style="border-bottom: 0px !important; color: #fff !important;">Faixa Etária Médicos</div>
                </div>            
                <div class="card col-12 m-t-10">
                    <div class="col-lg-12">
                        <div id="faixaetaria" style="width: 650px; height: 390px;"></div>
                    </div>                     
                </div>
            </div>
            <div class="col-lg-6 col-12 m-t-15">
                <div class="card col-12 bg-spins">
                    <div class="card-header" style="border-bottom: 0px !important; color: #fff !important;">Top 10 - Cursos</div>
                </div>
                <div class="card col-12 m-t-10">
                    <div class="card-body p-0" style="text-align: center !important;">
                        <div class="row task-item">
                            <div class="col-3" id="topPromocao0">Nome Promoção 1</div>
                            <div class="col-5" id="progress-bar">
                                <!--<progress class="progress progress-danger" value="52"-->
                                <!--max="100"></progress>-->
                                <div class="progress">
                                    <div id="topPromocao0Progress" class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="totalTop10_0">0</span>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="porcentagemTop10_0">0%</span>
                            </div>
                        </div>
                        <div class="row task-item">
                            <div class="col-3" id="topPromocao1">Nome Promoção 2</div>
                            <div class="col-5" id="progress-bar">
                                <!--<progress class="progress progress-danger" value="52"-->
                                <!--max="100"></progress>-->
                                <div class="progress">
                                    <div id="topPromocao1Progress" class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="totalTop10_1">0</span>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="porcentagemTop10_1">0%</span>
                            </div>
                        </div>
                        <div class="row task-item">
                            <div class="col-3" id="topPromocao2">Nome Promoção 3</div>
                            <div class="col-5" id="progress-bar">
                                <!--<progress class="progress progress-danger" value="52"-->
                                <!--max="100"></progress>-->
                                <div class="progress">
                                    <div id="topPromocao2Progress" class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="totalTop10_2">0</span>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="porcentagemTop10_2">0%</span>
                            </div>
                        </div>
                        <div class="row task-item">
                            <div class="col-3" id="topPromocao3">Nome Promoção 4</div>
                            <div class="col-5" id="progress-bar">
                                <!--<progress class="progress progress-danger" value="52"-->
                                <!--max="100"></progress>-->
                                <div class="progress">
                                    <div id="topPromocao3Progress" class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="totalTop10_3">0</span>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="porcentagemTop10_3">0%</span>
                            </div>
                        </div>
                        <div class="row task-item">
                            <div class="col-3" id="topPromocao4">Nome Promoção 5</div>
                            <div class="col-5" id="progress-bar">
                                <!--<progress class="progress progress-danger" value="52"-->
                                <!--max="100"></progress>-->
                                <div class="progress">
                                    <div id="topPromocao4Progress" class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="totalTop10_4">0</span>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="porcentagemTop10_4">0%</span>
                            </div>
                        </div>
                        <div class="row task-item">
                            <div class="col-3" id="topPromocao5">Nome Promoção 6</div>
                            <div class="col-5" id="progress-bar">
                                <!--<progress class="progress progress-danger" value="52"-->
                                <!--max="100"></progress>-->
                                <div class="progress">
                                    <div id="topPromocao5Progress" class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="totalTop10_5">0</span>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="porcentagemTop10_5">0%</span>
                            </div>
                        </div>
                        <div class="row task-item">
                            <div class="col-3" id="topPromocao6">Nome Promoção 7</div>
                            <div class="col-5" id="progress-bar">
                                <!--<progress class="progress progress-danger" value="52"-->
                                <!--max="100"></progress>-->
                                <div class="progress">
                                    <div id="topPromocao6Progress" class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="totalTop10_6">0</span>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="porcentagemTop10_6">0%</span>
                            </div>
                        </div>
                        <div class="row task-item">
                            <div class="col-3" id="topPromocao7">Nome Promoção 8</div>
                            <div class="col-5" id="progress-bar">
                                <!--<progress class="progress progress-danger" value="52"-->
                                <!--max="100"></progress>-->
                                <div class="progress">
                                    <div id="topPromocao7Progress" class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="totalTop10_7">0</span>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="porcentagemTop10_7">0%</span>
                            </div>
                        </div>
                        <div class="row task-item">
                            <div class="col-3" id="topPromocao8">Nome Promoção 9</div>
                            <div class="col-5" id="progress-bar">
                                <!--<progress class="progress progress-danger" value="52"-->
                                <!--max="100"></progress>-->
                                <div class="progress">
                                    <div id="topPromocao8Progress" class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="totalTop10_8">0</span>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="porcentagemTop10_8">0%</span>
                            </div>
                        </div>
                        <div class="row task-item">
                            <div class="col-3" id="topPromocao9">Nome Promoção 10</div>
                            <div class="col-5" id="progress-bar">
                                <!--<progress class="progress progress-danger" value="52"-->
                                <!--max="100"></progress>-->
                                <div class="progress">
                                    <div id="topPromocao9Progress" class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="totalTop10_9">0</span>
                            </div>
                            <div class="col-2">
                                <span class="progress-info" id="porcentagemTop10_9">0%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"> <!-- Graficos de Donut -->
            <div class="{{(Request::session()->get('permissao') != 1 ? 'col-lg-6' : 'col-lg-4')}} col-12 m-t-15">
                <div class="card">
                    <div class="card-header bg-white">
                        Gênero dos Médicos
                    </div>
                    <div class="card-block">
                        <div id="donutchart"  style=" height: 340px;"></div>
                    </div>
                </div>
            </div>
            <div class="{{(Request::session()->get('permissao') != 1 ? 'col-lg-12' : 'col-lg-8')}} col-12 m-t-15">
                <div class="card">
                    <ul id="clothing-nav" class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#home" id="home-tab" role="tab"
                               data-toggle="tab" aria-controls="home" aria-expanded="true">Acessos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#hats" role="tab" id="hats-tab" data-toggle="tab"
                               aria-controls="hats">Volume de Acesso às Aulas vs. Data</a>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div id="clothing-nav-content" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="home"
                                 aria-labelledby="home-tab">
                                <div id="area-chart" class="flotChart003" ></div>
                            </div>
                            <!--
                            <div role="tabpanel" class="tab-pane fade" id="hats" aria-labelledby="hats-tab">
                                <div id="area-chart2" class="flotChart3"></div>
                            </div>
                            -->
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-4 col-12 m-t-15">
                <div class="card">
                    <div class="card-header bg-white">
                        <div class=" twitter_section_head">
                            <a href="acoesrecentes">AtivIdades Recentes</a>
                        </div>
                    </div>
                    <div class="card-block twitter_section">
                        <ul id="nt-example1" style="height: 253px; overflow: hidden;">
                            <li style="margin-top: 0px;">
                                <div class="row">
                                    <div class="col-2 col-lg-3 col-xl-2">
                                        <a id="linkPerfilAcao0" href="#"><img src="{{asset('assets/img/foto_perfil/foto_perfil.png')}}" id="imagemAcao0" class="rounded-circle" alt="image not found"></a>
                                    </div>
                                    <div class="col-10 col-lg-9 col-xl-10">
                                        <span class="name" id="nomeUsuarioAcao0">Nome Usuário</span> <span id="dataAcao0" class="time">DD/MM/AAAA</span>
                                        <br>
                                        <span class="msg"><a id="linkAcao0" href="#"><span id="acao0">Ação Usuário</span></a></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-2 col-lg-3 col-xl-2">
                                        <a id="linkPerfilAcao1" href="#"><img src="{{asset('assets/img/foto_perfil/foto_perfil.png')}}" id="imagemAcao1" class="rounded-circle" alt="image not found"></a>
                                    </div>
                                    <div class="col-10 col-lg-9 col-xl-10">
                                        <span class="name" id="nomeUsuarioAcao1">Nome Usuário</span> <span id="dataAcao1" class="time">DD/MM/AAAA</span>
                                        <br>
                                        <span class="msg"><a id="linkAcao1" href="#"><span id="acao1">Ação Usuário</span></a></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-2 col-lg-3 col-xl-2">
                                        <a id="linkPerfilAcao2" href="#"><img src="{{asset('assets/img/foto_perfil/foto_perfil.png')}}" id="imagemAcao2" class="rounded-circle" alt="image not found"></a>
                                    </div>
                                    <div class="col-10 col-lg-9 col-xl-10">
                                        <span class="name" id="nomeUsuarioAcao2">Nome Usuário</span> <span id="dataAcao2" class="time">DD/MM/AAAA</span>
                                        <br>
                                        <span class="msg"><a id="linkAcao2" href="#"><span id="acao2">Ação Usuário</span></a></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-2 col-lg-3 col-xl-2">
                                        <a id="linkPerfilAcao3" href="#"><img src="{{asset('assets/img/foto_perfil/foto_perfil.png')}}" id="imagemAcao3" class="rounded-circle" alt="image not found"></a>
                                    </div>
                                    <div class="col-10 col-lg-9 col-xl-10">
                                        <span class="name" id="nomeUsuarioAcao3">Nome Usuário</span> <span id="dataAcao3" class="time">DD/MM/AAAA</span>
                                        <br>
                                        <span class="msg"><a id="linkAcao3" href="#"><span id="acao3">Ação Usuário</span></a></span>
                                    </div>
                                </div>
                                <hr>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-12 m-t-15">
                <div class="row">
                    <div class="col-lg-7 col-12">
                        <div class="card to_do">
                            <div class="card-header bg-white">
                                Lista de Afazeres
                            </div>
                            <div class="card-block no-padding to_do_section">
                                <div >
                                    <div style="position: relative; overflow: hidden; width: auto; height: 213px;">
                                        <div id="salvandoAfazeres" style="background: url('{{asset('assets/img/loader.gif')}}') no-repeat center; height: 245px; display: none;"></div>
                                        <div class="todo_section" id="formListaAfazeres">
                                                <?php $c = 0;?>
                                                @foreach($listagemAfazeres as $tarefa)
                                                <form class="list_of_items" id="atualizaAfazer{{$listagemAfazeres[$c]->id}}" action="atualizaAfazer/{{$listagemAfazeres[$c]->id}}" method="POST">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <div class="todolist_list showactions px-3">
                                                        <div class="row">
                                                            <div class="col-9 nopad custom_textbox1"> 
                                                                <div class="todo_mintbadge todo_mintbadge"> </div> 
                                                                
                                                                <div class="todotext todoitem">{{$listagemAfazeres[$c]->texto}}</div>
                                                            </div>
                                                            <div class="col-3 showbtns todoitembtns" style=""> 
                                                                <a href="#" id="salvaAfazer" onclick="document.getElementById('atualizaAfazer{{$listagemAfazeres[$c]->id}}').submit();" class="todoedit margemDir">
                                                                    
                                                                </a>
                                                                <a id="excluirAfazer" href="removeAfazer/{{$listagemAfazeres[$c]->id}}" class="tododelete redcolor">
                                                                    <span class="fa fa-trash"></span>
                                                                </a>
                                                            </div>
                                                            <span class="seperator"></span>
                                                        </div>
                                                    </div>
                                                </form>
                                                <?php $c++?>
                                                @endforeach
                                        </div>
                                    </div>
                                    <form id="main_input_box" class="form-inline" action="insereAfazer" method="POST">
                                        <div class="input-group todo" id="custom_textbox">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input name="texto" type="text" required="" placeholder="Digite e aperte Enter" class="input-md form-control"  maxlength="254" size="75">
                                        </div>
                                    </form>
                                </div>
                                <div class="mycontent">
                                    <div class="border_color bg-danger border_danger" data-color="btn-danger" data-badge="bg-danger"></div>
                                    <div class="border_color bg-primary border_primary" data-color="btn-primary" data-badge="bg-primary"></div>
                                    <div class="border_color bg-info border_info" data-color="btn-info" data-badge="bg-info"></div>
                                    <div class="border_color bg-mint border_mint" data-color="btn-mint" data-badge="bg-mint"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-12">
                        <div class="block widget-notes">
                            <div class="card" >
                                <form id='atualizaNota' action="salvaNotas" method="POST">
                                    <div class="card-header bg-white">
                                        Notas <span id="salvarNotas" onclick="document.getElementById('atualizaNota').submit();" title="Salvar Notas" class='fa fa-check divdireita'></span>
                                    </div>
                                    
                                    <div class="content" id="mostraNotas">
                                        <div id="salvandoNotas" style="background: url('{{asset('assets/img/loader.gif')}}') no-repeat center; height: 265px; display: none;"></div>
                                        <div contenteditable="true">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <textarea name='notas' class="notes col-12" style="border-top:1px solid #ffffff; border-bottom:1px solid #ffffff; border-left:1px solid #ffffff; border-right:1px solid #ffffff; height: 262px;" contenteditable="true">{{$notas[0]->notas}}</textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-12">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="m-t-5 header_align" style="background-color: #a9a9a9; color: #fff">
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <div class="row">
                                        <div class="col-12" style="font-size: 20px;">
                                            <span class="current-date float-left margemEsq"></span><span class="time float-left margemEsq2" id="time"></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                          
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->

    <!-- /#content -->
@stop
@section('footer_scripts')

    <script type="text/javascript" src="{{asset('assets/vendors/slimscroll/js/jquery.slimscroll.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/grafico-sexo.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/raphael/js/raphael-min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/d3/js/d3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/c3/js/c3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/toastr/js/toastr.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/switchery/js/switchery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.resize.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.stack.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.time.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/flotspline/js/jquery.flot.spline.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.categories.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.pie.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/jquery_newsTicker/js/newsTicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/countUp.js/js/countUp.min.js')}}"></script>
    <!--end of plugin scripts
    <script type="text/javascript" src="{{asset('assets/js/pages/new_dashboard.js')}}"></script> -->
    <script type="text/javascript" src="{{asset('assets/vendors/moment/js/moment.min.js')}}"></script>
    <script type="text/javascript">
        
    $(document).ready(function(){
        carregaQuadradinhos();
        acoesRecentesUsuarios();
        totalMedicos();     
        carregaCalendario();
        carregaSexos();
        totalCursos();
        carregaGraficoIdade();
        top10();
    });

    setInterval('carregaQuadradinhos()', 10000);

    setInterval('acoesRecentesUsuarios()', 10000);
    
    setInterval('carregaCalendario()', 45000);

    setInterval('totalMedicos()', 30000);
    
    setInterval('carregaSexos()', 45000);

    setInterval('carregaGraficoIdade()', 45000);

    setInterval('top10()', 30000);
   

   


    

    //CARREGA VOLUME DE ACESSOS
    function carregaCalendario()
    {
        $.ajax({
        type: 'GET',
        url: "volumeacessos",
        success: function(dados){
            
            $.plot("#area-chart", [{
                data: dados,
                label: "Acessos/2019",
                color: "#ee268f"
            }], 
            {
                series: {
                    lines: {
                        show: !0,
                        fill: .8,
                        fillColor: { colors: [{ opacity: 0.0 }, { opacity: 0.6}] }
                    },
                    points: {
                        show: !0,
                        radius: 3
                    }
                },
                grid: {
                    borderColor: "#fff",
                    borderWidth: 1,
                    hoverable: !0
                },
                tooltip: true,
                tooltipOpts: {
                    content: "%y",
                    defaultTheme: true
                },
                xaxis: {
                    tickColor: "#ee268f",
                    mode: "categories"
                },
                yaxis: {
                    tickColor: "#eff"
                },
                shadowSize: 0
                });
            }
        });            
    }

    function carregaQuadradinhos(){
        //Carregando os quadradinhos:
        $.ajax({
            type: 'GET',
            url: "carregaquadradinhos",
            success: function(data) {
                //ANIMACAO DOS NUMEROS DOS QUADROS COLORIDOS E BARRA DE PROGRESSO DA PONTUACAO
                var opcoes = {
                    useEasing: true,
                    useGrouping: true,
                    separator: ',',
                    decimal: '.',
                    prefix: '',
                    suffix: ''
                };
                new CountUp("spinsDisponibilizados", 0, (data[0][0].qtde_spins), 0, 2.5, opcoes).start();
                new CountUp("spinsRealizados", 0, data[1][0].spins_realizados, 0, 2.5, opcoes).start();
                new CountUp("totalMedicos", 0, data[2][0].total_participantes, 0, 2.5, opcoes).start();
                new CountUp("totalCuponsResgatados", 0, data[3][0].total_cupons_resgatados, 0, 2.5, opcoes).start();

                $('#totalJogadasMinuto').html(data[5][0].totalJogadasMinuto);

                //Barras de Progresso:
                //1 Ponto
                let porcentagem = 0;
                porcentagem = (( data[4][0].premio10 * 100 ) / 41);
                $('#ponto1').html(data[4][0].premio10 + '/41');
                $('#ponto1Progress').css({'width': porcentagem+'%', 'aria-valuenow': porcentagem});
                //2 Pontos
                porcentagem = (( data[4][0].premio50 * 100 ) / 417 );
                $('#ponto2').html(data[4][0].premio50 + '/417');
                $('#ponto2Progress').css({'width': porcentagem+'%', 'aria-valuenow': porcentagem});
                //3 Pontos
                porcentagem = (( data[4][0].premio100 * 100 ) / 833 );
                $('#ponto3').html(data[4][0].premio100 + '/833');
                $('#ponto3Progress').css({'width': porcentagem+'%', 'aria-valuenow': porcentagem});
                //5 Pontos
                porcentagem = (( data[4][0].premio200 * 100 ) / 3333 );
                $('#ponto5').html(data[4][0].premio200 + '/3333');
                $('#ponto5Progress').css({'width': porcentagem+'%', 'aria-valuenow': porcentagem});
                //10 Pontos
                porcentagem = (( data[4][0].premio500 * 100 ) / 8333 );
                $('#ponto10').html(data[4][0].premio500 + '/8333');
                $('#ponto10Progress').css({'width': porcentagem+'%', 'aria-valuenow': porcentagem});
                //Compartilhamentos:
                $('#compartilhamento').html(data[4][0].compartilhamentos_publicacoes);
            }
        });
    }
    
    
    //Formatando numeros para R$
    function formatReal( n, c, d, t )
    {

        c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    }

    // Formatando numeros para milhar
    function formatMilhar(n){
        var n = ''+n, t = n.length -1, novo = '';

        for( var i = t, a = 1; i >=0; i--, a++ ){
            var ponto = a % 3 == 0 && i > 0 ? '.' : '';
            novo = ponto + n.charAt(i) + novo;
        }
        return novo;
    }
    //Numeros do Total de Participantes e dia/semana/mes
    function totalMedicos(){
        $.ajax({
            type: 'GET',
            url: "totalmedicos",
            success: function(data) {
                //console.log(data);
                $('#totalMedicos').html(formatMilhar(data[0][0].totalMedicos));
                $('#novosMedicosDia').html(formatMilhar(data[1][0].novosMedicosDia));
                $('#novosMedicosSemana').html(formatMilhar(data[2][0].novosMedicosSemana));
                $('#novosMedicosMes').html(formatMilhar(data[3][0].novosMedicosMes));
                $('#faturamentoDia').html(formatReal(data[7][0].faturamentoDia));
            }
        });
    }

        //Total de Adesão aos Cursos (Dia / Semana / Mês)
        function totalCursos(){
        $.ajax({
            type: 'GET',
            url: "totalcursos",
            success: function(data) {
                //console.log(data);
                $('#totalcursosDia').html(formatMilhar(data[0][0].adesaoCursosDia));
                $('#adesaoCursosSemana').html(formatMilhar(data[1][0].adesaoCursosSemana));
                $('#adesaoCursosMes').html(formatMilhar(data[2][0].adesaoCursosMes));
            }
        });
    }

    //Total de Adesão aos Cursos (Dia / Semana / Mês)
    function top10(){
        //Carregando o TOP10 Promocoes Aderidas:
        $.ajax({
            type: 'GET',
            url: "top10",
            success: function(data) {
                            
                let total = 0;
                //somando a quantidade de adesoes total             
                for (var i = 0; i <= data.length - 1; i++) {
                    total += data[i].total;
                }

                let porcentagem = 0;
                //montando o layout
                for (var i = 0; i <= data.length - 1; i++) {
                    //calculando a Porcentagem:
                    porcentagem = (( data[i].total * 100 ) / total ).toFixed(2);
                    
                    $('#topPromocao'+i).html('<a href="#'+data[i].ID+'" class="text-info">'+data[i].curso+'</a>');
                    $('#topPromocao'+i+'Progress').css({'width': porcentagem+'%', 'aria-valuenow': porcentagem});
                    $('#totalTop10_'+i).html('<a href="#'+data[i].ID+'" class="text-info">'+data[i].alunos+'</a>');
                    $('#porcentagemTop10_'+i).html(porcentagem+'%');
                }
            }
        });
    }


    function carregaGraficoIdade()
    {
        $.ajax({
            type: 'GET',
            url: "faixaetaria",
            success: function(dados) { 
                let Idade = [0,0,0,0,0]; // Array que vai armazenar os totais das Idades

                for (let i = 0; i < dados[0].length; i++) {
                    if (dados[0][i].Idade >= 20 && dados[0][i].Idade < 30) {
                        Idade[0] +=1;
                    }else if(dados[0][i].Idade >= 31 && dados[0][i].Idade < 40){
                        Idade[1] +=1;
                    }else if(dados[0][i].Idade >= 41 && dados[0][i].Idade < 50){
                        Idade[2] +=1;
                    }else if(dados[0][i].Idade >= 51 && dados[0][i].Idade < 60){
                        Idade[3] +=1;
                    }else if(dados[0][i].Idade > 60){
                        Idade[4] +=1;
                    }
                }

                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart(Idade));

                function drawChart(dados) {

                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hours per Day'],
                        ['20 - 30 anos',dados[0]],
                        ['31 - 40 anos',dados[1]],
                        ['41 - 50 anos',dados[2]],
                        ['51 - 60 anos',dados[3]],
                        ['acima de 60 anos', dados[4]]
                    ]);

                    var chart = new google.visualization.PieChart(document.getElementById('faixaetaria'));

                    chart.draw(data);
                }
            }
        });
    }

    function carregaSexos(){
        //Grafico de Sexos
        $.ajax({
            type: 'GET',
            url: "genero",
            success: function(dados) {

                // -- GRAFICO DONUT -- //
                google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['Homens',     parseInt(dados[0][0].generoM)],
                    ['Mulheres',   parseInt(dados[1][0].generoF)]
                    ]);

                    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                    chart.draw(data);
                }
            }
        });
    }

    //Acoes dos Usuarios
    function acoesRecentesUsuarios(){
        $.ajax({
            type: 'GET',
            url: "acoesrecentesusuarios",
            success: function(data) {
                for (i = 0; i <= 3 ; i++) {
                    let dataAtual = new Date(data[i].created_at);
                    let dia = dataAtual.getDate();
                    let mes = dataAtual.getMonth()+1;
                    let ano = dataAtual.getFullYear();
                    let hora = dataAtual.getHours();
                    let minuto = dataAtual.getMinutes();
                    let segundo = dataAtual.getSeconds();
                    let horaImprimivel = hora + ":" + minuto + ":" + segundo;

                    if (dia.toString().length == 1){
                      dia = "0"+dia;
                    }
                    if (mes.toString().length == 1){
                      mes = "0"+mes;
                    }
                    if (hora.toString().length == 1){
                      hora = "0"+hora;
                    }
                    if (minuto.toString().length == 1){
                      minuto = "0"+minuto;
                    }
                    if (segundo.toString().length == 1){
                      segundo = "0"+segundo;
                    }
                    let dataFinal = dia +'/'+mes+'/'+ano+' '+hora+':'+minuto+':'+segundo;
                    let dir = "{{asset('assets/img/foto_perfil/')}}";
                    $('#linkPerfilAcao'+i).attr("href", "usuarios/perfilusuario/" + data[i].id_usuario);
                    $('#nomeUsuarioAcao'+i).html(data[i].nome);
                    $('#dataAcao'+i).html(dataFinal);
                    $('#linkAcao'+i).attr("href", data[i].link);
                    $('#acao'+i).html(data[i].acao);
                    $('#imagemAcao'+i).attr("src", dir+'/'+data[i].foto);
                }               
            }
        });
    }
    //Fim - Funcoes de carregamento Ajax
    
    $(".todo_section").on('dblclick',".todotext", function(e) { //duplo clique no item da listagem:
        let editButton = " <a href='#' class='todoedit'><span class='fa fa-pencil'></span></a>";
        e.preventDefault();
        $(this).closest('.todolist_list').find('.striked').toggle();
        if ($(this).text() == " ") {
            $(this).closest('.todolist_list').find(".showbtns").toggleClass("opacityfull");
            let text1 = $(this).closest('.todolist_list').find("input[type='text'][name='text']").val().trim();
            if (text1 === '') {
                alert('Come on! you can\'t create a todo without title');
                $(this).closest('.todolist_list').find("input[type='text'][name='text']").focus();
                $(this).closest('.todolist_list').find(".striked").hide();
                return;
            }
            $(this).closest('.todolist_list').find('.todotext').html(text1);
            $(this).html("<span class='fa fa-pencil'></span>");
            $(this).closest('.todolist_list').find(".showbtns").toggleClass("opacityfull");
            return;
        }
        let text = '';
        text = $(this).closest('.todolist_list').find('.todotext').text();
        text = "<input type='text' name='afazerAtualizado' id='afazerAtualizado' value='" + text + "' onkeypress='return event.keyCode != 13;' />";
        $(this).closest('.todolist_list').find('.todoedit').html("<span class='fa fa-check'></span> ");
        $(this).html(text);
        text = '';
        return;
    });

    $().on('dblclick',".todoedit", function(e) {
        let editButton = " <a href='#' class='todoedit'><span class='fa fa-pencil'></span></a>";
        e.preventDefault();
        $(this).closest('.todolist_list').find('.striked').toggle();
        if ($(this).text() == " ") {
            $(this).closest('.todolist_list').find(".showbtns").toggleClass("opacityfull");
            let text1 = $(this).closest('.todolist_list').find("input[type='text'][name='text']").val().trim();
            if (text1 === '') {
                alert('Come on! you can\'t create a todo without title');
                $(this).closest('.todolist_list').find("input[type='text'][name='text']").focus();
                $(this).closest('.todolist_list').find(".striked").hide();
                return;
            }
            $(this).closest('.todolist_list').find('.todotext').html(text1);
            $(this).html("");
            $(this).closest('.todolist_list').find(".showbtns").toggleClass("opacityfull");
            return;
        }
        let text = '';
        text = $(this).closest('.todolist_list').find('.todotext').text();
        text = "<input type='text' name='text' value='" + text + "' onkeypress='return event.keyCode != 13;' />";
        $(this).closest('.todolist_list').find('.todotext').html(text);
        /*$(this).html("<span class='fa fa-check'></span> "); */
        text = '';
        return;
    });

    // -- GIF SALVANDO -- //
    //Na tela Afazeres:
    $('#salvaAfazer, #excluirAfazer').click(function(){
        $('#salvandoAfazeres, #formListaAfazeres').css('display','block');
        $('#custom_textbox').children().css('pointer-events','none');
        $('#custom_textbox').children().css('opacity',0.5);
        $('#custom_textbox').children().css('background','#CCC');
    });
    $("form#main_input_box").submit(function(event) {
        $('#salvandoAfazeres, #formListaAfazeres').css('display','block');
        $('#custom_textbox').children().css('pointer-events','none');
        $('#custom_textbox').children().css('opacity',0.5);
        $('#custom_textbox').children().css('background','#CCC');
    });



    //Hora atual no rodape
    let datetime = null, time = null, date = null;

    let update = function () {
        date = moment(new Date());
        datetime.html(date.format('DD MMMM YYYY - dddd'));
        time.html(date.format('H:mm:ss'));
    };

    if($('.current-date')[0] && $('.time')[0]) {
        datetime = $('.current-date');
        time = $('#time');

        update();
        setInterval(update, 1000);
    }

    /* Mensagem de bem vindo */

    var i = -1;
    var toastCount = 0;
    var $toastlast;

    var shortCutFunction = "success";
    var msg = "{{Request::session()->get('nome')}}";
    var title = "<span>Bem-vindo!</span>";
    var $showDuration = 1000;
    var $hideDuration = 1000;
    var $timeOut = 5000;
    var $extendedTimeOut = 1000;
    var $showEasing = "swing";
    var $hideEasing = "linear";
    var $showMethod = "fadeIn";
    var $hideMethod = "fadeOut";
    var toastIndex = toastCount++;
    toastr.options = {
        closeButton: $('#closeButton').prop('checked'),
        debug: $('#debugInfo').prop('checked'),
        positionClass: 'toast-top-right',
        onclick: null
    };
    if ($showDuration.length) {
        toastr.options.showDuration = $showDuration;
    }
    if ($hideDuration.length) {
        toastr.options.hideDuration = $hideDuration;
    }
    if ($timeOut.length) {
        toastr.options.timeOut = $timeOut;
    }
    if ($extendedTimeOut.length) {
        toastr.options.extendedTimeOut = $extendedTimeOut;
    }
    if ($showEasing.length) {
        toastr.options.showEasing = $showEasing;
    }
    if ($hideEasing.length) {
        toastr.options.hideEasing = $hideEasing;
    }
    if ($showMethod.length) {
        toastr.options.showMethod = $showMethod;
    }
    if ($hideMethod.length) {
        toastr.options.hideMethod = $hideMethod; 
    }
    if ("{{Request::session()->get('acesso')}}" == 1) {

        $("#toastrOptions").text("Command: toastr[" + shortCutFunction + "](\"" + msg + (title ? "\", \"" + title : '') + "\")\n\ntoastr.options = " + JSON.stringify(toastr.options, null, 2));
        var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
        $toastlast = $toast;
        <?php Request::session() ->put('acesso',0)?>
    }

</script>
@stop
