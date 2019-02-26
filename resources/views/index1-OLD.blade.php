@extends(('layouts/default'))
{{-- Page title --}}
@section('title')
    Dashboard-1
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/c3/css/c3.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/toastr/css/toastr.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/switchery/css/switchery.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/new_dashboard.css')}}"/>
    <link href="{{asset('assets/css/pages/flot_charts.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/widgets.css')}}">
@stop
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-6">
                    <h4 class="m-t-5">
                        <i class="fa fa-home"></i>
                        Página Inicial
                    </h4>
                </div>
            </div>
        </div>
    </header>
<div class="outer">
    <div class="inner bg-container">
        <div class="row">
            <div class="col-xl-6 col-lg-7 col-12">
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="bg-disponibilizados top_cards">
                            <div class="row icon_margin_left">

                                <div class="col-lg-4 col-4 icon_padd_left">
                                    <div class="float-left">
                                        <span class="fa-stack fa-sm">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-refresh fa-stack-1x fa-inverse text-disponibilizados sales_hover"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-8 icon_padd_right">
                                    <div class="float-right cards_content" align="right">
                                        <span class="number_val" id="spinsDisponibilizados">0</span>
                                        <i class="fa fa-long-arrow-up fa-2x"></i>
                                        <br/>
                                        <span class="card_description">Total de Spins Disponibilizados</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="bg-spins top_cards">
                            <div class="row icon_margin_left">
                                <div class="col-lg-5  col-5 icon_padd_left">
                                    <div class="float-left">
                                        <span class="fa-stack fa-sm">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-circle-o-notch fa-stack-1x fa-inverse text-spins visit_icon"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-7 icon_padd_right">
                                    <div class="float-right cards_content" align="right">
                                        <span class="number_val" id="spinsRealizados">0</span><i
                                            class="fa fa-long-arrow-up fa-2x"></i>
                                        <br/>
                                        <span class="card_description">Total de Spins Realizados</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="bg-participantes top_cards">
                            <div class="row icon_margin_left">
                                <div class="col-lg-5 col-5 icon_padd_left">
                                    <div class="float-left">
                                        <span class="fa-stack fa-sm">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-users fa-stack-1x fa-inverse text-participantes revenue_icon"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-7 icon_padd_right">
                                    <div class="float-right cards_content" align="right">
                                        <span class="number_val" id="totalParticipantes">0</span><i
                                            class="fa fa-long-arrow-up fa-2x"></i>
                                        <br/>
                                        <span class="card_description">Total de Participantes</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="bg-danger top_cards">
                            <div class="row icon_margin_left">
                                <div class="col-lg-5 col-5 icon_padd_left">
                                    <div class="float-left">
                                        <span class="fa-stack fa-sm">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-bookmark-o  fa-stack-1x fa-inverse text-danger  sub"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-7 icon_padd_right">
                                    <div class="float-right cards_content" align="right">
                                        <span class="number_val" id="totalCuponsResgatados">0</span><i
                                            class="fa fa-long-arrow-down fa-2x"></i>
                                        <br/>
                                        <span class="card_description">Cupons Resgatados</span>
                                        <br />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-5 col-12 stat_align">
                <div class="table-responsive m-t-25">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="tituloTabelaCentro"><i class="fa fa-money fa-index"></i></th>
                            <th class="tituloTabelaCentro">Qtde Cupons<br />Emitidos</th>
                            <th class="tituloTabelaCentro">Qtde Cupons<br />Resgatados</th>
                            <th class="tituloTabelaCentro">Qtde Cupons<br />A Resgatar</th>
                            <th class="tituloTabelaCentro">Qtde Cupons<br />em Estoque</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>R$ 10</td>
                            <td>40000</td>
                            <td><div id="cupons10">0</div></td>
                            <td><div id="cuponsResg10">0</div></td>
                            <td><div id="totalResg10">0</div></td>
                        </tr>
                        <tr>
                            <td>R$ 50</td>
                            <td>4000</td>
                            <td><div id="cupons50">0</div></td>
                            <td><div id="cuponsResg50">0</div></td>
                            <td><div id="totalResg50">0</div></td>
                        </tr>
                        <tr>
                            <td>R$ 100</td>
                            <td>2000</td>
                            <td><div id="cupons100">0</div></td>
                            <td><div id="cuponsResg100">0</div></td>
                            <td><div id="totalResg100">0</div></td>
                        </tr>
                        <tr>
                            <td>R$ 200</td>
                            <td>500</td>
                            <td><div id="cupons200">0</div></td>
                            <td><div id="cuponsResg200">0</div></td>
                            <td><div id="totalResg200">0</div></td>
                        </tr><tr>
                            <td>R$ 500</td>
                            <td>200</td>
                            <td><div id="cupons500">0</div></td>
                            <td><div id="cuponsResg500">0</div></td>
                            <td><div id="totalResg500">0</div></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-12 m-t-15">
                <div class="card">
                    <ul id="clothing-nav" class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#home" id="home-tab" role="tab"
                               data-toggle="tab" aria-controls="home" aria-expanded="true">Prêmios Pagos (R$)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#hats" role="tab" id="hats-tab" data-toggle="tab"
                               aria-controls="hats">Valor (K) vs. Data</a>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div id="clothing-nav-content" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="home"
                                 aria-labelledby="home-tab">
                                <div id="area-chart" class="flotChart3"></div>
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
            <div class="col-lg-3 col-12 m-t-15 md_align_section">
                <div class="card">
                    <div class="card-header bg-white">Contador (Spins): <strong><span id="totalSpinsDisponibilizados">0</span></strong>
                    </div>
                    <div class="card-header bg-white">Total Cupons Liberados: <strong><span id="totalCuponsDisponibilizados">0</span></strong>
                    </div>
                    <div class="card-body p-0">
                        <div class="task-item">
                            R$ 10
                            <span class="float-right text-muted progress-info" id="premio10">0/25</span>
                            <div id="progress-bar">
                                <!--<progress class="progress progress-danger" value="52"-->
                                <!--max="100"></progress>-->
                                <div class="progress">
                                    <div id="premio10Progress" class="progress-bar bg-danger" role="progressbar"
                                         style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="task-item">

                            R$ 50
                            <span class="float-right text-muted progress-info" id="premio50">0/250</span>
                            <div id="progress-bar">
                                <!--<progress class="progress progress-danger" value="52"-->
                                <!--max="100"></progress>-->
                                <div class="progress">
                                    <div id="premio50Progress" class="progress-bar bg-success" role="progressbar"
                                         style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="task-item">

                            R$ 100
                            <span class="float-right text-muted progress-info" id="premio100">0/500</span>
                            <div id="progress-bar">
                                <!--<progress class="progress progress-danger" value="52"-->
                                <!--max="100"></progress>-->
                                <div class="progress">
                                    <div id="premio100Progress" class="progress-bar bg-warning" role="progressbar"
                                         style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="task-item">

                            R$ 200
                            <span class="float-right text-muted progress-info" id="premio200">0/2000</span>
                            <div id="progress-bar">
                                <!--<progress class="progress progress-danger" value="52"-->
                                <!--max="100"></progress>-->
                                <div class="progress">
                                    <div id="premio200Progress" class="progress-bar bg-info" role="progressbar"
                                         style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="task-item">

                            R$ 500
                            <span class="float-right text-muted progress-info" id="premio500">0/5000</span>
                            <div id="progress-bar">
                                <!--<progress class="progress progress-danger" value="52"-->
                                <!--max="100"></progress>-->
                                <div class="progress">
                                    <div id="premio500Progress" class="progress-bar bg-primary" role="progressbar"
                                         style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-12 m-t-35">
                <div class="card">
                    <div class="card-header bg-white">
                        Gênero dos Participantes
                    </div>
                    <div class="card-block">
                        <div id="piechart" class="flotChart3"></div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-12 m-t-35">
                <div class="card">
                    <div class="card-header bg-white">Total de Participantes Cadastrados no App</div>
                    <div class="card-header bg-white"><strong><h1><span id="totalParticipantesApp">0</span></h1><div class="margemBaixo"></div></strong></div>
                </div>
                <div class="card m-t-35">
                    <div class="card-header bg-white">Novos Participantes (Dia/Semana/Mês)</div>
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col-md-4 ">
                                <strong><h2><span id="participantesDia">0</span></h2></strong><br />Diário
                            </div>
                            <div class="col-md-4 ">
                                <strong><h2><span id="participantesSemana">0</span></h2></strong><br />Semanal
                            </div>
                            <div class="col-md-4 ">
                                <strong><h2><span id="participantesMes">0</span></h2></strong><br />Mensal
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12 m-t-35">
                <div class="card">
                    <div class="card-header bg-white">
                        Quantidade de Spins Liberados VS Notas Fiscais 
                    </div>
                    <div class="card-block m-t-35">
                        <div id="basicFlotLegend2" class="flotLegend"></div>
                        <div id="bar-chart" class="flotChart1" style="padding: 0px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-12 m-t-35">
                <div class="card">
                    <div class="card-header bg-white">
                        <div class=" twitter_section_head">
                            Atividades Recentes
                        </div>
                    </div>
                    <div class="card-block twitter_section">
                        <ul id="nt-example1" style="height: 265px; overflow: hidden;">
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

            <div class="col-lg-8 col-12">
                <div class="row">
                    <div class="col-lg-7 col-12 m-t-35">
                        <div class="card to_do">
                            <div class="card-header bg-white">
                                Lista de Afazeres
                            </div>
                            <div class="card-block no-padding to_do_section">
                                <div class="">
                                    <div class="" style="position: relative; overflow: hidden; width: auto; height: 213px;">
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
                    <div class="col-lg-5 col-12 m-t-35">
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
                                            <textarea name='notas' class="notes" style="border-top:1px solid #ffffff; border-bottom:1px solid #ffffff; border-left:1px solid #ffffff; border-right:1px solid #ffffff; height: 265px; width: 420px; " contenteditable="true">{{$notas[0]->notas}}</textarea>
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
                        <div class="bg-warning m-t-15 header_align">
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="current-date float-left"></span><span class="time float-right " id="time"></span>
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
    <!--end of plugin scripts-->
    <script type="text/javascript" src="{{asset('assets/js/pages/new_dashboard.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/moment/js/moment.min.js')}}"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        carregaQuadradinhos();
        acoesRecentesUsuarios();
        carregaCuponsResgatados();
        carregaCalendario();
        carregaGraficoBarras();
        totalParticipantes();
        carregaSexos();
    });
    setInterval('carregaCalendario()', 120000);

    setInterval('carregaQuadradinhos()', 10000);

    setInterval('carregaGraficoBarras()', 30000);

    setInterval('carregaSexos()', 45000);
    
    setInterval('carregaCuponsResgatados()', 20000);
    
    setInterval('totalParticipantes()', 30000);

    setInterval('acoesRecentesUsuarios()', 10000);
    
    //Funcoes de carregamento Ajax
    function carregaCalendario()
    {
        $.ajax({
        type: 'GET',
        url: "carregacalendario",
        success: function(dados){
            var novembro = new Array(dados);
            $.plot("#area-chart", [{
                data: novembro[0][0],
                label: "Novembro/2017",
                color: "#0000CD"
            },{
                data: novembro[0][1],
                label: "Dezembro/2017",
                color: "#FF0000"
             },{
                data: novembro[0][2],
                label: "Janeiro/2018",
                color: "#228B22"
             },{
                data: novembro[0][3],
                label: "Fevereiro/2018",
                color: "#ffa000"
             },{
                data: novembro[0][3],
                label: "Março/2018",
                color: "#EE82EE"
             },{
                data: novembro[0][3],
                label: "Abril/2018",
                color: "#F0E68C"
             }
            ], {
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
                    tickColor: "#eff",
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
                //ANIMACAO DOS NUMEROS DOS QUADROS COLORIDOS
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
                new CountUp("totalParticipantes", 0, data[2][0].total_participantes, 0, 2.5, opcoes).start();
                new CountUp("totalCuponsResgatados", 0, data[3][0].total_cupons_resgatados, 0, 2.5, opcoes).start();
            }
        });
    }
    
    function carregaGraficoBarras(){
        //Carregamento graficos de barras:
        $.ajax({
            type: 'GET',
            url: "carregagraficobarras",
            success: function(data) {
                var d1 = [["1", data[0][0].totalSpin1],["2", data[1][0].totalSpin2],["3", data[2][0].totalSpin3],["4", data[3][0].totalSpin4],["5", data[4][0].totalSpin5],["6", data[5][0].totalSpin6],["7",data[6][0].totalSpin7],["8", data[7][0].totalSpin8],["9", data[8][0].totalSpin9],["10", data[9][0].totalSpin10],["11", data[10][0].totalSpin11],["12", data[11][0].totalSpin12],["13", data[12][0].totalSpin13],["14", data[13][0].totalSpin14],["15", data[14][0].totalSpin15]];
                $.plot("#bar-chart", [{
                    data: d1,
                    label: "Notas Fiscais",
                    color: "#0fb0c0"
                }], {
                    series: {
                        bars: {
                            align: "center",
                            lineWidth: 0,
                            show: !0,
                            barWidth: .6,
                            fill: .9
                        }
                    },
                    grid: {
                        borderColor: "#ddd",
                        borderWidth: 1,
                        hoverable: !0
                    },
                    legend: {
                        container: '#basicFlotLegend2',
                        show: true
                    },
                    tooltip: true,
                    tooltipOpts: {
                        content: '%s: %y'
                    },

                    xaxis: {
                        tickColor: "#ddd",
                        mode: "categories"
                    },
                    yaxis: {
                        tickColor: "#ddd"
                    },
                    shadowSize: 0
                });
            }
        });
    }

    //Carregando grafico de sexos:
    google.charts.load('current', {'packages':['corechart']});
    
    function carregaSexos(){
        $.ajax({
            type: 'GET',
            url: "carregasexos",
            success: function(dados) {
                // -- GRAFICO ROSCA -- //
                google.charts.setOnLoadCallback(drawChart(dados));

                function drawChart(dados) {

                    var data = google.visualization.arrayToDataTable([
                      ['Task', 'Hours per Day'],
                      ['Homem', parseInt(dados[0][0].homens)],
                      ['Mulher', parseInt(dados[1][0].mulheres)]
                    ]);

                    var options = {
                      //title: 'Gênero dos Participantes'
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                    chart.draw(data, options);
                }
            }
        });
    }
    
    //Carregando a Div da barra de contagem de giros dos spins
    function carregaCuponsResgatados(){
        $.ajax({
            type: 'GET',
            url: "carregacuponsresgatados",
            success: function(data) {
                //Tabela Cupons de 10
                $('#cupons10').html(data[1][0].cupons_resgatados10);
                $('#cuponsResg10').html(data[6][0].cupons_resgatar10);
                $('#totalResg10').html((40000 - (parseInt(data[1][0].cupons_resgatados10) + parseInt(data[6][0].cupons_resgatar10))));
                //Tabela Cupons de 50
                $('#cupons50').html(data[2][0].cupons_resgatados50);
                $('#cuponsResg50').html(data[7][0].cupons_resgatar50);
                $('#totalResg50').html((4000 - (parseInt(data[2][0].cupons_resgatados50) + parseInt(data[7][0].cupons_resgatar50))));
                //Tabela Cupons de 100
                $('#cupons100').html(data[3][0].cupons_resgatados100);
                $('#cuponsResg100').html(data[8][0].cupons_resgatar100);
                $('#totalResg100').html((2000 - (parseInt(data[3][0].cupons_resgatados100) + parseInt(data[8][0].cupons_resgatar100))));
                //Tabela Cupons de 200
                $('#cupons200').html(data[4][0].cupons_resgatados200);
                $('#cuponsResg200').html(data[9][0].cupons_resgatar200);
                $('#totalResg200').html((500 - (parseInt(data[4][0].cupons_resgatados200) + parseInt(data[9][0].cupons_resgatar200))));
                //Tabela Cupons de 500
                $('#cupons500').html(data[5][0].cupons_resgatados500);
                $('#cuponsResg500').html(data[10][0].cupons_resgatar500);
                $('#totalResg500').html((200 - (parseInt(data[5][0].cupons_resgatados500) + parseInt(data[10][0].cupons_resgatar500))));
                //Total de Spins Disponibilizados
                $('#totalSpinsDisponibilizados').html(data[0][0].qtde_spins);
                //Total de Cupons Disponibilizados
                $('#totalCuponsDisponibilizados').html(parseInt(data[1][0].cupons_resgatados10) + parseInt(data[6][0].cupons_resgatar10) + parseInt(data[2][0].cupons_resgatados50) + parseInt(data[7][0].cupons_resgatar50) + parseInt(data[3][0].cupons_resgatados100) + parseInt(data[8][0].cupons_resgatar100) + parseInt(data[4][0].cupons_resgatados200) + parseInt(data[9][0].cupons_resgatar200) + parseInt(data[5][0].cupons_resgatados500) + parseInt(data[10][0].cupons_resgatar500));
                //Barras de Progresso:
                //Cupom de 10
                let porcentagem = (( data[11][0].premio10 * 100 ) / 25 );
                $('#premio10').html(data[11][0].premio10 + '/25');
                $('#premio10Progress').css({'width': porcentagem+'%', 'aria-valuenow': porcentagem});
                //Cupom de 50
                porcentagem = (( data[11][0].premio50 * 100 ) / 250 );
                $('#premio50').html(data[11][0].premio50 + '/250');
                $('#premio50Progress').css({'width': porcentagem+'%', 'aria-valuenow': porcentagem});
                //Cupom de 100
                porcentagem = (( data[11][0].premio100 * 100 ) / 500 );
                $('#premio100').html(data[11][0].premio100 + '/500');
                $('#premio100Progress').css({'width': porcentagem+'%', 'aria-valuenow': porcentagem});
                //Cupom de 200
                porcentagem = (( data[11][0].premio200 * 100 ) / 2000 );
                $('#premio200').html(data[11][0].premio200 + '/2000');
                $('#premio200Progress').css({'width': porcentagem+'%', 'aria-valuenow': porcentagem});
                //Cupom de 500
                porcentagem = (( data[11][0].premio500 * 100 ) / 5000 );
                $('#premio500').html(data[11][0].premio500 + '/5000');
                $('#premio500Progress').css({'width': porcentagem+'%', 'aria-valuenow': porcentagem});
            }
        });   
    }

    //Numeros do Total de Participantes e dia/semana/mes
    function totalParticipantes(){
        $.ajax({
            type: 'GET',
            url: "totalparticipantes",
            success: function(data) {
                $('#totalParticipantesApp').html(data[0][0].totalParticipantesApp);
                $('#participantesDia').html(data[1][0].participantesDia);
                $('#participantesSemana').html(data[2][0].participantesSemana);
                $('#participantesMes').html(data[3][0].participantesMes);
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
        /*$(this).html("<span class='fa fa-check'></span> ");*/
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
    //Na tela Notas
    $('#salvarNotas').click(function(){
        $('#salvandoNotas, #mostraNotas').css('display','block');
        $('#salvarNotas').css('visibility','hidden');
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
</script>
@stop
