@extends(('layouts/default')){{-- Page title --}}
@section('title')
File Upload
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<!--plugin style-->
<link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/fileinput/css/fileinput.min.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/blueimp-gallery-with-desc/css/blueimp-gallery.min.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/blueimp_file_upload/css/jquery.fileupload.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/blueimp_file_upload/css/jquery.fileupload-ui.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/blueimp-gallery-with-desc/css/blueimp-gallery.min.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/dropify/css/dropify.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/dropzone/css/dropzone.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/file_upload.css')}}">
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
                    <i class="fa fa-image"></i>
                    Adicionar Imagem
                </h4>
            </div>
            <div class="col-lg-6">
                <div class="float-right">
                    <ol class="breadcrumb nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i>
                                Página Inicial
                        </li>
                        <li class="breadcrumb-item">
                            Aplicativo
                        </li>
                        <li class="breadcrumb-item">
                            Carrossel de Ofertas
                        </li>
                        <li class="breadcrumb-item active">Nova Imagem</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="outer">
    <div class="inner bg-container">
        <div class="row">
            <div class="col">
                <div class="card file_input">
                    <div class="card-body">
                        <div class="row">
                            <div class="col m-t-15">
                                <h5>Selecione a Imagem (Máximo 10)</h5>
                                <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">
                                <input id="input-fa" name="imagem[]" type="file" accept="image/*" multiple class="file-loading">
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
<!-- /.content -->
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!--plugin script-->
<script type="text/javascript" src="{{asset('assets/vendors/fileinput/js/fileinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/fileinput/js/theme.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/blueimp_file_upload/js/jquery.ui.widget.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/blueimp-tmpl/js/tmpl.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/blueimploadimage/js/load-image.all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/blueimp-canvas-to-blob/js/canvas-to-blob.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/blueimp-gallery-with-desc/js/jquery.blueimp-gallery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/blueimp_file_upload/js/jquery.iframe-transport.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/blueimp_file_upload/js/jquery.fileupload.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/blueimp_file_upload/js/jquery.fileupload-process.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/blueimp_file_upload/js/jquery.fileupload-image.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/blueimp_file_upload/js/jquery.fileupload-audio.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/blueimp_file_upload/js/jquery.fileupload-video.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/blueimp_file_upload/js/jquery.fileupload-validate.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/blueimp_file_upload/js/jquery.fileupload-ui.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/dropify/js/dropify.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/dropzone/js/dropzone.min.js')}}"></script>
<!-- end of global scripts-->
<script type="text/javascript" src="{{asset('assets/js/pages/file_upload.js')}}"></script>

<script id="template-upload" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload fade">
            <td>
                <span class="preview"></span>
            </td>
            <td>
                <p class="name">{%=file.name%}</p>
                <strong class="error text-danger"></strong>
            </td>
            <td>
                <p class="size">Processing...</p>
                <div class="progress active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar bg-success" style="width:0%;"></div>
                </div>
            </td>
            <td>
                {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start m-t-10" disabled>
                    <i class="fa fa-arrow-up"></i>
                    <span>Start</span>
                </button>
                {% } %} {% if (!i) { %}
                <button class="btn btn-warning cancel m-t-10">
                    <i class="fa fa-close"></i>
                    <span>Cancel</span>
                </button>
                {% } %}
            </td>
        </tr>
        {% } %}



</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download fade">
            <td>
                <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
            </td>
            <td>
                <p class="name">
                    {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl? 'data-gallery': ''%}>{%=file.name%}</a> {% } else { %}
                    <span>{%=file.name%}</span> {% } %}
                </p>
                {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                {% } %}
            </td>
            <td>
                <span class="size">{%=o.formatFileSize(file.size)%}</span>
            </td>
            <td>
                {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete m-t-10" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
                    <i class="fa fa-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle"> {% } else { %}
                <button class="btn btn-warning cancel m-t-10">
                    <i class="fa fa-close"></i>
                    <span>Cancel</span>
                </button>
                {% } %}
            </td>
        </tr>
        {% } %}

</script>
@stop