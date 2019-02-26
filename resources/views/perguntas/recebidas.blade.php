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
                    <i class="fa fa-question-circle"></i>
                        Perguntas Recebidas
                    </h4>
                </div>
                <div class="col-lg-6 col-sm-8 col-12" style="color:#fff !important;">
                    <ol class="breadcrumb float-right  nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <i class="fa fa-home" data-pack="default" data-tags=""></i> Perguntas Recebidas
                    </ol>
                </div>
            </div>
        </div>
    </header>
    
<style>
    td {
        text-transform:uppercase
    }
</style>
<div class="outer">
    <div class="inner bg-container">
        <div class="card">
            <div class="col-md-10 m-t-30">
                <h4>Perguntas</h4>
            </div>           
            <div class="card-body m-t-15" id="user_body">
                <table class="table  table-striped table-bordered table-hover dataTable no-footer textoEsquerda" id="teste" role="grid">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc wid-10" tabindex="0" rowspan="1" colspan="1">Pergunta Nº</th>
                            <th class="sorting wid-20" tabindex="0" rowspan="1" colspan="1">Médicos</th>
                            <th class="sorting wid-25" tabindex="0" rowspan="1" colspan="1">CRM</th>
                            <th class="sorting wid-20" tabindex="0" rowspan="1" colspan="1">E-mail</th>
                            <th class="sorting wid-15" tabindex="0" rowspan="1" colspan="1">Pergunta</th>
                            <th class="sorting wid-20" tabindex="0" rowspan="1" colspan="1">Professor</th>
                            <th class="sorting wid-20" tabindex="0" rowspan="1" colspan="1">Status</th>
                            <th class="sorting wid-15" tabindex="0" rowspan="1" colspan="1">Ações</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
            "searching": false,
            "ajax": "{{ route('datatable.perguntas') }}",
            "columns": [
                {data: 'post_ID', name: 'post_ID'},
                {data: 'display_name', name: 'display_name'},
                {data: 'crm', name: 'crm'},
                {data: 'user_email', name: 'user_email'},
                {data: 'post_title', name: 'post_title'},
                {data: 'meta_value', name: 'meta_value'},
                {data: 'post_status', "render": function ( data, type, row, meta )
                    {
                        if ( data === 'publish' ) {
                        
                            return data == 0 ? "Aberto" : "Aberto";
                        }
                        if ( data === 'trash' || data === 'draft' ) {
                        
                            return data == 0 ? "Fechada" : "Fechada";
                        }
                            return data;
                    }
                },
                {data: 'post_ID', "render": function ( data, type, row, meta )
                    {
                      return '<a href="/perguntas/responder/'+data+'" data-toggle="tooltip" data-placement="top" title="" class="margemDir" data-original-title="Visualizar"><i class="fa fa-eye text-success"></i>';
                    }
                }
                
                
            ],
            dom: "Bflr<'table-responsive't><'row'<'col-md-5 col-12'i><'col-md-7 col-12'p>>",
            
            buttons: [              
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
