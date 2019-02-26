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


    <link href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">
    <!-- end of global styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/form_elements.css')}}"/>
    <!--End of plugin styles-->
    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/tables.css')}}"/>
    <!-- end of page level styles -->

@stop
@section('content')
<?php 
    $dataHoje = date('Y-m-d');
?>
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6 col-sm-4">
                    <h4 class="nav_top_align">
                        <i class="fa fa-user"></i>
                        Lista de Médicos Cadastrados
                    </h4>
                </div>
                <div class="col-lg-6 col-sm-8 col-12" style="color:#fff !important;">
                    <ol class="breadcrumb float-right  nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i> Página Inicial
                            
                        </li>
                        <li class="active breadcrumb-item">Médicos Cadastrados</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
<div class="outer">
    <div class="inner bg-container">
        <div class="card">
            <div class="card-body m-t-15" id="user_body">
                <div class="table-toolbar">
                    <div class="pull-right">
                        <div class="row">
                            <div class="input-group col-lg-12 date form_date">
                                <label for="dataInicial" class="col-form-label margemDir">Data de Cadastro: </label>
                                <input type="text" name="dataInicial" id="dataInicial" class="date_mask form-control" value="{{$dataHoje}}" disabled="disabled">
                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                            </div>
                        </div>
                    </div>
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
                        <table class="table  table-striped table-bordered table-hover dataTable no-footer textoEsquerda" id="medicos" role="grid">
                            <thead>
                                <tr role="row">
                                    <th>Nº</th>
                                    <th>Nome</th>
                                    <th>CRM</th>
                                    <th>E-mail</th>
                                    <th>Data Cadastro</th>
                                    <th>Ações</th>
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



    <script type="text/javascript" src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap-datetimepicker.pt-BR.js')}}" charset="UTF-8"></script>
    <!--End of plugin scripts-->
    <!--Page level scripts-->
    <script type="text/javascript" src="{{asset('assets/js/pages/users.js')}}"></script>
    <!-- end page level scripts -->
    <script type="text/javascript">
        //Formatando numeros para R$
        function formatReal( int )
        {
            var tmp = parseInt( int.replace(/[\D]+/g,'') ) +'';
            tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
            if( tmp.length > 6 ){
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
            }
            return tmp;
        }

var TableAdvanced = function() {
    // ===============table 1====================
    var initTable1 = function() {
        var table = $('#medicos');

            oTable = table.DataTable({
            "processing": true,
            "ajax": "{{ route('datatable.getMedicos', 1) }}",
            "columns": [
                {data: 'ID', name: 'id'},
                {data: 'display_name', name: 'nome'},                
                {data: 'meta_value', name: 'crm'},
                {data: 'user_email', name: 'email'},
                {data: 'user_registered', name: 'user_registered', "render": function ( data, type, row, meta )
                    {
                            var dataAtual = new Date(data);
                            var dia = dataAtual.getDate();
                            var mes = dataAtual.getMonth()+1;
                            var ano = dataAtual.getFullYear();
                            
                            if (dia.toString().length == 1){
                              dia = "0"+dia;
                            }
                            if (mes.toString().length == 1){
                              mes = "0"+mes;
                            }
                            if (ano.toString().length == 1){
                              ano = "0"+ano;
                            }

                            return dia +'/'+mes+'/'+ano;
                            //return dataAtual;
                    }
                },
                {data: 'ID', "render": function ( data, type, row, meta )
                    {
                            if ("{{Request::session()->get('permissao',1)}}" != 2) {
                                return '<a class="delete hidden-xs hidden-sm" data-toggle="tooltip" data-placement="top" title="" href="restaurar/'+data+'" data-original-title="Restaurar"><i class="fa fa-rotate-right"style="color:#ee268f"></i></a>';
                            }else{
                                return '<a class="delete hidden-xs hidden-sm" data-toggle="tooltip" data-placement="top" title="" href="restaurar/'+data+'" data-original-title="Restaurar"><i class="fa fa-rotate-right"style="color:#ee268f"></i></a>';                       
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
        /*
        oTable.columns().every( function () {
            var that = this;
     
            $("#dataInicial").on( 'change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .columns( 8 )
                        .search( this.value )
                        .draw();
                }
            } );
        } );
        */
        $('#dataInicial').on( 'change', function () {
            oTable.search( this.value ).draw();
        } );

        var tableWrapper = $('#sample_1_wrapper'); // datatable creates the table wrapper by adding with id {your_table_id}_wrapper
        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

        /* Formatting function for row expanded details */
        function fnFormatDetails(dados) {
            let saldo_acumulado = 0;
            if (typeof dados[0][0] != 'undefined') {
                saldo_acumulado = dados[0][0].saldo_acumulado;
            }

            var sOut = '<div class="row col-12">';
            sOut += '<div class="col-lg-2"><b>Aulas Assistidas</b>:  '+saldo_acumulado+'</div>';
            sOut += '<div class="col-lg-2"><b>Conteúdos Baixados</b>: '+dados[1][0].spins+'</div>';

            sOut += '</div>';
            return sOut;
        }

        table.on('click', ' tbody td .row-details', function() {
            let tr = $(this).closest('tr');// $(this).parents('tr')[0];//this.parentNode.parentNode;
            
            let row = oTable.row( tr );

            let id = (tr[0].children[1].innerText);
            if ( row.child.isShown() ) {
                // Clicou no -
                $(this).addClass("row-details-close").removeClass("row-details-open");
                row.child.hide();
            }
            else {
                // Clicou no +
                $(this).addClass("row-details-open").removeClass("row-details-close");
                 $.get({url: "infoparticipantes/"+id, success: function(resultado){
                    row.child( fnFormatDetails(resultado) ).show();
                }});
            }
        });

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

//Calendario de selecao de data:
$('.form_date').datetimepicker({
    language:  'pt-BR',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0,
    format: 'yyyy-mm-dd'
});
    </script>
@stop
