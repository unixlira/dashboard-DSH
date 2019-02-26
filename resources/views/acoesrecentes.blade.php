@extends(('layouts/default')){{-- Page title --}}
@section('title')
File Upload
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<!--plugin style-->
<link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/select2/css/select2.min.css')}}" />
<link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/datatables/css/scroller.bootstrap.min.css')}}" />
<link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/datatables/css/colReorder.bootstrap.min.css')}}" />
<link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/datatables/css/dataTables.bootstrap.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.dataTables.css')}}">
<!-- end of plugin styles -->
<!--Page level styles-->
<link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/tables.css')}}" />
<!--End of page level styles-->
@stop


{{-- Page content --}}
@section('content')
<!-- Content Header (Page header) -->
<header class="head">
    <div class="main-bar">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="nav_top_align">
                    <i class="fa fa-pencil-square-o"></i>
                    Acoes Recentes
                </h4>
            </div>
            <div class="col-lg-6">
                <div class="float-right">
                    <ol class="breadcrumb nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <i class="fa fa-home" data-pack="default" data-tags=""></i>
                            Página Inicial
                        </li>
                        <li class="breadcrumb-item active">Acoes Recentes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="outer">
    <div class="inner bg-container">
        <div class="row">
            <div class="col-12 data_tables">
                <div class="card">
                    <div class="card-body m-t-15">
                        <div class="pull-right">                            
                        </div>
                        <table class="table table-striped table-bordered table-hover dataTable no-footer textoEsquerda" id="teste" role="grid">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc wid-10" tabindex="0" rowspan="1" colspan="1">ID</th>
                                    <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Ação</th>
                                    <th class="sorting wid-20" tabindex="0" rowspan="1" colspan="1">Usuário</th>
                                    <th class="sorting wid-20" tabindex="0" rowspan="1" colspan="1">Data</th>
                                    <th class="sorting wid-20" tabindex="0" rowspan="1" colspan="1"></th>
                                    <th class="sorting wid-20" tabindex="0" rowspan="1" colspan="1"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- /.inner -->
</div>
<!-- /.outer -->
<!-- /.content -->
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!--plugin script-->

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
    <script type="text/javascript" src="{{asset('assets/js/pages/users.js')}}"></script>
<!-- end of global scripts-->

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
            "ajax": "{{ route('datatable.getacoesrecentes') }}",
            "columns": [            
                {data: 'id', name: 'id'},
                {data: 'acao', name: 'acao'},
                {data: 'nome', name: 'nome'}, 
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
                {data: 'link', "render": function ( data, type, row, meta )
                    {
                        return '<a href="'+data+'" data-toggle="tooltip" data-placement="top" title="Visualizar Ação" class="margemDir" data-original-title="Visualizar  Ação"><i class="fa fa-eye text-primary"></i></a>';                        
                    }
                },
                {data: 'id_usuario', "render": function ( data, type, row, meta )
                    {
                        return '<a href="usuarios/perfilusuario/'+data+'" data-toggle="tooltip" data-placement="top" title="Usuário" class="margemDir" data-original-title="Usuário"><i class="fa fa-user text-success"></i></a>';                        
                    }
                }
            ],
            dom: "Bflr<'table-responsive't><'row'<'col-md-5 col-12'i><'col-md-7 col-12'p>>",
            buttons: [
                {
                extend: 'copy',
                text: 'Copiar',
            },
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