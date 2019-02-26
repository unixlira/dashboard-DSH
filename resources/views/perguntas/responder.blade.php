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

<div class="outer">
    <div class="inner bg-container">
        <div class="card">          
            <div class="card-body m-t-15" id="user_body">
                <div class="col-md-8 box_style_2" id="contactform">
                    <div class="row col-md-12">
                        <div class="col-md-12">
                            <div class="text-left m-b-20">
                                <h4>Professor</h4>
                            </div>   
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <span class="wpcf7-form-control-wrap your-fname">
                                    @foreach($remetentes as $r)
                                        @if($r->meta_key === "_receiver")
                                            <label><strong>Nome: </strong></label> {{ $r->nome }}<br>
                                            <label><strong>Email: </strong></label> {{ $r->email_sender }}<br>
                                            <label><strong>Pergunta: </strong></label> {{ $r->post_content }}    
                                        @else
                                            <label></label><br> 
                                        @endif
                                    @endforeach
                                        </span><br />
                                        <span class="input-icon"><i class="icon-user"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>       
                    </div>
                </div>
                <div class="col-md-8 box_style_2">
                    <form action="{{ URL::to($acao) }}" method="post" class="col">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class=" m-t-30 text-left m-b-20">
                            <h4>Responder</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <span class="wpcf7-form-control-wrap your-message">
                                    @if(isset($medico[0]))
                                        <label><strong>A/C: </strong></label> {{ $medico[0]->display_name }}<br>   
                                        @else
                                            <label></label><br>
                                    @endif
                                        <textarea name="resposta" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea form-control m-t-20" placeholder="Digite aqui sua mensagem..."></textarea>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" value="Enviar" class="btn btn-success" style="background-color: #4fa6b5 !important;border: 1px solid #4fa6b5;"/>
                            </div>
                        </div>
                        @foreach($remetentes as $remetente)
                            @if($remetente->meta_key === "_receiver")
                                <input type="hidden" name="post_id" value="{{ $remetente->post_id }}"><br>
                                <input type="hidden" name="nome" value="{{ $remetente->nome }}"><br>
                                <input type="hidden" name="user_id" value="{{ $remetente->ID}}"><br>
                                <input type="hidden" name="email" value="{{ $remetente->email_sender }}"><br>
                                <input type="hidden" name="pergunta" value="{{ $remetente->post_content }}"><br>
                            @endif
                        @endforeach
                            <input type="hidden" name="url"   value=""><br>
                            <input type="hidden" name="ip"    value="{{ $_SERVER["REMOTE_ADDR"] }}"> <br>
                            <input type="hidden" name="karma"  value="0"><br>
                            <input type="hidden" name="approved" value="1"><br>
                            <input type="hidden" name="data" value="{{ date('Y-m-d H:i:s') }}"><br>
                            <input type="hidden" name="gmt" value="{{ date('Y-m-d H:i:s') }}"><br>
                            <input type="hidden" name="agent"  value="{{ $_SERVER["HTTP_USER_AGENT"] }}"><br>
                            <input type="hidden" name="tipo"  value=""> <br>
                            <input type="hidden" name="parent" value="0"><br>
                            <input type="hidden" name="parent" value="0"><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('footer_scripts')
    <!--Plugin scripts-->
@stop
