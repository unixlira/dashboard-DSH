@extends(('layouts/default'))
{{-- Page title --}}
@section('title')
    Add User
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!-- plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}"/>
    <!--end of page level css-->
@stop

{{-- Page content --}}
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-camera-retro"></i>
                        Adicionar Vídeo
                    </h4>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb float-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i>
                                Página Inicial
                            
                        </li>
                        <li class="breadcrumb-item">
                            Galeria
                        </li>
                        <li class="breadcrumb-item active">Adicionar Vídeo</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
<div class="outer">
    <div class="inner bg-container">
        <div class="card">

            <div class="card-body m-t-15">
                <form class="form-horizontal login_validator" id="formNovoVideo" action="salvarvideo" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-12">
                            <div align="center">
                                <h4>Detalhes do Vídeo</h4>
                            </div>
                            <div class="form-group row">
                                @if(isset($mensagem)) <!-- funcao 'old' verifica se existe parametro passado da requisição anterior para a atual -->
                                    <div class="alert alert-danger alert-dismissable col-lg-6  col-md-8  col-sm-12 mx-auto">
                                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                       <strong>Atenção: </strong>{{$mensagem}}
                                    </div>  
                                @endif
                                                            
                            </div>
                        
                            <div class="form-group row m-t-25">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="idvideo" class="col-form-label">
                                        ID do Vídeo *</label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">https://www.youtube.com/watch?v=</span>
                                        <input type="text" name="idvideo" id="idvideo" placeholder="ID..." class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="titulo" class="col-form-label">Título
                                        *</label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil text-primary"></i></span>
                                        <input type="text" id="titulo" name="titulo" placeholder="Título..." class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="descricao" class="col-form-label">Descrição
                                        *</label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil text-primary"></i></span>
                                        <input type="text" id="descricao" name="descricao" placeholder="Descrição..." class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-9 ml-auto">
                                    <input class="btn btn-primary" type="submit" value="Salvar Informações" />
                                    <input class="btn btn-warning" type="reset" id="clear" value="Limpar">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- /.inner -->
</div>


@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <!-- plugin scripts-->
    <script type="text/javascript" src="{{asset('assets/js/pluginjs/jasny-bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/holderjs/js/holder.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/pages/validation.js')}}"></script>
    <!-- end of plugin scripts-->
@stop