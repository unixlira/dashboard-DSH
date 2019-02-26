@extends(('layouts/default'))
{{-- Page title --}}
@section('title')
    View User
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!--Plugin css-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/fullcalendar/css/fullcalendar.min.css')}}"/>
    <!--End off plugin css-->
    <!--Page level css-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/timeline2.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/calendar_custom.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/profile.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/gallery.css')}}"/>


    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/select2/css/select2.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/datatables/css/scroller.bootstrap.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/datatables/css/colReorder.bootstrap.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/datatables/css/dataTables.bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.dataTables.css')}}">
    <!--End of plugin styles-->
    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/tables.css')}}"/>
    <!--end of page level css-->
@stop
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-file-text-o"></i>
                        Perfil do Usuário
                    </h4>
                </div>
                <div class="col-lg-6" style="color:#fff">
                    <ol class="breadcrumb float-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i>
                                Página Inicial
                            
                        </li>
                        <li class="breadcrumb-item">
                            Usuários
                        </li>
                        <li class="active breadcrumb-item">Perfil do Usuário</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
<div class="outer">
    <div class="inner bg-container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    
                    <div class="col-lg-6 m-t-35">
                        <div class="text-center">
                            <div class="form-group">
                               <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumb_zoom zoom admin_img_width">
                                        <img src="{{asset('assets/img/foto_perfil/'.$usuario->foto)}}" alt="admin" class="admin_img_width"></div>
                                    <div class="fileinput-preview fileinput-exists thumb_zoom zoom admin_img_width"></div>
                                    <div class="btn_file_position">
                                        <?php
                                            $url = explode('/', (Request::url()));
                                            $link = $url[5]; //pegando o parametro passado na URL localhost
                                            //$link = $url[7]; //pegando o parametro passado na URL no server   
                                        ?>
                                        @if((Request::session()->get('id_usuario') == $link)|| Request::session()->get('permissao') == 1)
                                        <a href="{{ URL::to('usuarios/editarusuario/'.$link) }}" class="btn btn-info" style="background-color: #ee268f !important;border: 1px solid #ee268f;">Editar Informações</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-lg-6 m-t-15">
                        <div>
                            <ul class="nav nav-inline view_user_nav_padding">
                                <li class="nav-item card_nav_hover">
                                    <a class="nav-link active" href="#user" id="home-tab"
                                       data-toggle="tab" aria-expanded="true">Detalhes</a>
                                </li>
                            </ul>
                            <div id="clothing-nav-content" class="tab-content m-t-10">
                                <div role="tabpanel" class="tab-pane fade show active" id="user">
                                    <table class="table" id="users">
                                        <tr>
                                            <td>Nome do Usuário</td>
                                            <td>{{$usuario->nome}}</td>
                                        </tr>
                                        <tr>
                                            <td>E-mail</td>
                                            <td>{{$usuario->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Telefone</td>
                                            <td>{{$usuario->telefone}}</td>
                                        </tr>
                                        <tr>
                                            <td>Endereço</td>
                                            <td>{{$usuario->endereco}}</td>
                                        </tr>
                                        <tr>
                                            <td>Cidade</td>
                                            <td>{{$usuario->cidade}}</td>
                                        </tr>
                                        <tr>
                                            <td>Criado em</td>
                                            <td>{{ date( 'd/m/Y H:i:s' , strtotime($usuario->created_at))}}</td>
                                        </tr>
                                        <tr>
                                            <td>Permissão</td>
                                            <td>@if($usuario->permissao == 0)
                                                    Somente Visualizar
                                                @elseif($usuario->permissao == 1)
                                                    Editar / Visualizar
                                                @else
                                                    Resetar Senha
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ativo</td>
                                            <td>{{($usuario->ativo == 0 ? 'Não' : 'Sim')}}</td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-toolbar">
                    <div class="table-toolbar">
                        <div class="btn-group">
                           
                        </div>
                        <div class="btn-group float-left users_grid_tools">
                            <div class="tools"></div>
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <table class="table  table-striped table-bordered table-hover dataTable no-footer textoEsquerda" id="teste" role="grid">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc wid-20" tabindex="0" rowspan="1" colspan="1">Nº</th>
                                <th class="sorting_asc wid-20" tabindex="0" rowspan="1" colspan="1">Ação</th>
                                <th class="sorting wid-25" tabindex="0" rowspan="1" colspan="1">Data e Hora</th>
                                <th class="sorting wid-15" tabindex="0" rowspan="1" colspan="1"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- /.inner -->
@stop
@section('footer_scripts')
    <!--Plugin scripts-->
    <script type="text/javascript" src="{{asset('assets/vendors/slimscroll/js/jquery.slimscroll.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/bootstrap_calendar/js/bootstrap_calendar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/moment/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/fullcalendar/js/fullcalendar.min.js')}}"></script>

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

    <!--End of Plugin scripts-->
    <!--Page level scripts-->
    <script type="text/javascript" src="{{asset('assets/js/pages/mini_calendar.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/pages/users.js')}}"></script>
    <!--End of Page level scripts-->
    <script type="text/javascript">
var TableAdvanced = function() {
    // ===============table 1====================
    var initTable1 = function() {
        var table = $('#teste');
        /* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */
        /* Set tabletools buttons and button container */
        table.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('datatable.getacoes', $usuario->id) }}",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'acao', name: 'acao'},
                {data: 'created_at', name: 'created_at', "render": function ( data, type, row, meta )
                    {
                            var dataAtual = new Date(data);
                            var dia = dataAtual.getDate();
                            var mes = dataAtual.getMonth()+1;
                            var ano = dataAtual.getFullYear();
                            var hora = dataAtual.getHours();
                            var minuto = dataAtual.getMinutes();
                            var segundo = dataAtual.getSeconds();

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
                            
                            return dia +'/'+mes+'/'+ano+' '+hora+':'+minuto+':'+segundo;
                            //return dataAtual;
                    }
                },
                {data: 'link', "render": function ( data, type, row, meta )
                    {
                      return '<a href="../../'+data+'" data-toggle="tooltip" data-placement="top" title="Visualizar" class="margemDir"><i class="fa fa-eye text-success"></i></a>';
                    }
                }
            ],
            dom: "Bflr<'table-responsive't><'row'<'col-md-5 col-12'i><'col-md-7 col-12'p>>",
            buttons: [
                {
                extend: 'copy',
                text: 'Copiar',
            },
           'csv',
           {
               extend: 'print',
               text: 'Imprimir',
           }
            ],
            "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Mostrar _MENU_ entradas",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Buscar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });

        var tableWrapper = $('#sample_1_wrapper'); // datatable creates the table wrapper by adding with id {your_table_id}_wrapper
        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown


    }
    // ===============table 1===============
    return {
        //main function to initiate the module
        init: function() {
            if (!jQuery().dataTable) {
                return;
            }
            initTable1();
        }
    };
}();      
    </script>
@stop