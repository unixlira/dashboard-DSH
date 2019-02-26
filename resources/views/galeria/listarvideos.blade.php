@extends(('layouts/default'))
{{-- Page title --}}
@section('title')
Video Gallery
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<!--plugin style-->
<link rel="stylesheet" href="{{asset('assets/vendors/unitegallery/css/unite-gallery.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendors/unitegallery/themes/default/ug-theme-default.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendors/unitegallery/themes/video/skin-bottom-text.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendors/unitegallery/themes/video/skin-right-no-thumb.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendors/unitegallery/themes/video/skin-right-thumb.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendors/unitegallery/themes/video/skin-right-title-only.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/pages/video_gallery.css')}}">
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
                    <i class="fa fa-camera-retro"></i>
                    Galeria de Vídeos
                </h4>
            </div>
            <div class="col-lg-6">
                <div class="float-right">
                    <ol class="breadcrumb nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i>
                                Página Inicial
                        </li>
                        <li class="breadcrumb-item">Galeria
                        </li>
                        <li class="breadcrumb-item active">Galeria de Vídeo</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="outer">
    <div class="inner bg-container">
        <div class="row">
            <div class="col-lg-12">                
                    <a href="{{ URL::to('galeria/novovideo') }}" id="editable_table_new" class="btn btn-info margemDir">
                        Adicionar Vídeo  <i class="fa fa-plus"></i>
                    </a>
                    <a href="{{ URL::to('galeria/listarvideosexcluir') }}" id="remover" class="btn btn-danger">
                        Excluir Vídeo <i class="fa fa-trash"></i>
                    </a>
                <div class="card m-t-15">
                    <div class="">
                        <div id="gallery2" style="margin:0 auto;display:none;">
                            @foreach($videos as $v)
                            <div data-type="youtube"
                                 data-title="{{$v->titulo}}"
                                 data-description="{{mb_strimwidth($v->descricao, 0, 110, '...')}}"
                                 data-thumb="https://i.ytimg.com/vi/{{$v->id_video}}/mqdefault.jpg"
                                 data-image="https://i.ytimg.com/vi/{{$v->id_video}}/sddefault.jpg"
                                 data-videoid="{{$v->id_video}}" >
                            </div>
                            @endforeach
                        </div>
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
<script type="text/javascript" src="{{asset('assets/vendors/unitegallery/themes/video/ug-theme-video.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/unitegallery/themes/tiles/ug-theme-tiles.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/unitegallery/js/unitegallery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/pages/video_gallery.js')}}"></script>
@stop