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
                        <i class="fa fa-user"></i>
                        Lista de Usuários
                    </h4>
                </div>
                <div class="col-lg-6 col-sm-8 col-12" style="color:#fff">
                    <ol class="breadcrumb float-right  nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i> Página Inicial
                            
                        </li>
                        <li class="breadcrumb-item">
                            Usuários
                        </li>
                        <li class="active breadcrumb-item">Lista de Usuários</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
<div class="outer">
    <div class="inner bg-container">
        <div class="card">
            
            <div class="card-body m-t-15" id="user_body">
                <div class="pull-right">
                    
                        <a href="{{ URL::to('usuarios/novousuario') }}" id="editable_table_new" class="btn btn-info">
                            Adicionar Usuário  <i class="fa fa-plus"></i>
                        </a>
                   
                </div>
                <div class="table-toolbar">
                    <div class="btn-group">
                    </div>
                    <div class="btn-group float-right users_grid_tools">
                        <div class="tools"></div>
                    </div>
                </div>
                <div>
                    <div>
                        <table class="table  table-striped table-bordered table-hover dataTable no-footer textoEsquerda" id="teste" role="grid">
                            <thead>
                            <tr role="row">
                                <th class="sorting wid-20" tabindex="0" rowspan="1" colspan="1">Usuário</th>
                                <th class="sorting wid-25" tabindex="0" rowspan="1" colspan="1">E-Mail</th>
                                <th class="sorting wid-20" tabindex="0" rowspan="1" colspan="1">Permissão</th>
                                <th class="sorting wid-20" tabindex="0" rowspan="1" colspan="1">Criado em</th>
                                <th class="sorting wid-15" tabindex="0" rowspan="1" colspan="1">Ações</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- /.inner -->
</div>
    <!-- /.outer -->
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
    <!-- end page level scripts -->
    <script type="text/javascript">
var TableAdvanced = function() {
    // ===============table 1====================
    var initTable1 = function() {
        var table = $('#teste');
        /* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */
        /* Set tabletools buttons and button container */
        table.DataTable({
            "processing": true,
            "ajax": "{{ route('datatable.getusuarios', 1) }}",
            "columns": [
                {data: 'nome', name: 'nome'},
                {data: 'email', name: 'email'},
                {data: 'permissao', name: 'permissao', 'render': function ( data, type, row, meta )
                    {
                        if (data == 0) {
                            return 'Somente Visualizar';
                        }else if (data == 1) {
                            return 'Editar / Visualizar';
                        }else{
                            return 'Resetar Senha';
                        }
                      
                    }
                },
                {data: 'created_at', name: 'created_at', "render": function ( data, type, row, meta )
                    {
                            var dataAtual = new Date(data);
                            var dia = dataAtual.getDate();
                            var mes = dataAtual.getMonth()+1;
                            var ano = dataAtual.getFullYear();
                            var hora = dataAtual.getHours();
                            var minuto = dataAtual.getMinutes();
                            var segundo = dataAtual.getSeconds();
                            var horaImprimivel = hora + ":" + minuto + ":" + segundo;

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
                {data: 'id', "render": function ( data, type, row, meta )
                    {
                        if ("{{Request::session()->get('permissao',1)}}" == 1) {
                            return '<a href="perfilusuario/'+data+'" data-toggle="tooltip" data-placement="top" title="" class="margemDir" data-original-title="Visualizar"><i class="fa fa-eye text-success"></i></a><a class="edit margemDir" data-toggle="tooltip" data-placement="top" title="" href="editarusuario/'+data+'" data-original-title="Editar"><i class="fa fa-pencil text-warning"></i></a><a class="delete hidden-xs hidden-sm" data-toggle="tooltip" data-placement="top" title="" href="bloquearusuario/'+data+'" data-original-title="Bloquear"><i class="fa fa-ban text-danger"></i></a>';
                        }else{
                            return '<a href="perfilusuario/'+data+'" data-toggle="tooltip" data-placement="top" title="" class="margemDir" data-original-title="Visualizar"><i class="fa fa-eye text-success"></i></a>';
                        }
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
