@extends(('layouts/default'))
{{-- Page title --}}
@section('title')
    Users
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!--Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/select2/css/select2.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/datatables/css/scroller.bootstrap.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/datatables/css/colReorder.bootstrap.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/datatables/css/dataTables.bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.dataTables.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/dataTables.bootstrap.css')}}" />
    <!--End of plugin styles-->
    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/tables.css')}}"/>
    <!-- end of page level styles -->

@stop
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6 col-sm-4">
                    <h4 class="nav_top_align">
                        <i class="fa fa-share-alt fa-flip-horizontal"></i>
                        Relatórios de Performance
                    </h4>
                </div>
                <div class="col-lg-6 col-sm-8 col-12" style="color:#fff !important;">
                    <ol class="breadcrumb float-right  nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <i class="fa fa-home" data-pack="default" data-tags=""></i> Relatórios de Performance
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    

<div class="outer">
    <div class="inner bg-container">
        <div class="card">
            <div class=" col-md-12 row m-t-30">
                <div class="col-md-2">
                <select name="mes" id="mes" class="form-control input-sm"> 
                    <option value="1" >Janeiro</option>
                    <option value="2" >Fevereiro</option>
                    <option value="3" >Março</option>
                    <option value="4" >Abril</option>
                    <option value="5" >Maio</option>
                    <option value="6" >Junho</option>
                    <option value="7" >Julho</option>
                    <option value="8" >Agosto</option>
                    <option value="9" >Setembro</option>
                    <option value="10" >Outubro</option>
                    <option value="11" >Novembro</option>
                    <option value="12" >Dezembro</option>
                    </select>
                </div>
                <div class="col-md-2">
                <select name="ano" id="ano" class="form-control input-sm">
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                </select>
                </div>
                <div class="col-md-2">
                    <input type="button" class="btn btn-success" value="Ver" style="padding:9px;" id="enviar">
                </div>
            </div>
            <div class=" col-md-12 row m-t-30">
                <div class="col-md-10">
                    <h4>Relatório de Performance</h4>
                </div>
                <div class="col-md-2">
                    <a href="http://localhost/dashboard/webservices/csv.php?usr={{Request::session()->get('id_usuario')}}&mes=1&ano=2018" class="margemEsq btn btn-success" id="linkcsv"> Gerar CSV  <i class="fa fa-download"></i></a>
                </div>
            </div>
            <div class="card-body m-t-15" id="user_body">
                <table class="table  table-striped table-bordered table-hover dataTable no-footer textoEsquerda" id="mytab1" role="grid" name="mytab">
                    <thead>
                        <tr role="row">
                            <th>Dia</th>
                            <th>Cadastros</th>
                            <th>Adesão à Cursos</th>
                            <th>Cursos Concluídos</th>
                            <th>Avaliações</th>
                            <th>Comentários</th>
                            <th>Contatos</th>
                        </tr>
                    </thead>
                    <tbody id="linha1">      
                                            
                    </tbody>
                </table>
            </div>

            <div id="test"> </div>
        </div>
    </div>
</div>
@stop
@section('footer_scripts')
    <!--Plugin scripts-->
    <script type="text/javascript" src="{{asset('assets/vendors/select2/js/select2.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/pluginjs/dataTables.tableTools.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.colReorder.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.responsive.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.rowReorder.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.colVis.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.html5.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.print.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.scroller.min.js')}}"></script>
    <!--End of plugin scripts-->
    <!--Page level scripts-->
    <script type="text/javascript" src="{{asset('assets/js/pages/users.js')}}"></script>
<script>

    $(document).ready(function() {
        $('#linha1').html('<td colspan=11 id="carregando" style=\'background: url("{{asset("assets/img/loader.gif")}}") no-repeat center; height: 100px; \'></div>');
        query($('#mes')[0].value, $('#ano')[0].value);
    });

    $('#enviar').click(function(){
        $('#linha1').html('<td colspan=11 id="carregando" style=\'background: url("{{asset("assets/img/loader.gif")}}") no-repeat center; height: 100px; \'></div>');
        query($('#mes')[0].value, $('#ano')[0].value);
    });

    $('#mes').on('change',function(){
        console.info( $('#ano'));
        $("#linkcsv").attr("href", "http://localhost/dashboard/webservices/csv.php?usr={{Request::session()->get('id_usuario')}}&mes="+$('#mes')[0].value+"&ano="+$('#ano')[0].value);
    });

    $('#ano').on('change',function(){
        $("#linkcsv").attr("href", "http://localhost/dashboard/webservices/csv.php?usr={{Request::session()->get('id_usuario')}}&mes="+$('#mes')[0].value+"&ano="+$('#ano')[0].value);
    });

       
    
    function query(mes, ano){
        $.ajax({
            type: 'GET',
            url: "/dataperformance/"+mes+"/"+ano,
            success: function(data) {

                
                let agora = new Date;
                let diasMes = new Date (ano, mes, 0);

                if (agora.getMonth() == (mes) && (agora.getFullYear() == ano)) { 
                    diasMes = agora.getDate();
                }else{ 
                    diasMes = diasMes.getDate();
                }

                let linhas = '';
                for (let i = 0; i < data.length; i++) {
                    linhas += "<tr><td>"+(i+1)+"</td><td>"+data[i].cadastros+"</td><td>"+data[i].cursos+"</td><td>"+data[i].cursosCompletos+"</td><td>"+data[i].avaliacoes+"</td><td>"+data[i].comentarios+"</td><td>"+data[i].contatos+"</td></tr>";
                }

                $('#linha1').html(linhas);
            }
        });
    }




</script>
    <!-- end page level scripts -->
@stop


